<?php
include "admin/db.class.php"; // inclui a classe de conexão com o banco de dados
include "header.php"; // inclui o cabeçalho com o bootstrap

// inicializar database produtos
$db = new db('produtos'); // conecta à tabela 'produtos'
$db->checkLogin(); // verifica se o usuário está logado

// fetch dos produtos
$products = $db->all(); // pega todos os produtos da tabela

// Verifica se há pesquisa
if (!empty($_POST['search'])) {
    $searchTerm = $_POST['search']; // armazena o termo de pesquisa

    // Se o termo de pesquisa não estiver vazio
    if (!empty($searchTerm)) {
        // filtra os produtos pelo nome
        $products = $db->filter(['nome' => $searchTerm], 'nome');
    } else {
        // se o termo estiver vazio, exibe todos os produtos
        $products = $db->all();
    }
}
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Catálogo</h1>
        <p class="lead">Os produtos de melhor qualidade para os melhores treinadores!</p>
    </div>
</div>

<!-- formulário de busca -->
<div class="container">
    <form action="user_produtos.php" method="post" class="mb-4">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome"
                value="<?= isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
        </div>
        <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Buscar</button>
    </form>

    <!-- renderiza os produtos -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-auto">
        <?php if (!empty($products)): ?>
            <!-- loop para exibir cada produto -->
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card mt-4 mb-4" style="width: auto;">
                        <!-- imagem do produto -->
                        <img class="card-img-top" src="<?= htmlspecialchars($product->image); ?>"
                            alt="item <?= htmlspecialchars($product->nome); ?>">
                        <div class="card-body">
                            <!-- título e preço do produto -->
                            <h5 class="card-title font-weight-bold"><?= htmlspecialchars($product->nome); ?></h5>
                            <p class="card-text">¥<?= htmlspecialchars($product->preco); ?></p>
                            <!-- botão de adicionar ao carrinho -->
                            <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                                onclick="AddCarrinho()">Adicionar ao carrinho</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p> <!-- caso não haja produtos -->
        <?php endif; ?>
    </div>
</div>

<?php include "footer.php"; // inclui o rodapé ?>