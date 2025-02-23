<?php
// inicia a sessão para acessar variáveis da sessão atual
session_start();

// remove todas as variáveis da sessão
session_unset();

// destrói a sessão atual
session_destroy();

// redireciona o usuário para a página de login após o logout
header("Location: login.php");
exit();
?>