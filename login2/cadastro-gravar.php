<?php
require_once 'banco-conecta.php';

// Função para cadastrar um novo usuário

include 'helpers.php';

$dbbanco = new conexao;

$objconexao = $dbbanco->conectar();

$nome = $_POST['usuario'];
$senha = $_POST['senha'];
$email = $_POST['email'];

    if ($nome === ''){
      echo("Informe um login");
    } 
    if ($senha === ''){
      echo("Informe uma senha");
    }
    if ($email === ''){
        echo('Informe um email');
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $dados = [
        'nome' => $nome, 
        'senhaHash' => $senha,
        'email' => $email
    ];
    $sql = "INSERT INTO tb_usuario (id_usuario, ds_email, ds_nome, id_status, ds_senha) VALUES (NULL, :email, :nome, 0, :senhaHash)";
    $comando = $objconexao->prepare($sql);
    

    if ($comando->execute($dados) === true) {
        $_SESSION['email'] = $email;
        header('Location: dashboard.php');
        
    } else {
        header('Location: errocadastro.php'); 
    }



?>