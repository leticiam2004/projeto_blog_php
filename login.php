<?php
include "admin/db.class.php"; // inclui a classe de conexão com o banco de dados
include "header.php"; // inclui o cabeçalho da página

$message = ""; // variável para armazenar mensagens de erro ou sucesso

// instancia a classe db para a tabela 'users'
$db = new db('users');

// verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']); // pega o e-mail e remove espaços extras
    $password = trim($_POST['password']); // pega a senha e remove espaços extras

    $user = $db->filter(['email' => $email]); // busca o usuário pelo e-mail no banco

    // verifica se o usuário foi encontrado
    if (!empty($user)) {
        $user = $user[0]; // pega o primeiro usuário retornado

        // verifica se a senha informada bate com a do banco
        if (password_verify($password, $user->password)) {
            // se a senha estiver correta, inicia a sessão e salva os dados do usuário
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            $_SESSION['admin'] = $user->admin;

            // redireciona para a página inicial após login bem-sucedido
            header("Location: index.php");
            exit;
        } else {
            $message = "Senha incorreta!"; // mensagem se a senha estiver errada
        }
    } else {
        $message = "E-mail não encontrado!"; // mensagem se o e-mail não for encontrado
    }
}
?>

<!-- container para centralizar o formulário -->
<div class="container mt-4 mb-5">

    <!-- formulário de login -->
    <form method="POST">
        <div class="form-group">
            <label for="email">Endereço de email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="jessie@gmail.com">
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="********">
        </div>

        <!-- botão para enviar o formulário -->
        <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Login</button>

        <!-- botão para redirecionar para a página de cadastro -->
        <a href="cadastro.php" class="btn" style="background-color:rgb(214, 48, 48); color: white;">Fazer
            cadastro</a>

        <!-- exibe mensagem de erro ou sucesso, se houver -->
        <?php if (isset($message) && $message != "") {
            echo "<div class='alert alert-info mt-2'>$message</div>";
        } ?>

        <!-- exibe mensagens de erro passadas via GET -->
        <?php
        if (isset($_GET['error'])) {
            $errorMessage = urldecode($_GET['error']);
            echo "<div class='alert alert-danger mt-2'>$errorMessage</div>";
        }
        ?>
    </form>
</div>

<?php include "footer.php"; ?>