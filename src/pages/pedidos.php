<?php
session_start();
include_once 'conexão.php'; // Certifique-se de que o arquivo de conexão está correto

// Obter o ID do usuário logado
if (isset($_SESSION['user']['id_usuario'])) {
    $id_usuario = intval($_SESSION['user']['id_usuario']);
} else {
    die("Erro: Usuário não está logado.");
}

// Buscar as reservas do usuário
$query = "SELECT tempo_limite, endereco FROM reserva WHERE id_usuario = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($reserva = $result->fetch_assoc()) {
        echo "<p>Hora: " . htmlspecialchars($reserva['tempo_limite']) . "</p>";
        echo "<p>Endereço: " . htmlspecialchars($reserva['endereco']) . "</p>";
    }
} else {
    echo "<p>Você não possui reservas ativas.</p>";
}
?>
























<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na Cantina | Pedidos</title>
    <link rel="stylesheet" href="../components/pedidos.css">
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
    <header class="header">
        <div class="voltar">
            <a href="./reservas.php" class="btn-voltar">
                <img src="../../assets/left 1.svg" alt="voltar">
            </a>
        </div>
    </header>
        <div class="carro">
            <img src="../../assets/mdi_car.png" alt="">
            <span>Pedido à caminho.</span>
        </div>
        <div class="pedidos">
            <div class="primeiro-pedido">
                <div class="desc">
                    <p>Iogurte Danone</p>
                    <p>Solicitado às 19:30</p>
                </div>
                <!--<div class="primeiro-pedido">
                    <div class="desc">
                        <p>Iogurte Danone</p>
                        <p>Solicitado às 19:30</p>
                    </div>
                </div>-->
            </div>
       </div>

      <div class="butt">
        <div class="btns-login2">
            <a href="./cancelar_pedido.php" class="cinza">Cancelar Pedido</a>
        </div>
        <div class="btns-login">
           <a href="./home.php" class="cinza2">Página Inicial</a>
        </div>
      </div>
</body>
</html>