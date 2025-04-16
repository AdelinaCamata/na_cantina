<?php
session_start();

include_once 'conexão.php';
include_once '../functions/security_password.php';
include_once '../functions/isAuthenticated.php';

notAllowedWhenTheresAnAuthentication();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_POST['email']) || !empty($_POST['palavra_pass'])) {
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $password = trim(mysqli_real_escape_string($mysqli, $_POST['palavra_pass']));
    
        $queryIfMailExists = "
            SELECT * FROM usuario WHERE email = '{$email}'
        ";

        $emailExistsResult = mysqli_query($mysqli, $queryIfMailExists);
        $userData = mysqli_fetch_array($emailExistsResult, MYSQLI_ASSOC);

        if($userData && count($userData) > 0) {
            if($userData['palavra_pass'] === md5($password)) {
                session_regenerate_id();

                $_SESSION['isAuthenticated'] = true;
                $_SESSION['user'] = $userData;
                header("location: home.php?email=$email");
                 
            } else {
                header("location: login.php?status=failed&msg=Informe uma senha valida!");    
            }
        }else{
            header("location: login.php?status=failed&msg=Usuario nao existe, crie um conta");
        }

       // $query = "
           // INSERT INTO usuario ( email, palavra_pass) 
                  // VALUES ('{$email}', '{$passwordHash}', '')
       // ";
    
       // $result = mysqli_query($mysqli, $query);
    
       // if($result) {
           // header("location: home.php");      
        //} else {
          //  header("location: registrar.php?status=failed&msg=Usuario ou senha invalido, tente novamente!");
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

    <form action="login.php" class="form" method="post">
        <div for="" class="input">
            <span>Email</span>
            <div>
                <input type="email" name="email" id="email" placeholder="debra.holt@example.com" onkeyup="emailVerification()">
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

        <div class="lembrar">
            <div>
                <input type="checkbox" name="" id="lembrar">
                <span>Lembrar de mim</span>
            </div>

            <a href="#">Esqueceu a palavra-passe?</a>
        </div>
        
        <div class="btns-login">
            <button>Iniciar sessão</button>
            <a href="#">
                <img src="../../assets/Google.png" alt="google">
                <span>Entrar com o Google</span>
            </a>
        </div>

        <div class="regista">
            <span>Não tem uma conta?</span>
            <a href="./cadastro.php">Registe-se</a>
        </div>
    </form>
<script src="../scripts/login.js"></script>
</body>
</html>