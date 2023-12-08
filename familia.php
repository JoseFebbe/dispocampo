<?php
$conexao = mysqli_connect("localhost", "root", "1@josecobradoR", "dispocampo");
if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

$sql = "SELECT * FROM locais WHERE tipo_evento = 'encontro'";

$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Encontros de Família</title>
    <link rel="icon" href="../img/app/icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/encontro.css">
</head>
<body>
    <h1>Encontro de Família</h1>
    <ul>
        <?php
        while ($row = mysqli_fetch_assoc($resultado)) {
            ?>
            <li>
                <div class="local-info">
                    Nome: <?php echo $row['nome']; ?><br>
                    Local: <?php echo $row['local']; ?><br>
                    <a href='detalhes.php?nome=<?php echo urlencode($row['nome']); ?>'>Detalhes</a><br>
                </div>
                <img src='img/<?php echo $row['proprietario']; ?>/<?php echo $row['capa']; ?>' alt='Capa'><br>
            </li>
            <?php
        }
        ?>
    </ul>
    <a href='dashboard.php' class="voltar-link">Voltar</a>
</body>
</html>
<?php
mysqli_free_result($resultado);
mysqli_close($conexao);
?>
