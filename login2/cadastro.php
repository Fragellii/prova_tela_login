<?php
session_start();
include 'banco-conecta.php';



    function existe($nome, $email){
        $dbbanco = new conexao;
        $objconexao = $dbbanco->conectar();
        
        $sql = "select *FROM tb_usuario WHERE ds_nome = '". $nome . "' and ds_email = '". $email . "'"; 
        $comando = $objconexao->prepare($sql);
        $comando->execute();
        $rslogin = $comando->fetchall(PDO::FETCH_OBJ);
        
        if ($comando->rowcount() > 0){
           return true;
        } else {
            return false;
        }
    }
    


// Função para cadastrar um novo usuário
function cadastrarUsuario($nome, $email, $senha)
{
    $dbbanco = new conexao;
    $objconexao = $dbbanco->conectar();
    
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    if(existe($nome, $email) === true){
        echo 'Usuário já existe';
        return;
    }

    $sql = "INSERT INTO tb_usuario (id_usuario, ds_email, ds_nome, id_status, ds_senha) VALUES (NULL, '$email', '$nome', 0, '$senhaHash')";
    $comando = $objconexao->prepare($sql);
    $return = $comando->execute();
    if ($return === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Verifica se o formulário de cadastro foi enviado
if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (cadastrarUsuario($nome, $email, $senha)) {
        $_SESSION['email'] = $email;
        setcookie('email', $email, time()+20*24*60*60);
        header('Location: dashboard.php'); // Redireciona para a página do painel de controle
        exit();
    } else {
        $erroCadastro = 'Erro ao cadastrar usuário.';
    }
}
else {
    $_SESSION['email'] = '';
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Usuário</title>
</head>
<body>
    
    

    <?php if (isset($erroCadastro)) { ?>
        <p><?php echo $erroCadastro; ?></p>
    <?php } ?>

    <?php if (isset($_SESSION['email'])) { ?>
        <?php 
            if($_SESSION['email'] !== ''){            ?>
        <p>Cadastro feito com sucesso!</p>
        <?php unset($_SESSION['email']); 
        }?>
    <?php } ?>

    <h1>Cadastro de Usuário</h1>

    <div class="container">
    <img src="juntojunto.png" alt="Logo Audio Vortex">
        

        <?php if (isset($_SESSION['mensagem'])) { ?>
            <p><?php echo $_SESSION['mensagem']; ?></p>
            <?php unset($_SESSION['mensagem']); ?>
        <?php } ?>

        <form method="post" action="cadastro.php">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>

            <button type="submit" name="cadastro">Cadastrar</button>
        </form>
    </div>

    <!-- <form method="post" action="">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" name="cadastro">Cadastrar</button>
    </form> -->
</body>
</html>
