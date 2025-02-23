<?php session_start();?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PokéMart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="stylesheet.css" />
    <link rel="icon" href="https://iili.io/2b9Q9mN.png">
</head>

<body>
    <header class="text-white py-3" style="background-color: #e23a26">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="index.php">
                    <img src="https://iili.io/2b9Q9mN.png" id="logo" alt="PokéMart" />
                </a>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="user_sobre.php">Sobre nós</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="user_produtos.php">Loja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="user_contato.php">Contato</a>
                        </li>


                        <?php if (isset($_SESSION['user_id'])): ?>
                            <!-- Show the Logout link if the user is logged in -->
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" href="logout.php">Logout</a>
                            </li>

                            <!-- Check if the user is an admin -->
                            <?php if ($_SESSION['admin'] == true): ?>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" href="admin_painel.php">Painel Admin</a>
                                </li>
                            <?php endif; ?>

                        <?php else: ?>
                            <!-- Show the Login link if the user is not logged in -->
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" href="login.php">Login</a>
                            </li>
                        <?php endif; ?>



                    </ul>
                </div>
            </nav>
        </div>
    </header>