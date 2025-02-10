<?php
include "admin/db.connect.php"; // Conexão com o banco
include "header.php"; // Cabeçalho com a inclusão do Bootstrap

// Lógica para adicionar um novo usuário
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin = isset($_POST['admin']) ? 1 : 0; // Verifica se o campo admin foi marcado
    $password = $_POST['password']; // Obtém a senha do formulário
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash da senha

    $stmt = $conn->prepare("INSERT INTO users (username, email, admin, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $username, $email, $admin, $hashedPassword);
    $stmt->execute();

    // Redireciona para evitar reenvio do formulário ao atualizar a página
    header("Location: users.php");
    exit();
}

// Lógica para editar usuário
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $userId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

// Lógica para salvar as edições do usuário
if (isset($_POST['edit_user'])) {
    $userId = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin = isset($_POST['admin']) ? 1 : 0; // Verifica se o campo admin foi marcado
    $password = $_POST['password']; // Obtém a senha do formulário
    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $user['password']; // Se a senha não for fornecida, mantém a antiga

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, admin = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $username, $email, $admin, $hashedPassword, $userId);
    $stmt->execute();

    header("Location: users.php"); // Redireciona após a edição
    exit();
}

// Lógica para deletar o usuário
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    header("Location: users.php"); // Redireciona após a exclusão
    exit();
}

// Consulta para listar os usuários
$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetch_all(MYSQLI_ASSOC);
?>

<!-- Tabela com os usuários -->
<h2 class="mt-4">Gerenciar Usuários</h2>
<table class="table table-striped table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['username']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['admin'] ? 'Sim' : 'Não'; ?></td>
                <td>
                    <a href="users.php?action=edit&id=<?= $user['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="users.php?action=delete&id=<?= $user['id']; ?>" class="btn btn-danger btn-sm">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="users.php?action=add" class="btn btn-primary btn-sm mb-3 ml-3">Adicionar um Novo Usuário</a>

<?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($user)): ?>
    <!-- Formulário de edição -->
    <div class="ml-3 mb-3">
        <h3>Editar Usuário</h3>
        <form action="users.php" method="POST">
            <input type="hidden" name="id" value="<?= $user['id']; ?>">
            <div class="form-group">
                <label for="username">Nome de usuário:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Nova Senha (deixe em branco para não alterar):</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="admin" name="admin" <?= $user['admin'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="admin">Admin</label>
            </div>
            <button type="submit" class="btn btn-success mt-2" name="edit_user">Salvar Alterações</button>
        </form>
    </div>

<?php endif; ?>

<?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
    <!-- Formulário de adicionar novo usuário -->
    <div class="ml-3 mb-3">
        <h2>Adicionar Novo Usuário</h2>
        <form action="users.php" method="POST">
            <div class="form-group">
                <label for="username">Nome de usuário:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="admin" name="admin">
                <label class="form-check-label" for="admin">Admin</label>
            </div>
            <button type="submit" class="btn btn-success mt-2" name="add_user">Adicionar Usuário</button>
        </form>
    </div>

<?php endif; ?>