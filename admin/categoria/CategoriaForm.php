<?php
include "../db.class.php";
$db = new db("categoria");

if (!empty($_POST)) {
    if (empty($_POST["id"])) {
        $db->insert($_POST);
    } else {
        $db->update($_POST);

    }
    header("Location:CategoriaList.php");

}

if (!empty($_GET["id"])) {
    $data = $db->find($_GET['id']);
}


?>

<form action="CategoriaForm.php" method="post">
    <input type="hidden" name="id" value="<?php echo $data->id ?? '' ?>">

    <h4>Formulário Categoria</h4>
    <label for="">Nome</label><br>
    <input type="text" name="nome" value="<?php echo $data->nome ?? '' ?>"><br>

    <button type="submit">Salvar</button>
</form>