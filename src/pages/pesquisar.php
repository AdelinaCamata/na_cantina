<?php
session_start();
include_once 'conexão.php'; // Certifique-se de que o arquivo de conexão está correto

// Função de pesquisa ao receber a requisição AJAX
if (isset($_GET['ajax']) && $_GET['ajax'] == 1 && isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $mysqli->real_escape_string($_GET['query']); // Proteção contra SQL Injection

    // Consulta ao banco de dados
    $sql = "SELECT nome_produto, marca, preco, imagem, gramas 
            FROM produto 
            WHERE nome_produto LIKE '%$query%' OR marca LIKE '%$query%'";
    $result = $mysqli->query($sql);

    $produtos = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
    }
    echo json_encode($produtos);
    exit;
}
// Verificar se o usuário está logado
if (!isset($_SESSION['user']['id_usuario'])) {
    die("Erro: Usuário não está logado.");
}
$id_usuario = intval($_SESSION['user']['id_usuario']);

// Obter o ID do produto enviado pelo formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'])) {
    $id_produto = intval($_POST['id_produto']);

    // Verificar se o produto já está reservado
    $query = "SELECT quantidade_compra FROM reserva WHERE id_usuario = ? AND id_produto = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $id_usuario, $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Atualizar a quantidade da reserva
        $row = $result->fetch_assoc();
        $nova_quantidade = $row['quantidade_compra'] + 1;

        $update_query = "UPDATE reserva SET quantidade_compra = ? WHERE id_usuario = ? AND id_produto = ?";
        $stmt_update = $mysqli->prepare($update_query);
        $stmt_update->bind_param("iii", $nova_quantidade_compra, $id_usuario, $id_produto);
        $stmt_update->execute();
    } else {
        // Inserir o produto na reserva
        $insert_query = "INSERT INTO reserva (id_usuario, id_produto, quantidade_compra) VALUES (?, ?, 1)";
        $stmt_insert = $mysqli->prepare($insert_query);
        $stmt_insert->bind_param("ii", $id_usuario, $id_produto);
        $stmt_insert->execute();
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na Cantina | Pesquisar</title>
    <link rel="stylesheet" href="../components/pesquisar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Evento ao digitar no campo de pesquisa
            $(".pesquisar").on("input", function() {
            var query = $(this).val(); // Captura o valor digitado
            if (query.length > 0) { // Inicia pesquisa apenas se houver texto
             $.ajax({
             url: "", // Requisita a mesma página
             method: "GET",
            data: { query: query, ajax: 1 },
            success: function(data) {
             $(".produtos").html(""); // Limpa os resultados anteriores
            var produtos = JSON.parse(data); // Converte JSON em array
            if (produtos.length > 0) {
            produtos.forEach(function(produto) {
            $(".produtos").append(
                `<div class="produtos">
    <?php
    // Obter produtos do banco de dados
    $query = "SELECT id_produto, nome_produto, marca, preco, imagem FROM produto";
    $result = $mysqli->query($query);

    while ($produto = $result->fetch_assoc()): ?>
        <div class="produto">
            <img src="../../assets/<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome_produto']) ?>">
            <h2><?= htmlspecialchars($produto['nome_produto']) ?></h2>
            <p><strong>Marca:</strong> <?= htmlspecialchars($produto['marca']) ?></p>
            <p><strong>Preço:</strong> Kz <?= htmlspecialchars($produto['preco']) ?></p>
            <form method="POST" action="">
                <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">
                <button class="mais" type="submit">+</button>
            </form>
        </div>
    <?php endwhile; ?>
</div>

            </form>

                </div>`
            );
        });
    } else {
        $(".produtos").html("<p>Sem resultados encontrados.</p>");
    }
}
});
        } else {
            $(".produtos").html("<p>Digite algo na barra de pesquisa para iniciar.</p>");
        }
    });
});
</script>
</head>
<body>
    <div class="menu">
        <a href="../pages/home.php">
            <img src="../../assets/casa.svg" alt="">
        </a>
        <a class="active" href="./pesquisar.php">
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

<div class="main">
       <div class="inputbox">
            <input type="text" name="query" placeholder="Procurar produtos..." class="pesquisar" required>
            <button type="submit" class="lupa">
                <img src="../../assets/lupa2.svg" alt="">
            </button>
    </div>
       </div>
</div>

</body>
</html>
