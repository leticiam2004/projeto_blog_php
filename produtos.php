<?php
ob_start(); // inicia o buffer de saída
include "admin/db.class.php"; // inclui a classe de banco de dados
include "header.php"; // inclui o cabeçalho da página

// inicializa a conexão com o banco de dados
$db = new db('produtos');
$db->checkLogin(); // verifica se o usuário está logado
$db->checkAdminLogin(); // verifica se o usuário é admin
$conn = $db->conn(); // obtém a conexão PDO

// exibe e remove a mensagem de sessão (feedback para o usuário)
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

// lógica para editar um produto específico
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('SELECT * FROM produtos WHERE id = ?');
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
}

// lógica de pesquisa
$search = $_POST['search'] ?? ''; // verifica se houve pesquisa

if ($search) {
    // busca produtos pelo nome (ignora maiúsculas/minúsculas)
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE LOWER(nome) LIKE LOWER(?)");
    $stmt->execute(['%' . $search . '%']);
} else {
    // sem pesquisa, exibe todos os produtos
    $stmt = $conn->query("SELECT * FROM produtos");
}

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- formulário para adicionar/editar produto -->
<?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')): ?>
    <div class="container mt-3">
        <h1><?= isset($produto) ? 'Editar Produto' : 'Adicionar Produto' ?></h1>
        <form action="produtos.php" method="POST" class="mt-5">
            <input type="hidden" name="id" value="<?= $produto['id'] ?? '' ?>">

            <label for="name">Nome do Produto:</label>
            <input type="text" name="nome" required class="form-control mb-3" value="<?= $produto['nome'] ?? '' ?>">

            <label for="price">Preço:</label>
            <input type="number" name="preco" required class="form-control mb-3" value="<?= $produto['preco'] ?? '' ?>">

            <label for="image">Link da Imagem:</label>
            <input type="text" name="image" required class="form-control mb-3" placeholder="Insira o link da imagem"
                value="<?= $produto['image'] ?? '' ?>">

            <button type="submit" class="btn"
                style="background-color: #30A7D6; color: white;"><?= isset($produto) ? 'Salvar Alterações' : 'Adicionar Produto' ?></button>
        </form>
    </div>
<?php endif; ?>

<div class="container"><br>
    <div class="container" style="max-width: 80vw; margin: 0 auto;">

        <!-- formulário de pesquisa -->
        <form action="produtos.php" method="post" class="mb-4">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome"
                    value="<?= htmlspecialchars($search) ?>">
            </div>
            <button type="submit" class="btn" style="background-color: #30A7D6; color: white;">Buscar</button>
        </form>
        <div class="d-flex justify-content-center mb-3">
            <a href="produtos.php?action=add" class="btn" style="background-color: #30A7D6; color: white;">Adicionar um
                Novo Produto</a>
        </div>

        <?php
        // processamento de adição ou edição de produtos
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['search'])) {
            $id = $_POST['id'] ?? null;
            $name = $_POST['nome'] ?? '';
            $price = $_POST['preco'] ?? '';
            $image = $_POST['image'] ?? '';

            if ($name && $price && $image) {
                if ($id) {
                    // atualiza produto existente
                    $stmt = $conn->prepare("UPDATE produtos SET nome = ?, preco = ?, image = ? WHERE id = ?");
                    $stmt->execute([$name, $price, $image, $id])
                        ? $_SESSION['message'] = '<div class="alert alert-success">Produto atualizado com sucesso!</div>'
                        : print ("Erro ao atualizar produto: " . $stmt->errorInfo()[2]);
                } else {
                    // adiciona novo produto
                    $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, image) VALUES (?, ?, ?)");
                    $stmt->execute([$name, $price, $image])
                        ? $_SESSION['message'] = '<div class="alert alert-success">Produto adicionado com sucesso!</div>'
                        : print ("Erro ao adicionar produto: " . $stmt->errorInfo()[2]);
                }
                header("Location: produtos.php");
                exit();
            } else {
                echo "Preencha todos os campos corretamente.";
            }
        }

        // exibição dos produtos
        if (count($produtos) > 0) {
            echo '<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-auto">';
            foreach ($produtos as $row) {
                echo '<div class="col">';
                echo '<div class="card mt-4 mb-4" style="width: auto;">';
                echo '<img class="card-img-top" src="' . htmlspecialchars($row['image']) . '" alt="item ' . htmlspecialchars($row['nome']) . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title font-weight-bold">' . htmlspecialchars($row['nome']) . '</h5>';
                echo '<p class="card-text">¥' . htmlspecialchars($row['preco']) . '</p>';
                echo '<a href="produtos.php?action=edit&id=' . htmlspecialchars($row['id']) . '" class="btn btn-warning btn-sm mr-2">Editar</a>';
                echo '<a href="produtos.php?action=delete&id=' . htmlspecialchars($row['id']) . '" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Excluir</a>';
                echo '</div></div></div>';
            }
            echo '</div>';
        } else {
            echo "Nenhum produto encontrado.";
        }

        // lógica para excluir produto
        if (isset($_GET['id']) && $_GET['action'] == 'delete') {
            $id = $_GET['id'];
            $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
            $stmt->execute([$id])
                ? $_SESSION['message'] = '<div class="alert alert-danger">Produto excluído com sucesso!</div>'
                : print ("Erro ao excluir produto: " . $stmt->errorInfo()[2]);
            header("Location: produtos.php");
            exit();
        }
        ?>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Tem certeza que deseja excluir este produto?");
        }
    </script>
</div>