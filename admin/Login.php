<?php
include "db.class.php";
$db = new db("usuario");
if (!empty($_POST)) {
    $user = $db->login($_POST);

    if ($user) {
        $_SESSION["user"] = $user->login;
        $_SESSION["nome"] = $user->nome;


        header("Location:post/PostList.php"); 
    } else {
        echo "<b>Login ou senha erradas</b>";
    }
}
?>

<form action="Login.php" method="post">
    <h4>Login</h4>
    <label for="">Login</label><br>
    <input type="text" name="login"><br>

    <label for="">senha</label><br>
    <input type="password" name="senha">


    <button type="submit">Entrar</button>
    <a href="UsuarioForm.php">Cadastrar</a>
</form>