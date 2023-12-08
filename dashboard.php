<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$nomeUsuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/app/icon.png" type="image/x-icon">
    <title>Dispocampo</title>

</head>

<body>
    <img src="img/app/logo.png" alt="Logo" class="logo">

    <header>
        <h1>Bem-vindo ao Dispocampo
            <?php echo $nomeUsuario; ?>
            <link rel="stylesheet" type="text/css" href="css/dashboard.css">

        </h1>
    </header>

    <div class="container">
        <figure>
            <a href="formatura.php">
                <div class="imagem-selecao">
                    <img src="img/app/formaturaAPP.jpeg" alt="Imagem Formatura">
                    <figcaption>Formatura<br> <br></figcaption>
                </div>
            </a>
        </figure>

        <figure>
            <a href="casamento.php">
                <div class="imagem-selecao">
                    <img src="img/app/casamento2APP.jpg" alt="Imagem casamento">
                    <figcaption>Casamento<br> <br> </figcaption>
                </div>
            </a>
        </figure>

        <figure>
            <a href="aventuras.php">
                <div class="imagem-selecao">
                    <img src="img/app/rapel-e-tirolesaAPP.jpg" alt="Imagem aventura">
                    <figcaption>Esportes<br> na <br>natureza</figcaption>
                </div>
            </a>
        </figure>

        <figure>
            <a href="familia.php">
                <div class="imagem-selecao">
                    <img src="img/app/encontroAPP.webp" alt="Imagem familia">
                    <figcaption>Encontro<br> de <br>familia</figcaption>
                </div>
            </a>
        </figure>

        <figure>
            <a href="acampamento.php">
                <div class="imagem-selecao">
                    <img src="img/app/acampamentoAPP.jpg" alt="Imagem Acampamento">
                    <figcaption>Acampamento<br> <br></figcaption>
                </div>
            </a>
        </figure>


    </div>

    <div class="rodape">
        <a href="logout.php" class="logout-link">Sair</a>
    </div>
</body>

</html>