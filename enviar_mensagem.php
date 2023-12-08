<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$conexao = mysqli_connect("localhost", "root", "1@josecobradoR", "dispocampo");

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

$remetente = $_SESSION['usuario'];
$destinatario = $_POST['destinatario'];
$mensagem = $_POST['mensagem'];

$sql = "INSERT INTO mensagens (remetente, destinatario, mensagem, data_envio) VALUES ('$remetente', '$destinatario', '$mensagem', NOW())";

echo "<html><head>";
echo "<title>Envio de Mensagem</title>";
echo "<link rel='stylesheet' type='text/css' href='css/enviadaSucesso.css'>";
echo "</head><body>";

if (mysqli_query($conexao, $sql)) {
    echo "Mensagem enviada com sucesso!";
    echo "<br>";
    echo '<button onclick="voltar()">Voltar</button>';
} else {
    echo "Erro ao enviar a mensagem: " . mysqli_error($conexao);
}

echo "</body></html>";

mysqli_close($conexao);
?>

<script>
    function voltar() {
        window.history.back();
    }
</script>
