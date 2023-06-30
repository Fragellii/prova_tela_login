<?php

session_start();
//Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    
    header('Location: login.php'); // Redireciona para a página de login se o usuário não estiver logado
    exit();
}

// Obtém o email do usuário logado
$email = $_SESSION['email'];
// $email_cookie = $_COOKIE['email']; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Painel de Controle</title>
</head>
<body>
    <h1>Bem-vindo ao Painel de Controle</h1>
    <p>Usuário logado: <?php echo $email; ?></p>
   

    <a href="login.php">Sair</a>
</body>
</html>
