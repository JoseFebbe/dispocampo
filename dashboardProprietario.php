<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
$nomeUsuario = $_SESSION['usuario'];
$caminhoImagens = "img/$nomeUsuario/";
$listaImagens = glob($caminhoImagens . '*');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/app/icon.png" type="image/x-icon">
    <title>Dispocampo - proprietario</title>
    <link rel="stylesheet" type="text/css" href="/css/dashboardProprietario.css">
</head>

<body>
    <img src="img/app/logo.png" alt="Logo" class="logo">
    <header>
        <h1>Bem-vindo ao Dispocampo
            <?php echo $nomeUsuario; ?>
        </h1>
    </header>
    <div class="container">
        <?php
        foreach ($listaImagens as $imagem) {
            echo '<figure>';
            echo '<div class="imagem-selecao">';
            echo '<img src="' . $imagem . '">';
            echo '</div>';
            echo '</figure>';
        }
        ?>
    </div>
    <div class="rodape">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="imagem">Adicionar Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*">
            <input type="submit" value="Enviar">
        </form>

        <form action="uploadCapa.php" method="post" enctype="multipart/form-data">
            <label for="imagem">Adicionar capa:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*">
            <input type="submit" value="Enviar">
        </form>
        <a href="mensagem.php" class="logout-link">Ver Mensagens</a>
        <a href="logout.php" class="logout-link">Sair</a>
    </div>
</body>

</html>