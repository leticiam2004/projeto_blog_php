<?php
include "../db.class.php";
$db = new db("post");
$categorias = $db->all("categoria");
if (!empty($_POST)) {
    if (empty($_POST["id"])) {
        $db->insert($_POST);
    } else {
        $db->update($_POST);

    }
    header("Location:PostList.php");

}
if (!empty($_GET["id"])) {
    $data = $db->find($_GET['id']);
}

$status = empty($data->status)?"1":$data->status;

?>

<form action="PostForm.php" method="post">
    <input type="hidden" name="id" value="<?php echo $data->id ?? '' ?>">

    <h4>Formulário Post</h4>
    <label for="">Titulo</label><br>
    <input type="text" name="titulo" value="<?php echo $data->titulo ?? '' ?>"><br>

    <label for="">Data da pub</label><br>
    <input type="datetime-local" name="data_publicacao" value="<?php echo $data->data_publicacao ?? '' ?>"><br>

    <label for="">status</label><br>
    <select name="status" id="">
        <option <?php if ($status == 1){echo "selected";}?> value="1">Ativo</option>
        <option <?php if ($status == 0){echo "selected";}?> value="0">Inativo</option>
    </select><br>

    <label for="">desc</label><br>
    <textarea rows="4" name="texto"><?php echo $data->texto ?? '' ?></textarea><br>

    <label for="">categoria</label><br>
    <select name="categoria_id" id="">
        <?php
        foreach ($categorias as $cataegoria) {
        $selected = $cataegoria->id == $data->  categoria_id? "selected":"";

            echo "<option $selected value='$cataegoria->id'>$cataegoria->nome</option>";
        }
        ?>
    </select><br>


    <button type="submit">Salvar</button>
</form>