<?php include "admin/db.class.php"; 
include "header.php"; 

$message = "";

$db = new db('users');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = $db->filter(['email' => $email]);

    if (!empty($user)) {
        $user = $user[0]; // Get the first user

        // Verify the password
        if (password_verify($password, $user->password)) { // <- Fixed this line
            // Password is correct, start a session and store user data
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            $_SESSION['admin'] = $user->admin;


            // Redirect to the dashboard or homepage
            header("Location: index.php");
            exit;
        } else {
            $message = "Senha incorreta!";
        }
    } else {
        $message = "E-mail não encontrado!";
    }
}
?>


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

        <?php
        if (isset($_GET['error'])) {
            $errorMessage = urldecode($_GET['error']);
            echo "<div class='alert alert-danger mt-2'>$errorMessage</div>";
        }
        ?>


    </form>
</div>

<?php include "footer.php"; ?>