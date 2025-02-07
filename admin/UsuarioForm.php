<?php
include "./db.class.php";
$db = new db("usuario");
if (!empty($_POST)) {
    if ($_POST['senha'] === $_POST["c_senha"]) {
        
        $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        unset($_POST['c_senha']);
        $db->insert($_POST);

        header("Location:PostList.php");
    } else {
        echo "<b>Senhas não coincidem</b>";
    }

}



?>

<form action="UsuarioForm.php" method="post">
    <input type="hidden" name="id" value="<?php echo $data->id ?? '' ?>">
    <input type="hidden" name="status" value="1">

    <h4>Formulário Usuario</h4>
    <label for="">Nome</label><br>
    <input type="text" name="nome"><br>

    <label for="">Login</label><br>
    <input type="text" name="login"><br>

    <label for="">senha</label><br>
    <input type="password" name="senha">

    <label for="">Confirmar senha</label><br>
    <input type="password" name="c_senha">


    <button type="submit">Salvar</button>
</form>