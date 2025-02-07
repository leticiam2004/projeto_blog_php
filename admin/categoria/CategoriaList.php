<?php
    include "../db.class.php";
    $db = new db("categoria");

if (!empty(($_GET['id']))) {
    $db->destroy($_GET['id']);
    header('Location:CategoriaList.php');
}
if(!empty(($_POST))){
    $data = $db->filter($_POST);
}else{
    $data = $db->all();
}
        

?>

<table style='border:1px solid #000;'>
    <form action="./CategoriaList.php" method="post">
        <select name="tipo" id=""><option value="nome">Nome</option></select>
        <input type="text" name="valor">
        <button type="submit">Buscar</button>
    </form>

    <thead >
        <th>ID</th>
        <th>Nome</th>
        <th colspan="2">Ações</th>
    </thead>
    <tb >
        <?php
        foreach($data as $item){
            echo "<tr style='border:1px solid #000;'>
                <td style='border:1px solid #000;'>$item->id</td>
                <td  style='border:1px solid #000;'>$item->nome</td>
                <td style='border:1px solid #000;'><a href='./CategoriaForm.php?id=$item->id'>Editar</a> <a onclick='return confirm(\" Deseja realmete excluir?\")'href='./CategoriaList.php?id=$item->id'>Deletar</a></td>
            </tr>";
        }
        
        ?>
    </tb>
    <?php
    echo "<a href='./CategoriaForm.php'>Cadastrar</a>";
    ?>
</table>
