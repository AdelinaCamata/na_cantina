<?php
session_start();
include_once 'conexão.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user']['id_usuario'])) {
    die("Erro: Usuário não está logado.");
}

$id_usuario = intval($_SESSION['user']['id_usuario']);

// Processar adição ou subtração de produtos na cesta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = isset($_POST['id_produto']) ? intval($_POST['id_produto']) : null;
    $quantidade_compra = isset($_POST['quantidade_compra']) ? intval($_POST['quantidade_compra']) : 0;

    if($id_produto && $id_usuario) {
        $query = "SELECT quantidade_compra FROM reserva WHERE id_usuario = ? AND id_produto = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ii", $id_usuario, $id_produto);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if(isset($_POST["increase"])) {
            $nova_quantidade_compra = $row['quantidade_compra'] + 1;

            if($nova_quantidade_compra <= 10) {
                $update_query = "UPDATE reserva SET quantidade_compra = ? WHERE id_usuario = ? AND id_produto = ?";
                $stmt_update = $mysqli->prepare($update_query);
                $stmt_update->bind_param("iii", $nova_quantidade_compra, $id_usuario, $id_produto);
                $stmt_update->execute();
            }
        }

        if(isset($_POST["decrease"])) {
            $nova_quantidade_compra = $row['quantidade_compra'] - 1;

            if($nova_quantidade_compra == 0) {
                $delete_query = "DELETE FROM reserva WHERE id_usuario = ? AND id_produto = ?";
                $stmt_delete = $mysqli->prepare($delete_query);
                $stmt_delete->bind_param("ii", $id_usuario, $id_produto);
                $stmt_delete->execute();
            } else {
                $update_query = "UPDATE reserva SET quantidade_compra = ? WHERE id_usuario = ? AND id_produto = ?";
                $stmt_update = $mysqli->prepare($update_query);
                $stmt_update->bind_param("iii", $nova_quantidade_compra, $id_usuario, $id_produto);
                $stmt_update->execute();
            }
        }
    }

    if(isset($_POST["remove"])) {
        $id_reserva = isset($_POST['id_reserva']) ? intval($_POST['id_reserva']) : null;

        $delete_query = "DELETE FROM reserva WHERE id_usuario = ? AND id_reserva = ?";
        $stmt_delete = $mysqli->prepare($delete_query);
        $stmt_delete->bind_param("ii", $id_usuario, $id_reserva);
        $stmt_delete->execute();
    }
}

// Consultar os produtos da cesta para exibição
$query = "
SELECT c.id_reserva, c.id_produto, c.quantidade_compra, p.nome_produto, p.preco, p.imagem
FROM reserva c
INNER JOIN produto p ON c.id_produto = p.id_produto
WHERE c.id_usuario = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$produtos = $result->fetch_all(MYSQLI_ASSOC);

// Calcular o total dos produtos na cesta
$total = 0;
foreach ($produtos as $produto) {
    $total += $produto['quantidade_compra'] * $produto['preco'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na Cantina | Cesta</title>
    <link rel="stylesheet" href="../components/cesta.css">
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
            <a href="home.php" class="arrow-back">
                <img src="../../assets/arrow-left.png" alt="">
                </a>
        </div>
        <div class="cesta">
            <a href="#" class="reserva">Cesta</a> 
            <a href="../pages/reservas.php" class="reserva2">Reservas</a>
        </div>
    </div>
    <section class="resultado">
        <?php  foreach($produtos as $produto): ?>

        <div class="detail">
            <form class="photo-produto" method="POST" action="./cesta.php">
                <!-- <i class="bi bi-x"></i> -->
                <input type="hidden" name="id_reserva" value="<?= $produto["id_reserva"] ?>">
                <input type="submit" value="x" name="remove">
                <img src="../../assets/front_fr.111 1.png" alt="produtos">
            </form>
            <div class="desc">
                <p><?= $produto['preco'] ?>Kz</p>
                <p><?= $produto['nome_produto'] ?></p></div>
            <div class="btns">
                <form method="POST" action="./cesta.php">
                    <input type="hidden" name="id_produto" value="<?= $produto["id_produto"] ?>">
                    <input type="hidden" name="quantidade_compra" value="<?= $produto["quantidade_compra"] ?>">

                    <input type="submit" value="+" name="increase">
                    <!-- <button type="submit">+</button> -->
                </form>
                <span><?= $produto['quantidade_compra'] ?> Qua</span>
                <form method="POST" action="./cesta.php">
                <input type="hidden" name="id_produto" value="<?= $produto["id_produto"] ?>">
                <input type="hidden" name="quantidade_compra" value="<?= $produto["quantidade_compra"] ?>">
                <input type="submit" value="-" name="decrease">
                </form>
            </div>
        </div>

        <?php endforeach; ?>
        <footer>
            <p>
                <span>Total(Com entrega)</span>

                <?php 
                    function sumCestaTotal(...$cesta) {
                        return $cesta[0]["preco"] * $cesta[0]["quantidade_compra"];
                    }

                    $totalMapped = array_map("sumCestaTotal", $produtos);
                    $cestaTotal = array_sum($totalMapped);
                ?>
                <span><?= $cestaTotal ?>Kz</span>
            </p>
            <div class="container-btn">
                <a href="./finalizar.php">Finalizar</a>
            </div>
        </footer>
    </section>
</body>
</html>
