<?php
include_once 'conexão.php';
include_once '../functions/logout.php';
include_once '../functions/isAuthenticated.php';

hasAuthenticated();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['execute_button'])) {
        logout();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Na Cantina</title>
    <link rel="stylesheet" href="../components/home.css">
</head>
<body>
    <div class="menu">
        <a class="active" href="#">
            <img src="../../assets/casa.svg" alt="">
        </a>
        <a href="./pesquisar.php">
            <img src="../../assets/Lupa da barra.png" alt="">
        </a>
        <a class="cesto" href="./cesta.php">
            <img src="../../assets/cesto.svg" alt="">
            <span>4</span>
        </a>
     <a href="./perfil1.php">
            <img src="../../assets/guy.png" alt="">
        </a>
    </div>

    <div class="logo">
        <img src="../../assets/logo1.svg" alt="logo">
    </div>

    <div class="rotulo">
        <img src="../../assets/Não maia.png
        " alt="">
    </div>

    <div class="caixa-deals">
        <div class="card">
          <a href="../pages/menu.php">
            <img src="../../assets/frutas.svg" alt="">
            <p class="left-text">Frutas</p>
          </a>
        </div>

        <div class="card">
          <a href="../pages/menu.php">
            <img src="../../assets/peixes.svg" alt="">
            <p class="left-text">Frescos</p>
          </a>
        </div>

        <div class="card">
           <a href="../pages/menu.php">
            <img src="../../assets/vegetais.svg" alt="">
            <p class="left-text">Vegetais</p>
           </a>
        </div>

        <div class="card">
           <a href="../pages/menu.php">
            <img src="../../assets/gelado.svg" alt="">
            <p class="left-text">Gelados</p>
           </a>
        </div>
        <div class="card">
           <a href="../pages/menu.php">
            <img src="../../assets/fuba.svg" alt="">
            <p class="left-text">Fuba</p>
           </a>
        </div>

        <div class="card">
            <a href="../pages/menu.php">
                <img src="../../assets/cosméticos.svg" alt="">
            <p class="left-text">Cosméticos</p>
            </a>
        </div>

        <div class="card">
         <a href="../pages/menu.php">
            <img src="../../assets/chocolate.svg" alt="" class="bebe">
            <p class="left-text">Doces</p>
         </a>
        </div>

        <div class="card">
         <a href="../pages/menu.php">
            <img src="../../assets/Bebé.png" alt="" class="bebe">
            <p class="left-text">Bebé</p>
         </a>
        </div>

        <div class="card">
           <a href="../pages/menu.php">
            <img src="../../assets/peixes.svg" alt="">
            <p class="left-text">Frescos</p>
           </a>
        </div>
        
    </div>

<script src="../scripts/search.js"></script>
</body>
</html>