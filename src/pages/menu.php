<?php
session_start();
include_once 'conexão.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = intval($_POST['id_produto']);
    $id_usuario = intval($_SESSION['user']['id_usuario']);

    $query = "SELECT quantidade FROM cesta WHERE id_produto = ? AND id_usuario = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $id_produto, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nova_quantidade = $row['quantidade'] + 1;
        $update_query = "UPDATE cesta SET quantidade = ? WHERE id_produto = ? AND id_usuario = ?";
        $stmt_update = $mysqli->prepare($update_query);
        $stmt_update->bind_param("iii", $nova_quantidade, $id_produto, $id_usuario);
        $stmt_update->execute();
    } else {
        $insert_query = "INSERT INTO cesta (id_usuario, id_produto, quantidade) VALUES (?, ?, 1)";
        $stmt_insert = $mysqli->prepare($insert_query);
        $stmt_insert->bind_param("ii", $id_usuario, $id_produto);
        $stmt_insert->execute();
    }
    echo "Produto adicionado à cesta!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na Cantina | Menu</title>
    <link rel="stylesheet" href="../components/menu.css">
</head>
<body>
    <div class="menu">
        <a class="active" href="home.php">
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

    <div class="cabecalho">
        <div class="voltar">
            <a href="home.php" class="arrow-back">
                <img src="../../assets/arrow-left.png" alt="">
            </a>
        </div>
           
    <div class="logo">
        <img src="../../assets/logo1.svg" alt="logo">
    </div>
    </div>

    <div class="menu-secundario">
        <a href="#">
           <p>Doce</p>
        </a>
        <a href="">
            <p>Frescos</p>
        </a>
        <a href="#">
          <p>Cosméticos</p>
        </a>
        <a href="#">
            <p>Bedida</p>
        </a>
       </div> 

       <div class="menu-secundario-2">
        <a href="#Bolachas">
           <p>Bolachas</p>
        </a>
        <a href="#Rebuçados">
            <p>Rebuçados</p>
        </a>
        <a href="#Pirolitos">
          <p>Pirolitos</p>
        </a>
        <a href="#Pastilhas">
            <p>Pastilhas</p>
        </a>
       </div> 

       <div class="paragrafo">
        <a id="Bolachas">Bolachas</a>
       </div>

       <div class="caixa-deals">
        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <form method="POST" action="cesta.php">
                <input type="hidden" name="id_produto" value="2">
                <input type="hidden" name="acao" value="adicionar">
                <button class="mais" type="submit">+</button>
            </form>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>
       </div>

       <div class="paragrafo">
        <a id="Rebuçados">Rebuçados</a>
       </div>

       <div class="caixa-deals">
        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php"  class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>
       </div>

       <div class="paragrafo">
        <a id="Pirolitos">Pirolitos</a>
       </div>

       <div class="caixa-deals">
        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.php">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php"  class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php"  class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>
       </div>


       <div class="paragrafo">
        <a id="Pastilhas">Pastilhas</a>
       </div>

       <div class="caixa-deals">
        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php"  class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php"  class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php"  class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php"  class="reserva">Reservar Produto</a>
        </div>

        <div class="card">
            <img class="img-card" src="../../assets/nutella.svg" alt="">
            <a class="mais" href="./cesta.html">+</a>
            <p class="left-text">910Kz</p>
            <p class="left-text">Nutella Alcantra</p>
            <a href="../pages/reservas.php" class="reserva">Reservar Produto</a>
        </div>
       </div>
</body>
</html>




