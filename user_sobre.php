<?php include "admin/db.class.php";
include "header.php";

$db = new db('users');
$db->checkLogin();
?>


<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link font-weight-bold" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link font-weight-bold" href="user_sobre.php">Sobre nós<span class="sr-only">(Página
                    atual)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="user_produtos.php">Loja</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="user_contato.php">Contato</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="login.php">Login</a>
        </li>
    </ul>
</div>
</nav>
</div>
</header>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Nossa história</h1>
        <p class="lead">A PokéMart é um lugar onde você pode comprar itens para seus Pokémon. Há pessoas com
            quem conversar que podem dar dicas sobre alguns dos itens. Este prédio pode ser encontrado em quase
            todas as cidades e vilas, com exceção de cidades como Goldenrod ou Celadon, que têm uma Loja
            de Departamentos em vez de uma PokéMart. As PokéMarts são administradas pela Silph Co. Desde Pokémon
            Black and White, a PokéMart foi integrada ao Centro Pokémon.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="https://iili.io/2b9QJII.jpg" alt="PM GEN1">
                <div class="card-body">
                    <h5 class="card-title">Primeira geração - 1996</h5>
                    <p class="card-text">O clássico Poké Mart de Viridian City, onde tudo começou. Uma parada
                        essencial para novos treinadores em sua jornada</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="https://iili.io/2b9QdXt.jpg" alt="PM GEN2">
                <div class="card-body">
                    <h5 class="card-title">Segunda geração (Kanto) - 1999</h5>
                    <p class="card-text">Com novos itens e surpresas, esta loja é um ponto de encontro popular para
                        treinadores explorando a região de Kanto.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="https://iili.io/2b9Q2LX.jpg" alt="PM GEN2 1">
                <div class="card-body">
                    <h5 class="card-title">Segunda geração (Johto) - 1999</h5>
                    <p class="card-text">Bem-vindo ao Johto! Este Poké Mart oferece produtos de última geração para
                        sua aventura regional.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="https://iili.io/2b9QK1s.jpg" alt="PM GEN3">
                <div class="card-body">
                    <h5 class="card-title">Terceira geração (Hoenn) - 2002</h5>
                    <p class="card-text">Em Hoenn, a Poké Mart tem tudo que você precisa para enfrentar as condições
                        desafiadoras e os diversos Pokémon da região.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="https://iili.io/2b9QfrG.jpg" alt="PM GEN3 1">
                <div class="card-body">
                    <h5 class="card-title">Terceira geração (Kanto) - 2002</h5>
                    <p class="card-text">Uma Poké Mart renovada em Kanto, trazendo itens exclusivos para os
                        treinadores mais dedicados.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="https://iili.io/2b9QB2f.jpg" alt="PM GEN4">
                <div class="card-body">
                    <h5 class="card-title">Quarta geração - 2006</h5>
                    <p class="card-text">Explore Sinnoh com os melhores suprimentos! Este Poké Mart está sempre
                        pronto para ajudar em sua jornada épica.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>