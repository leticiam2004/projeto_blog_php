<?php
include "admin/db.class.php"; // conexão com o banco de dados via PDO
include "header.php"; // importa o cabeçalho, já com bootstrap incluso

$db = new db('users');
$db->checkLogin();
$db->checkAdminLogin();
$conn = $db->conn();

// verifica se o formulário de adição foi enviado
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin = isset($_POST['admin']) ? 1 : 0; // se estiver marcado, define como admin
    $password = $_POST['password']; // pega a senha do formulário
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // criptografa a senha
    $telefone = ($_POST['telefone']);

    // insere o novo usuário no banco
    $stmt = $conn->prepare("INSERT INTO users (username, email, telefone, admin, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$username, $email, $telefone, $admin, $hashedPassword]);

    // redireciona pra evitar reenvio do formulário
    header("Location: users.php");
    exit();
}

// verifica se é uma edição
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $userId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// verifica se o formulário de edição foi enviado
if (isset($_POST['edit_user'])) {
    $userId = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin = isset($_POST['admin']) ? 1 : 0;
    $password = $_POST['password'];
    $telefone = $_POST['telefone'];

    // busca a senha atual no banco se não houver uma senha nova informada
    if (empty($password)) {
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = $row ? $row['password'] : ''; // mantém a senha antiga
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    // atualiza os dados no banco
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, telefone = ?, admin = ?, password = ? WHERE id = ?");
    if ($stmt->execute([$username, $email, $telefone, $admin, $hashedPassword, $userId])) {
        header("Location: users.php");
        exit();
    } else {
        echo "Erro ao atualizar o usuário: " . $stmt->errorInfo()[2];
    }
}

// verifica se é uma exclusão
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);

    // redireciona após a exclusão
    header("Location: users.php");
    exit();
}

// pega a lista de usuários do banco
$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lógica de pesquisa
$search = isset($_POST['search']) ? $_POST['search'] : '';

if ($search) {
    // Buscar usuários pelo nome
    $stmt = $conn->prepare("SELECT * FROM users WHERE LOWER(username) LIKE LOWER(?)");
    $stmt->execute(['%' . $search . '%']);
} else {
    // Se não houver pesquisa, exibe todos os usuários
    $stmt = $conn->query("SELECT * FROM users");
}

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!-- conteúdo centralizado -->
<div class="container" style="max-width: 80vw; margin: 0 auto;">
    <!-- tabela com os usuários -->
    <h2 class="mt-4">Gerenciar usuários</h2>

    <!-- Formulário de pesquisa -->
    <form action="users.php" method="post" class="mb-4">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome"
                value="<?= isset($_POST['search']) ? $_POST['search'] : ''; ?>">
        </div>
        <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Buscar</button>
    </form>


    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>USUÁRIO</th>
                <th>E-MAIL</th>
                <th>TELEFONE</th>
                <th>ADMIN</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id']; ?></td>
                    <td><?= $u['username']; ?></td>
                    <td><?= $u['email']; ?></td>
                    <td><?= $u['telefone']; ?></td>
                    <td><?= $u['admin'] ? 'SIM' : 'NÃO'; ?></td>
                    <td>
                        <a href="users.php?action=edit&id=<?= $u['id']; ?>" class="btn btn-warning btn-sm mr-2"
                            style="color: black;">Editar</a>
                        <a href="users.php?action=delete&id=<?= $u['id']; ?>" class="btn btn-danger btn-sm"
                            style="color: white;" onclick="return confirmDelete()">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="users.php?action=add" class="btn" style="background-color: #30A7D6; color: white;">Adicionar um novo
        usuário</a>

    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($user)): ?>
        <!-- formulário de edição -->
        <div class="ml-3 mb-3">
            <h2>Editar usuário</h2>
            <form action="users.php" method="POST">
                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                <div class="form-group">
                    <label for="username">Nome de usuário:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $user['telefone']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="password">Nova senha (deixe em branco para não alterar):</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="admin" name="admin" <?= $user['admin'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="admin">Admin</label>
                </div>
                <button type="submit" class="btn btn-success mt-2" name="edit_user">Salvar alterações</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
        <!-- formulário de adicionar novo usuário -->
        <div class="ml-3 mb-3">
            <h2>Adicionar novo usuário</h2>
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
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="admin" name="admin">
                    <label class="form-check-label" for="admin">Admin</label>
                </div>
                <button type="submit" class="btn btn-success mt-2" name="add_user">adicionar usuário</button>
            </form>
        </div>
    <?php endif; ?>
</div>
<script>
    function confirmDelete() {
        return confirm("Tem certeza que deseja excluir este usuário?");
    }
</script>