<?php
include "admin/db.connect.php";
include "admin/db.class.php";
include "header.php";


// fetch
$db = new db('produtos');
$products = $db->all();

if(!empty($_GET["id"])){
    $db->destroy($_GET["id"]);
    header("location: user_produtos.php");
}
if(!empty(($_POST))){
    $products = $db->filter($_POST);
}else{
    $products = $db->all();
}
var_dump($products)
?>


<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Catálogo</h1>
        <p class="lead">Os produtos de melhor qualidade para os melhores treinadores!</p>
    </div>

</div>
<div class="container">
<form action="user_produtos.php" method="post">
    <div class="btn-group">
    <select class="form-select" name="tipo" id="">
            <option value="nome">Nome</option>
        </select>
        <input class="form-control" type="text" name="valor">
        <button class="btn btn-success" type="submit">Buscar</button>
    </div>
    </form>
<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-auto">

        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="<?= htmlspecialchars($product['image']); ?>"
                        alt="item <?= htmlspecialchars($product['nome']); ?>">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"><?= htmlspecialchars($product['nome']); ?></h5>
                        <p class="card-text">¥<?= htmlspecialchars($product['preco']); ?></p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include "footer.php"; ?>