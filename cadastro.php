<?php include "admin/db.class.php";
include "header.php";

// criar instância da classe db pra tabela users e pegar conexão
$db = new db('users');
$conn = $db->conn();

// valida se tem campo vazio
function validateEmptyFields($username, $email, $password)
{
    if (empty($username) || empty($email) || empty($password)) {
        return array("status" => "FAILED", "message" => "Por favor, preencha todos os campos!");
    }
    return null;
}

// valida se o nome de usuário tem só letras e números
function validateUsername($username)
{
    if (!preg_match('/^[a-zA-Z0-9]*$/', $username)) {
        return array("status" => "FAILED", "message" => "Por favor, coloque um nome de usuário válido");
    }
    return null;
}

// valida se o e-mail tem formato válido
function validateEmail($email)
{
    if (!preg_match('/^[\w\-.]+@([\w-]+\.)+[\w-]{2,4}$/', $email)) {
        return array("status" => "FAILED", "message" => "Por favor, coloque um e-mail válido");
    }
    return null;
}

// valida telefone (11 dígitos)
function validatePhone($telefone)
{
    // validar número de telefone no formato
    if (!preg_match('/^\d{11}$/', $telefone)) {
        return array("status" => "FAILED", "message" => "Por favor, coloque um número de telefone válido.");
    }
    return null;
}

// valida se as senhas coincidem
function validatePassword($password, $confirmPassword)
{
    if ($password !== $confirmPassword) {
        return array("status" => "FAILED", "message" => "As senhas não coincidem.");
    }
    return null;
}


// checa se o e-mail já tá cadastrado
function checkEmailExists($email, $conn)
{
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true; // email já existe
    }

    return false; // email não existe
}

// variáveis pra mensagem e erros
$message = "";
$errors = [];

// se o método for POST, processa os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // receber dados do formulario
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // checa se os campos existem
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

        // Validar telefone
        if (!is_null($telefoneError = validatePhone($telefone))) {
            $errors[] = $telefoneError['message'];
        }

        // validar senha
        if (!is_null($passwordError = validatePassword($password, $confirmPassword))) {
            $errors[] = $passwordError['message'];
        }

        // verificar se o email já está cadastrado
        if (checkEmailExists($email, $conn)) {
            $errors[] = "Este e-mail já está cadastrado!";
        }

        // se não houver erros, insere no banco
        if (empty($errors)) {

            // fazer hash da senha
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // prepara e executa query
            $sql = "INSERT INTO users (username, email, telefone, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // inserir query
            if ($stmt->execute([$username, $email, $telefone, $hashed_password])) {
                $message = "Cadastro realizado com sucesso!";
            } else {
                $message = "Erro ao enviar dados: " . $conn->errorInfo()[2];
            }

            // fecha conexao
            $conn = null;
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
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) X XXXX-XXXX">
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