<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$nomeUsuario = $_SESSION['usuario'];

$conexao = mysqli_connect("localhost", "root", "1@josecobradoR", "dispocampo");

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

$sql = "SELECT * FROM mensagens WHERE destinatario = '$nomeUsuario'";

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suas Mensagens</title>
    <link rel="stylesheet" href="css/lerMensagem.css">
</head>

<body>

<div class="mensagem">
    <?php
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<div class='mensagem-item'>";
        echo "<p class='remetente'>De: " . $row['remetente'] . "</p>";
        echo "<p class='corpo-mensagem'>Mensagem: " . $row['mensagem'] . "</p>";
        echo "<p class='data'>Data: " . $row['data_envio'] . "</p>";
        echo "</div><br>";
    }
    ?>
</div>
<?php
echo "<a class='link-voltar' href='dashboardProprietario.php'>Voltar</a>";
?>
</body>

</html>
