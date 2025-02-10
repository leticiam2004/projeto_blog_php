<?php
ob_start();
include "admin/db.connect.php";
include "header.php";

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

// Se estiver editando um produto, busca os dados do produto
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM produtos WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $produto = mysqli_fetch_assoc($result);
}
?>

<!-- Formulário para adicionar ou editar produto -->
<?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')): ?>
    <div class="container mt-3">
        <h1><?= isset($produto) ? 'Editar Produto' : 'Adicionar Produto' ?></h1>
        <form action="produtos.php" method="POST" class="mt-5">
            <input type="hidden" name="id" value="<?= isset($produto) ? $produto['id'] : '' ?>">

            <label for="name">Nome do Produto:</label>
            <input type="text" name="nome" required class="form-control mb-3" value="<?= isset($produto) ? $produto['nome'] : '' ?>">

            <label for="price">Preço:</label>
            <input type="number" name="preco" required class="form-control mb-3" value="<?= isset($produto) ? $produto['preco'] : '' ?>">

            <label for="image">Link da Imagem:</label>
            <input type="text" name="image" required class="form-control mb-3" placeholder="Insira o link da imagem" value="<?= isset($produto) ? $produto['image'] : '' ?>">

            <button type="submit" class="btn btn-primary"><?= isset($produto) ? 'Salvar Alterações' : 'Adicionar Produto' ?></button>
        </form>
    </div>
<?php endif; ?>

<div class="container"><br>
    <div class="d-flex justify-content-center mb-3">
        <a href="produtos.php?action=add" class="btn btn-primary btn-sm">Adicionar um Novo Produto</a>
    </div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['nome'];
    $price = $_POST['preco'];
    $image = $_POST['image'];

    if (!empty($name) && !empty($price) && !empty($image)) {
        if ($id) {
            // Atualizar produto existente
            $sql = "UPDATE produtos SET nome='$name', preco='$price', image='$image' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = '<div class="alert alert-success">Produto atualizado com sucesso!</div>';
            } else {
                echo "Erro ao atualizar produto: " . mysqli_error($conn);
            }
        } else {
            // Adicionar novo produto
            $sql = "INSERT INTO produtos (nome, preco, image) VALUES ('$name', '$price', '$image')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = '<div class="alert alert-success">Produto adicionado com sucesso!</div>';
            } else {
                echo "Erro ao adicionar produto: " . mysqli_error($conn);
            }
        }
        header("Location: produtos.php");
        exit();
    } else {
        echo "Preencha todos os campos corretamente.";
    }
}

// Exibir todos os produtos
$sql = "SELECT * FROM produtos";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo '<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-auto">';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col">';
        echo '<div class="card mt-4 mb-4" style="width: auto;">';
        echo '<img class="card-img-top" src="' . htmlspecialchars($row['image']) . '" alt="item ' . htmlspecialchars($row['nome']) . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title font-weight-bold">' . htmlspecialchars($row['nome']) . '</h5>';
        echo '<p class="card-text">¥' . htmlspecialchars($row['preco']) . '</p>';
        echo '<a href="produtos.php?action=edit&id=' . htmlspecialchars($row['id']) . '" class="btn btn-warning btn-sm mr-2">Editar</a>';
        echo '<a href="produtos.php?action=delete&id=' . htmlspecialchars($row['id']) . '" class="btn btn-danger btn-sm">Excluir</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
} else {
    echo "Nenhum produto encontrado.";
}

// Excluir produto
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = '<div class="alert alert-danger">Produto excluído com sucesso!</div>';
        header("Location: produtos.php");
        exit();
    } else {
        echo "Erro ao excluir produto: " . $stmt->error;
    }
    $stmt->close();
}
?>
</div>
