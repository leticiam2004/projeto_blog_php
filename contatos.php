<?php
include "admin/db.connect.php"; // Conexão com o banco
include "header.php"; // Cabeçalho com a inclusão do Bootstrap

// Lógica para editar o contato
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $contactId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM contato WHERE id = ?");
    $stmt->bind_param("i", $contactId);
    $stmt->execute();
    $result = $stmt->get_result();
    $contact = $result->fetch_assoc();

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
    $stmt = $conn->prepare("UPDATE contato SET situacao = ? WHERE id = ?");
    $stmt->bind_param("si", $situacao, $contactId);
    $stmt->execute();

    // Redireciona para a página de contatos após a edição
    header("Location: contatos.php");
    exit();
}

// Lógica para deletar o contato
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $contactId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM contato WHERE id = ?");
    $stmt->bind_param("i", $contactId);
    $stmt->execute();

    // Redireciona para a página de contatos após a exclusão
    header("Location: contatos.php");
    exit();
}

// Consulta para listar os contatos
$sql = "SELECT * FROM contato";
$result = $conn->query($sql);
?>

<!-- Centralizando o conteúdo em um container -->
<div class="container" style="width: 80vw;">

    <!-- Tabela com os tickets -->
    <h2 class="mt-4">Lista de Tickets</h2>
    <?php if ($result->num_rows > 0): ?>
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
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['nome_completo']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['assunto']; ?></td>
                        <td><?= $row['situacao']; ?></td>
                        <td style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;"><?= $row['problema']; ?></td>
                        <td>
                            <a href="contatos.php?action=edit&id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="contatos.php?action=delete&id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">Deletar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum contato encontrado.</p>
    <?php endif; ?>

    <!-- Formulário de Edição -->
    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($contact)): ?>
        <h3>Editar Situação do Contato</h3>
        <form action="contatos.php" method="POST">
            <input type="hidden" name="id" value="<?= $contact['id']; ?>">

            <!-- O Nome e Email não são mais editáveis, somente a Situação -->
            <div class="form-group">
                <label for="assunto">Assunto:</label>
                <input type="text" class="form-control" id="assunto" name="assunto" value="<?= $contact['assunto']; ?>"
                    disabled>
            </div>

            <div class="form-group">
                <label for="situacao">Situação:</label>
                <select class="form-control" id="situacao" name="situacao" required>
                    <option value="Novo" <?= (isset($contact['situacao']) && $contact['situacao'] == 'Novo') ? 'selected' : ''; ?>>
                        Novo</option>
                    <option value="Em andamento" <?= (isset($contact['situacao']) && $contact['situacao'] == 'Em andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                    <option value="Resolvido" <?= (isset($contact['situacao']) && $contact['situacao'] == 'Resolvido') ? 'selected' : ''; ?>>Resolvido</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success mb-4" name="edit_contact">Salvar Alterações</button>
        </form>
    <?php endif; ?>
</div>

