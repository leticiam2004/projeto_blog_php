<?php

ob_start();
// Conexão com o banco de dados
include "admin/db.connect.php";
include "header.php";

if (isset($_SESSION['message'])) {
    echo $_SESSION['message']; // Exibe a mensagem de sucesso
    unset($_SESSION['message']); // Remove a mensagem após exibição
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nome'];
    $price = $_POST['preco'];
    $image = $_POST['image'];

    // Verifica se os dados estão completos
    if (!empty($name) && !empty($price) && !empty($image)) {
        // Insere os dados no banco de dados
        $sql = "INSERT INTO produtos (nome, preco, image) VALUES ('$name', '$price', '$image')";
        if (mysqli_query($conn, $sql)) {
            // Mensagem de sucesso (Bootstrap)
            echo '<div class="alert alert-success" role="alert">Produto adicionado com sucesso!</div>';
        } else {
            echo "Erro ao adicionar produto: " . mysqli_error($conn);
        }
    } else {
        echo "Preencha todos os campos corretamente.";
    }
}

// Exibir todos os produtos
$sql = "SELECT * FROM produtos";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo '<div class="container">
            <div class="row row-cols-2 row-cols-lg-3 mx-auto">';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col">';
        echo '<div class="card mt-4 mb-4" style="width: auto;">';

        // Exibe a imagem diretamente do link armazenado
        echo '<img class="card-img-top" src="' . htmlspecialchars($row['image']) . '" alt="item ' . htmlspecialchars($row['nome']) . '">';

        // Exibe os outros detalhes do produto
        echo '<div class="card-body">';
        echo '<h5 class="card-title font-weight-bold">' . htmlspecialchars($row['nome']) . '</h5>';
        echo '<p class="card-text">¥' . htmlspecialchars($row['preco']) . '</p>';
        echo '<a href="produtos.php?action=delete&id=' . htmlspecialchars($row['id']) . '" class="btn btn-danger btn-sm" color: white;">Excluir produto</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div></div>';
} else {
    echo "Nenhum produto encontrado.";
}

// Excluir produto
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];  // Pega o ID do produto a ser excluído

    // Prepara a consulta para excluir o produto com o ID fornecido
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);  // Usa o ID para o parâmetro da consulta

    // Executa a consulta
    if ($stmt->execute()) {
        // Mensagem de sucesso armazenada na variável de sessão
        $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Produto excluído com sucesso!</div>';
        header("Location: produtos.php"); // Redireciona após a exclusão
        exit();
    } else {
        // Exibe erro caso falhe ao executar a consulta
        echo "Erro ao excluir produto: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();
}
?>
<div class="d-flex justify-content-center mt-3">
    <a href="produtos.php?action=add" class="btn btn-primary btn-sm mb-3">Adicionar um Novo Produto</a>
</div>


<!-- Formulário para adicionar produto -->
<?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
    <div class="ml-3 mb-3">
        <form action="produtos.php" method="POST" class="mt-5">
            <label for="name">Nome do Produto:</label>
            <input type="text" name="nome" required class="form-control mb-3">

            <label for="price">Preço:</label>
            <input type="number" name="preco" required class="form-control mb-3">

            <label for="image">Link da Imagem:</label>
            <input type="text" name="image" required class="form-control mb-3" placeholder="Insira o link da imagem">

            <button type="submit" class="btn btn-primary">Adicionar Produto</button>
        </form>
    </div>
<?php endif; ?>