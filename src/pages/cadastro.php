<?php
session_start();

include_once 'conexão.php';
include_once '../functions/security_password.php';
include_once '../functions/isAuthenticated.php';

notAllowedWhenTheresAnAuthentication();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_POST['nome']) || !empty($_POST['email']) || !empty($_POST['palavra_pass'])) {
        $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $password = trim(mysqli_real_escape_string($mysqli, $_POST['palavra_pass']));
    
        $queryIfMailExists = "
            SELECT email FROM usuario WHERE email = '{$email}'
        ";

        $emailExistsResult = mysqli_query($mysqli, $queryIfMailExists);
        $userData = mysqli_fetch_array($emailExistsResult, MYSQLI_ASSOC);

        if($userData && count($userData) > 0) {
            header("location: cadastro.php?status=failed&msg=Usuario ja existe, tente um outro");
        } else {
            // $passwordHash = trim(encryptPassword($password));

            $query = "
                INSERT INTO usuario (nome_usuario, numero, email, palavra_pass, endereco_usuario) 
                    VALUES ('{$nome}', '', '{$email}', '". md5($password) ."', '')
            ";
    
            $result = mysqli_query($mysqli, $query);
    
            if($result) {
                header("location: home.php?status=success&msg=Usuario cadastrado com sucesso");      
            } else {
                header("location: cadastro.php?status=failed&msg=Usuario ou senha invalido, tente novamente!");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../components/login.css">
    <link rel="stylesheet" href="../components/error.css">
    <link rel="stylesheet" href="../utils/screen.css">
    <link rel="stylesheet" href="../utils/flexbox.min.css">
</head>
<body>
    <div class="logo">
        <img src="../../assets/logo1.svg" alt="logo">
    </div>
    <div class="desc">
        <h2>Na Cantina</h2>
        <p>Preencha os seus dados para aceder à sua conta.</p>
    </div>

    <?php
        if(isset($_GET['status'])):
    ?>
        <div class="box-error <?= $_GET['status'] === 'failed' ? 'failed' : 'success' ?>">
            <p><?= $_GET['msg'] ?></p>
        </div>
    <?php endif; ?>

    <form action="cadastro.php" class="form" method="POST">
        <div for="" class="input">
            <span>Nome</span>
            <div>
                <input type="text" name="nome" id="name" placeholder="Seu Nome" required>
                <img src="../../assets/Icon (1).svg" alt="clean" class="clean2" onclick="Clean2()">
            </div>
            <p id="errorNome"></p>
        </div>

        <div for="" class="input">
            <span>Email</span>
            <div>
                <input type="email" name="email" id="email" placeholder="debra.holt@example.com" onkeyup="emailVerification()" required>
                <img src="../../assets/Icon (1).svg" alt="clean" class="clean" onclick="Clean()">
            </div>
            <p id="errorEmail"></p>
        </div>

        <div for="" class="input">
            <span>Palavra-passe</span>
            <div>
                <input type="password" name="palavra_pass" id="password" placeholder="••••••••" onkeyup="PassWordVerification()" required>
                <img src="../../assets/Icon.svg" alt="view" class="ViewPassWord">
            </div>
            <p id="errorPass"></p>
        </div>
        
        <div class="btns-login">
            <button>Criar Conta</button>
            <a href="#">
                <img src="../../assets/Google.png" alt="google">
                <span>Entrar com o Google</span>
            </a>
        </div>

        <div class="regista">
            <span>Já tem uma conta?</span>
            <a href="./login.php">Iniciar sessão</a>
        </div>
    </form>
<script src="../scripts/login.js"></script>
</body>
</html>