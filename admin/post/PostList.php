<?php
    include "../db.class.php";
    $db = new db("post");

if (!empty(($_GET['id']))) {
    $db->destroy($_GET['id']);
    header('Location:PostList.php');
}
if(!empty(($_POST))){
    $data = $db->filter($_POST);
}else{
    $data = $db->all();
}

?>

<table style='border:1px solid #000;'>
    <form action="./PostList.php" method="post">
        <select name="tipo" id=""><option value="titulo">Titulo</option></select>
        <input type="text" name="valor">
        <button type="submit">Buscar</button>
    </form>

    <thead >
        <th>ID</th>
        <th>Título</th>
        <th>data</th>
        <th>desc</th>
        <th>status</th>
        <th>cat_id</th>
        <th colspan="2">Ações</th>
    </thead>
    <tb >
        <?php
        foreach($data as $item){
            $status =  $item->status?'Ativo':'Inativo';
            $categoria = $db->find($item->categoria_id,"categoria");
                echo "<tr style='border:1px solid #000;'>
                <td style='border:1px solid #000;'>$item->id</td>
                <td  style='border:1px solid #000;'>$item->titulo</td>
                <td  style='border:1px solid #000;'>$item->data_publicacao</td>
                <td  style='border:1px solid #000;'>$item->texto</td>
                <td  style='border:1px solid #000;'>$status</td>
                <td  style='border:1px solid #000;'>$categoria->nome</td>
                <td style='border:1px solid #000;'><a href='./PostForm.php?id=$item->id'>Editar</a> <a onclick='return confirm(\" Deseja realmete excluir?\")'href='./PostList.php?id=$item->id'>Deletar</a></td>
            </tr>";
        }
        
        ?>
    </tb>
    <?php
    echo "<a href='./PostForm.php'>Cadastrar</a>";
    ?>
</table>
