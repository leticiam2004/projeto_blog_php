<?php
include "admin/db.class.php"; // Conexão com o banco
include "header.php"; // Cabeçalho com a inclusão do Bootstrap

// Instancia a classe db e inicializa a conexão
$db = new db('contato'); // 'contato' é o nome da tabela
$conn = $db->conn(); // Obtém a conexão


// Lógica para editar o contato
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $contactId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM contato WHERE id = :id");
    $stmt->bindParam(':id', $contactId, PDO::PARAM_INT);
    $stmt->execute();
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o contato foi encontrado
    if (!$contact) {
        echo "Contato não encontrado!";
        exit();
    }
}

// Lógica para salvar as edições do contato
if (isset($_POST['edit_contact'])) {
    $contactId = $_POST['id'];
    $situacao = $_POST['situacao'];

    // Atualiza a situação no banco de dados
    $stmt = $conn->prepare("UPDATE contato SET situacao = :situacao WHERE id = :id");
    $stmt->bindParam(':situacao', $situacao, PDO::PARAM_STR);
    $stmt->bindParam(':id', $contactId, PDO::PARAM_INT);
    $stmt->execute();

    // Redireciona para a página de contatos após a edição
    header("Location: contatos.php");
    exit();
}

// lógica para deletar o contato
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $contactId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM contato WHERE id = :id");
    $stmt->bindParam(':id', $contactId, PDO::PARAM_INT);
    $stmt->execute();

    // manda para a página de contatos após a exclusão
    header("Location: contatos.php");
    exit();
}
// consulta para listar os contatos
$stmt = $conn->prepare("SELECT * FROM contato");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$search = isset($_POST['search']) ? $_POST['search'] : '';

if ($search) {
    // pesquisa usuários pelo nome
    $stmt = $conn->prepare("SELECT * FROM contato WHERE LOWER(nome_completo) LIKE LOWER(?)");
    $stmt->execute(['%' . $search . '%']);
    $contato = $stmt->fetchAll(PDO::FETCH_ASSOC); // Guardar os resultados da pesquisa
} else {
    // Se não houver pesquisa, exibe todos os usuários
    $stmt = $conn->query("SELECT * FROM contato");
    $contato = $stmt->fetchAll(PDO::FETCH_ASSOC); // Guardar os resultados da consulta
}

?>

<!-- Centralizando o conteúdo em um container -->
<div class="container" style="width: 80vw;">

    <!-- Tabela com os tickets -->
    <h2 class="mt-4">Lista de Tickets</h2>

    <!-- Formulário de pesquisa -->
    <form action="contatos.php" method="post" class="mb-4">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome"
                value="<?= isset($_POST['search']) ? $_POST['search'] : ''; ?>">
        </div>
        <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Buscar</button>
    </form>

    <!-- Exibindo a tabela de contatos -->
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
                            <a href="contatos.php?action=edit&id=<?= $row['id']; ?>" class="btn btn-warning btn-sm mb-2"
                                style="color: black;">Editar</a>
                            <a href="contatos.php?action=delete&id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                style="color: white;">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum contato encontrado.</p>
    <?php endif; ?>
</div>