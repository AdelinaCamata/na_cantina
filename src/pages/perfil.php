<?php
session_start();
include_once 'conexão.php'; 

// Verifica se o usuário está logado
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redireciona para o login se não estiver autenticado
    exit();
}

// Recupera os dados do usuário logado
$user_id = $_SESSION['user']['id_usuario']; // Supondo que o ID do usuário esteja salvo na sessão

// Atualização dos dados do usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $endereco = $mysqli->real_escape_string($_POST['endereco']);

    $query = "UPDATE usuario SET nome_usuario = '$nome', email = '$email', endereco_usuario = '$endereco' WHERE id_usuario = '$user_id'";
    if ($mysqli->query($query)) {
        header("Location: perfil.php?status=success&msg=Informações atualizadas com sucesso!");
    } else {
        header("Location: perfil.php?status=failed&msg=Erro ao atualizar as informações.");
    }
    exit();
}

// Eliminação da conta do usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $query = "DELETE FROM usuario WHERE id_usuario = '$user_id'";
    if ($mysqli->query($query)) {
        session_destroy(); // Destroi a sessão do usuário
        header("Location: login.php?status=success&msg=Conta eliminada com sucesso.");
    } else {
        header("Location: perfil.php?status=failed&msg=Erro ao eliminar a conta.");
    }
    exit();
}

$query = "SELECT * FROM usuario WHERE id_usuario = '$user_id'";
$result = mysqli_query($mysqli, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result); // Armazena os dados do usuário em uma variável
} else {
    header("status=failed&msg=Erro ao carregar as informações do perfil!!");
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/perfil.css">
    <link rel="stylesheet" href="../components/error.css">
    <title>Na Cantina| Perfil</title>
</head>
<body>
    <div class="menu">
        <a href="./home.php" method="post">
            <img src="../../assets/casa.svg" alt="">
        </a>
        <a href="./pesquisar.php" method="post">
            <img src="../../assets/Lupa da barra.png" alt="">
        </a>
        <a class="cesto" href="./cesta.php" method="post">
            <img src="../../assets/cesto.svg" alt="">
            <span>4</span>
        </a>
        <a href="#" class="active" method="post" >
            <img src="../../assets/guy.png" alt="">
        </a>
    </div>
    <div class="cabecalho">
        <div class="voltar">
            <a href="perfil1.php" class="arrow-back" method="post">
                <img src="../../assets/arrow-left.png" alt="">
            </a>
        </div>
           
        <div class="cesta">
            <a href="#" class="reserva" method="post">Editar</a> 
        </div>
        </div>
    <div class="pessoa">
        <img src="../../assets/gyu2.png" alt="">
    </div>

    <div class="info">
        <form method="post" action="">
            <div class="info1">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($user['nome_usuario']); ?>" required>
            </div>
            <div class="info1">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="info1">
                <label for="endereco">Endereço:</label><input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($user['endereco_usuario']); ?>" required>
            </div>

            <div class="btn">
                <button type="submit" name="update" class="btn1">Salvar</button>
            </div>
        </form>

        <form method="post" action="">
            <button type="submit" name="delete" class="btn2">Eliminar conta</button>
        </form>
    </div>
</body>
</html>
