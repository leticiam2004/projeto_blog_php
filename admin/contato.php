<?php include "header.php"; ?>
<?php include "db.connect.php"; ?>
<?php

if (isset($_GET['test_message']) && $_GET['test_message'] == 'true') {
    $message = "Mensagem de teste: Dados enviados com sucesso!";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // receber dados do formulario 

    $nome_completo = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $situacao = $_POST['situacao'];

    // preparar query 

    $sql = "INSERT INTO contato (nome_completo, email, assunto, situacao) VALUES ('$nome_completo', '$email', '$assunto', '$situacao')";

    // inserir query

    if ($conn->query($sql) === TRUE) {
        $message = "Dados enviados com sucesso!";
    } else {
        $message = "Erro ao enviar dados: " . $conn->error;
    }

    // encerrar conexao

    $conn->close();

}

?>
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
                <a class="nav-link font-weight-bold" href="sobre.php">Sobre nós</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" href="produtos.php">Loja</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link font-weight-bold" href="contato.php">Contato<span class="sr-only">(Página
                        atual)</span></a>
            </li>
        </ul>
    </div>
</nav>
</div>
</header>

<div class="container mt-4 mb-5">

    <form method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput1">Nome completo</label>
            <input type="name" class="form-control" id="nome" name="nome" placeholder="Jessie Rocket">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Endereço de email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Assunto</label>
            <select class="form-control" id="assunto" name="assunto">
                <option>Dúvidas sobre produtos</option>
                <option>Problemas com o pedido</option>
                <option>Sugestões de novos produtos</option>
                <option>Feedback sobre a experiência de compra</option>
                <option>Suporte técnico</option>
                <option>Questões sobre entrega</option>
                <option>Informações sobre promoções</option>
                <option>Cancelamento de pedido</option>
                <option>Outras questões</option>
            </select>

        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Por favor, descreva sua situação</label>
            <textarea class="form-control" id="situacao" name="situacao" rows="3"></textarea>
        </div>

        <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Enviar</button>

        <?php if (isset($message)) {
            echo "<div class='alert alert-info mt-2'>$message</div>";
        } ?>

    </form>
</div>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Nossa localização</h1>
        <p class="lead">11-1 Hokotate-cho, Kamitoba, Minami-ku, Kyoto 601-8501, Japão</p>
        <iframe width="700" height="350"
            src="https://www.openstreetmap.org/export/embed.html?bbox=139.69768255949023%2C35.66131267755379%2C139.69962716102603%2C35.66253521852611&amp;layer=mapnik"
            style="border: 1px solid black">
        </iframe>
        <br />
        <small>
            <a target="_blank" href="https://www.openstreetmap.org/#map=19/35.661924/139.698655">Ver mapa maior</a>
        </small>
    </div>
</div>

<?php include "footer.php"; ?>