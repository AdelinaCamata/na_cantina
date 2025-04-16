<?php
session_start();
include_once 'conexão.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = intval($_POST['id_produto']);
    $hora = $_POST['hora'];
    $endereco = $_POST['endereco'];
    $id_usuario = intval($_SESSION['user']['id_usuario']);

    $query = "INSERT INTO reserva (id_usuario, id_produto, hora_reserva, endereco) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("iiss", $id_usuario, $id_produto, $hora, $endereco);
    $stmt->execute();

    echo "Produto reservado com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na Cantina | Reservas</title>
    <link rel="stylesheet" href="../components/reservas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="menu">
        <a href="home.php">
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
            <a href="./cesta.php" class="arrow-back">
                <img src="../../assets/arrow-left.png" alt="">
            </a>
        </div>
           
        <div class="cesta">
            <a href="#" class="reserva">Reservas</a> 
            <a href="../pages/pedidos.php" class="reserva2">Pedidos</a>
             </div>
    </div>

    <div class="primeira-reserva">
        <div class="um">
            <div class="desc">
                <p>Iogurte Danone</p>
            </div>
            <div class="btns">
                <button>+</button>
                <span>1 Qua</span>
                <button>-</button>
            </div>
        </div>
        
        <div class="input">
            <span>Digite a hora que quer receber o produto:</span>
            <div>
                <input type="text" name="" placeholder="">
            </div>
        </div>
    </div>

    <form action="../pages/finalizar_reserva.php" class="form">
        <div class="input1">
            <div>
                <input type="text" name="" placeholder="Nome do Endereço">
            </div>
        </div>
        <div class="btns-login">
            <button>Confirmar Reserva</button>
        </div>
        <span>Às reservas duram até 2 horas</span>
    </form>
</body>
</html>












