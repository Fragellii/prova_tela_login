<?php
 session_start();
include 'banco-conecta.php';

$dbbanco = new conexao;
$objconexao = $dbbanco->conectar();

try {
    $objconexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>

  

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Tela de Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($erroLogin)) { ?>
        <p><?php echo $erroLogin; ?></p>
    <?php } ?>

    <?php if (isset($erroCadastro)) { ?>
        <p><?php echo $erroCadastro; ?></p>
    <?php } ?>


    <div class="container">
        
    <img src="juntojunto.png" alt="Logo Audio Vortex">
        <form method="post" action="autentica.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="login">Entrar</button>
        </form>

        <form method="post" action="">
            <a href="cadastro.php"><button type="button">Cadastrar Usuário</button></a>
        </form>
    </div> -->

    
</body>
</html>