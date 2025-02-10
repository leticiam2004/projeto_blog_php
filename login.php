<?php include "admin/db.connect.php"; ?>
<?php
session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the email is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a session and store user data
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];

            // Redirect to the dashboard or homepage
            header("Location: index.php");
            exit;
        } else {
            $message = "Senha incorreta!";
        }
    } else {
        $message = "E-mail não encontrado!";
    }

    $conn->close();
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
                <a href="index.php">
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
                <label for="email">Endereço de email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="jessie@gmail.com">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********">
            </div>

            <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Login</button>

            <a href="cadastro.php" class="btn" style="background-color:rgb(214, 48, 48); color: white;">Fazer
                cadastro</a>

            <?php if (isset($message) && $message != "") {
                echo "<div class='alert alert-info mt-2'>$message</div>";
            } ?>

        </form>
    </div>

    <?php include "footer.php"; ?>