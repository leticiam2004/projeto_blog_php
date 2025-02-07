<?php include "./header.php";?>
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
                            <a class="nav-link font-weight-bold" href="paginas/sobre.php">Sobre nós</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link font-weight-bold" href="paginas/produtos.php">Loja<span class="sr-only">(Página
                                    atual)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="paginas/contato.php">Contato</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <br>
    <br>
    <br>
    <br>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Catálogo</h1>
            <p class="lead">Os produtos de melhor qualidade para os melhores treinadores!</p>
        </div>
    </div>
    <div class="container">
        <div class="row row-cols-2 row-cols-lg-3 mx-auto">

            <!-- pokeballs -->
            <div class="col">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-ball-pokeball.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Pokéball</h5>
                        <p class="card-text">¥200</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-ball-greatball.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">GreatBall</h5>
                        <p class="card-text">¥600</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-ball-ultraball.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">UltraBall</h5>
                        <p class="card-text">¥1200</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>

            <!-- potions -->
            <div class="col-4 col-lg-2">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-heal-poison.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Cura Veneno</h5>
                        <p class="card-text">¥100</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-4 col-lg-2">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-heal-paralyze.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Cura Paralisia</h5>
                        <p class="card-text">¥200</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-4 col-lg-2">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-heal-sleep.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Cura Sono</h5>
                        <p class="card-text">¥250</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>

            <div class="col-4 col-lg-2">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-heal-burn.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Cura Queimadura</h5>
                        <p class="card-text">¥250</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-4 col-lg-2">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-heal-ice.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Cura Gelo</h5>
                        <p class="card-text">¥250</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-4 col-lg-2">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-heal-full.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Cura Completa</h5>
                        <p class="card-text">¥600</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>

            <!-- poções -->
            <div class="col-3 col-lg-3">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-potion.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Poção</h5>
                        <p class="card-text">¥300</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-lg-3">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-potion-super.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Super Poção</h5>
                        <p class="card-text">¥700</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-lg-3">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-potion-hyper.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Hiper Poção</h5>
                        <p class="card-text">¥1200</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-lg-3">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-potion-max.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Poção Máxima</h5>
                        <p class="card-text">¥2500</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>

            <!-- repel e revive -->
            <div class="col-3 col-lg-3">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-revive.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Reviver</h5>
                        <p class="card-text">¥1500</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-lg-3">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-repel.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Repelente</h5>
                        <p class="card-text">¥350</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-lg-3">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-repel-super.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Super Repelente</h5>
                        <p class="card-text">¥500</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-lg-3">
                <div class="card mt-4 mb-4" style="width: auto;">
                    <img class="card-img-top" src="../img/item-repel-max.png" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Repelente Máximo</h5>
                        <p class="card-text">¥700</p>
                        <a href="#" class="btn" style="background-color: #30A7D6; color: white;"
                            onclick="AddCarrinho()">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
<?php include "./footer.php";?>