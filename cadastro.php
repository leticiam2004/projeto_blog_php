<?php include "admin/db.connect.php"; ?>
<?php

function validateEmptyFields($username, $email, $password)
{
    if (empty($username) || empty($email) || empty($password)) {
        return array("status" => "FAILED", "message" => "Por favor, preencha todos os campos!");
    }
    return null;
}

function validateUsername($username)
{
    if (!preg_match('/^[a-zA-Z0-9]*$/', $username)) {
        return array("status" => "FAILED", "message" => "Por favor, coloque um nome de usuário válido");
    }
    return null;
}

function validateEmail($email)
{
    if (!preg_match('/^[\w\-.]+@([\w-]+\.)+[\w-]{2,4}$/', $email)) {
        return array("status" => "FAILED", "message" => "Por favor, coloque um e-mail válido");
    }
    return null;
}

function validatePassword($password, $confirmPassword)
{
    if (strlen($password) < 8 || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
    }
    if ($password !== $confirmPassword) {
        return array("status" => "FAILED", "message" => "A senha deve ter pelo menos 8 caracteres e incluir letras e números.");
    }
    return null;
}

function checkEmailExists($email, $conn)
{
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true; // email já existe
    }

    return false; // email não existe
}

$message = "";
$errors = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // receber dados do formulario 

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // verificar se existem os fields no array POST

    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

        // validar campos vazios 
        if ($emptyError = validateEmptyFields($username, $email, $password)) {
            $errors[] = $emptyError['message'];
        }

        // validar nome de usuário
        if (!is_null($usernameError = validateUsername($username))) {
            $errors[] = $usernameError['message'];
        }

        // validar email
        if (!is_null($emailError = validateEmail($email))) {
            $errors[] = $emailError['message'];
        }

        // validar senha
        if (!is_null($passwordError = validatePassword($password, $confirmPassword))) {
            $errors[] = $passwordError['message'];
        }

        // verificar se o email já está cadastrado
        if (checkEmailExists($email, $conn)) {
            $errors[] = "Este e-mail já está cadastrado!";
        }

        if (empty($errors)) {

            // hash a senha
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // preparar query 

            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

            // inserir query

            if ($conn->query($sql) === TRUE) {
                $message = "Cadastro realizado com sucesso!";
            } else {
                $message = "Erro ao enviar dados: " . $conn->error;
            }

            // encerrar conexao

            $conn->close();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PokéMart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="stylesheet.css" />
    <link rel="icon" href="https://iili.io/2b9Q9mN.png">
</head>

<body>
    <header class="text-white py-3" style="background-color: #e23a26">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="../index.php">
                    <img src="https://iili.io/2b9Q9mN.png" id="logo" alt="PokéMart" />
                </a>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link font-weight-bold" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="user_sobre.php">Sobre nós</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="user_produtos.php">Loja</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link font-weight-bold" href="user_contato.php">Contato</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link font-weight-bold" href="login.php">Login<span class="sr-only">(Página
                                    atual)</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="container mt-4 mb-5">

        <form method="POST">
            <div class="form-group">
                <label for="name">Usuário</label>
                <input type="name" class="form-control" id="username" name="username" placeholder="jessie_meowth">
            </div>
            <div class="form-group">
                <label for="email">Endereço de email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="jessie@gmail.com">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                    placeholder="********">
            </div>

            <button type="submit" class="btn" style="background-color:#30A7D6; color: white;">Cadastrar</button>

            <?php if (isset($message) && $message != "") {
                echo "<div class='alert alert-info mt-2'>$message</div>";
            } ?>

            <?php if (!empty($errors)): ?>
                <div class='alert alert-danger mt-2'>
                    <?php foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    } ?>
                </div>
            <?php endif; ?>

        </form>
    </div>

    <?php include "footer.php"; ?>