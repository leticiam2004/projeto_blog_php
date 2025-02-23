<?php
include "admin/db.class.php"; // conexão com o banco de dados via PDO
include "header.php"; // importa o cabeçalho, já com bootstrap incluso

// instancia a classe db e inicializa a conexão
$db = new db('contato'); // 'contato' é o nome da tabela
$db->checkLogin(); // verifica se o usuário está logado
$conn = $db->conn(); // obtém a conexão com o banco de dados

// inicializa a variável de mensagem
$message = "";

// verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // obtém os dados do formulário
    $nome_completo = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $problema = $_POST['problema'];

    // prepara a consulta SQL para inserção de dados
    $sql = "INSERT INTO contato (nome_completo, email, assunto, problema) 
            VALUES (:nome_completo, :email, :assunto, :problema)";

    try {
        // prepara a declaração SQL
        $stmt = $conn->prepare($sql);

        // associa os parâmetros aos valores
        $stmt->bindParam(':nome_completo', $nome_completo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':assunto', $assunto);
        $stmt->bindParam(':problema', $problema);

        // executa a consulta
        if ($stmt->execute()) {
            $message = "Dados enviados com sucesso!"; // mensagem de sucesso
        } else {
            $message = "Erro ao enviar dados."; // mensagem de erro caso falhe a inserção
        }
    } catch (PDOException $e) {
        // captura erro de PDO e exibe a mensagem de erro
        $message = "Erro ao enviar dados: " . $e->getMessage();
    }
}

?>

<div class="collapse navbar-collapse" id="navbarNav">

    <ul class="navbar-nav">
        <!-- menu de navegação -->
        <li class="nav-item ">
            <a class="nav-link font-weight-bold" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="user_sobre.php">Sobre nós</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="user_produtos.php">Loja</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link font-weight-bold" href="user_contato.php">Contato<span class="sr-only">(Página
                    atual)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="login.php">Login</a>
        </li>
    </ul>
</div>
</nav>
</div>
</header>

<div class="container mt-4 mb-5">
    <h1>Entre em contato!</h1>
    <!-- formulário de contato -->
    <form method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput1">Nome completo</label>
            <input type="name" class="form-control" id="nome" name="nome" placeholder="Jessie Rocket" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Endereço de email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Assunto</label>
            <select class="form-control" id="assunto" name="assunto" required>
                <!-- opções para assunto -->
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
            <textarea class="form-control" id="problema" name="problema" rows="3" required></textarea>
        </div>

        <!-- botão de envio do formulário -->
        <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Enviar</button>

        <!-- exibe a mensagem após envio do formulário -->
        <?php if (isset($message) && $message != "") {
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

<?php include "footer.php"; ?> <!-- inclui o rodapé da página -->