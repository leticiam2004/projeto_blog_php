<?php include "admin/db.class.php"; ?>
<?php include "header.php"; ?>
<?php
$db = new db('users');
$db->checkLogin();
$db->checkAdminLogin();
?>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Painel de Administração</h2>

    <!-- menu de navegação -->
    <ul class="list-group">
        <li class="list-group-item">
            <a href="users.php" class="text-decoration-none">Gerenciar Usuários</a>
        </li>
        <li class="list-group-item">
            <a href="produtos.php" class="text-decoration-none">Gerenciar Produtos</a>
        </li>
        <li class="list-group-item">
            <a href="contatos.php" class="text-decoration-none">Ver Tickets</a>
        </li>
    </ul>
</div>