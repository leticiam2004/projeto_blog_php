<?php
include "admin/db.class.php"; // conecta com o banco de dados
include "header.php"; // inclui o cabeçalho com bootstrap

// cria uma instância da classe db e conecta na tabela 'contato'
$db = new db('contato');
$conn = $db->conn(); // pega a conexão ativa

// verifica se o usuário quer editar um contato
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $contactId = $_GET['id']; // pega o id do contato
    $stmt = $conn->prepare("SELECT * FROM contato WHERE id = :id"); // consulta o contato pelo id
    $stmt->bindParam(':id', $contactId, PDO::PARAM_INT);
    $stmt->execute();
    $contact = $stmt->fetch(PDO::FETCH_ASSOC); // armazena o contato

    // se não achar o contato, mostra mensagem e para tudo
    if (!$contact) {
        echo "Contato não encontrado!";
        exit();
    }
}

// salva as alterações feitas em um contato
if (isset($_POST['edit_contact'])) {
    $contactId = $_POST['id']; // pega o id enviado pelo form
    $situacao = $_POST['situacao']; // pega a nova situação

    // atualiza a situação no banco
    $stmt = $conn->prepare("UPDATE contato SET situacao = :situacao WHERE id = :id");
    $stmt->bindParam(':situacao', $situacao, PDO::PARAM_STR);
    $stmt->bindParam(':id', $contactId, PDO::PARAM_INT);
    $stmt->execute();

    // redireciona para a lista de contatos depois de salvar
    header("Location: contatos.php");
    exit();
}

// deleta um contato
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $contactId = $_GET['id']; // pega o id do contato
    $stmt = $conn->prepare("DELETE FROM contato WHERE id = :id"); // deleta pelo id
    $stmt->bindParam(':id', $contactId, PDO::PARAM_INT);
    $stmt->execute();

    // redireciona pra página principal após deletar
    header("Location: contatos.php");
    exit();
}

// consulta todos os contatos para exibir na tabela
$stmt = $conn->prepare("SELECT * FROM contato");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // guarda todos os contatos

$search = isset($_POST['search']) ? $_POST['search'] : ''; // pega a pesquisa, se tiver

if ($search) {
    // pesquisa contatos pelo nome (ignora maiúsculas/minúsculas)
    $stmt = $conn->prepare("SELECT * FROM contato WHERE LOWER(nome_completo) LIKE LOWER(?)");
    $stmt->execute(['%' . $search . '%']);
    $contato = $stmt->fetchAll(PDO::FETCH_ASSOC); // resultados da pesquisa
} else {
    // se não pesquisar, mostra todos os contatos
    $stmt = $conn->query("SELECT * FROM contato");
    $contato = $stmt->fetchAll(PDO::FETCH_ASSOC); // resultados padrão
}
?>

<!-- container centralizado -->
<div class="container" style="width: 80vw;">

    <!-- título da lista -->
    <h2 class="mt-4">Lista de Tickets</h2>

    <!-- formulário de pesquisa -->
    <form action="contatos.php" method="post" class="mb-4">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome"
                value="<?= isset($_POST['search']) ? $_POST['search'] : ''; ?>">
        </div>
        <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Buscar</button>
    </form>

    <!-- tabela com os contatos -->
    <?php if (count($contato) > 0): ?>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome Completo</th>
                    <th>Email</th>
                    <th>Assunto</th>
                    <th>Situação</th>
                    <th>Problema</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contato as $row): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['nome_completo']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['assunto']; ?></td>
                        <td><?= $row['situacao']; ?></td>
                        <td style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                            <?= $row['problema']; ?>
                        </td>
                        <td>
                            <!-- botão pra editar o contato -->
                            <a href="contatos.php?action=edit&id=<?= $row['id']; ?>" class="btn btn-warning btn-sm mb-2"
                                style="color: black;">Editar</a>
                            <!-- botão pra deletar o contato -->
                            <a href="contatos.php?action=delete&id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                style="color: white;">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- mensagem se não achar nenhum contato -->
        <p>Nenhum contato encontrado.</p>
    <?php endif; ?>
</div>