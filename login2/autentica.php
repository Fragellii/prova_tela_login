<?php

include 'banco-conecta.php';
include 'helpers.php';

$dbbanco = new conexao;
$objconexao = $dbbanco->conectar();

$email = $_POST['email'];
$senha = $_POST['senha'];
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "SELECT * FROM tb_usuario WHERE ds_email = '" . $email . "'"; 

$comando = $objconexao->prepare($sql);
$comando->execute();
$rslogin = $comando->fetch();

if ($comando->rowCount() > 0){
    // $ok = password_verify($senha, $rslogin['ds_senha']);
    // echo $ok ? 'valido' : 'erro';
    // die();
   
    if (password_verify($senha, $rslogin['ds_senha'])){
     
        
        $_SESSION['email'] = $nome;
        setcookie('email', $nome, 3600);
        header('Location: dashboard.php');
    } else {
        // echo 'aq';
        // die();
        header('Location: errologin.php');
    }
} else {
    
    header('Location: errologin.php');
    die();
}

echo $rslogin['ds_nome'];
die();

?>
