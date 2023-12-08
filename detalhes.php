<?php
$nomeLocal = $_GET['nome'];

$conexao = mysqli_connect("localhost", "root", "1@josecobradoR", "dispocampo");

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

$sql = "SELECT locais.*, endereco.* 
        FROM locais
        INNER JOIN endereco ON locais.id = endereco.id
        WHERE locais.nome = '$nomeLocal'";

$sql2 = "SELECT locais.*, proprietarios.* 
         FROM locais 
         JOIN proprietario_local ON locais.id = proprietario_local.local_id 
         JOIN proprietarios ON proprietario_local.proprietario_id = proprietarios.id 
         WHERE locais.nome = '$nomeLocal'";

$sql3 = "SELECT proprietario FROM locais WHERE nome = '$nomeLocal'";
$resultado3 = mysqli_query($conexao, $sql3);
$row3 = mysqli_fetch_assoc($resultado3);
$destinatario = $row3['proprietario'];

$resultado = mysqli_query($conexao, $sql);
$resultado2 = mysqli_query($conexao, $sql2);

$diretorioImagens = "img/$destinatario/";
$imagens = glob($diretorioImagens . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/app/icon.png" type="image/x-icon">
    <title>Detalhes do Local</title>
    <link rel="stylesheet" type="text/css" href="/css/detalhes.css">
</head>

<body>

    <div class='container'>
        <h1>Detalhes do Local</h1>
        <ul>
            <?php
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<li>";
                echo "<strong>Nome:</strong> " . $row['nome'] . "<br>";
                echo "<strong>Local:</strong> " . $row['local'] . "<br>";
                echo "<strong>País:</strong> " . $row['pais'] . "<br>";
                echo "<strong>Estado:</strong> " . $row['estado'] . "<br>";
                echo "<strong>Cidade:</strong> " . $row['cidade'] . "<br>";
                echo "<strong>Bairro:</strong> " . $row['bairro'] . "<br>";
                echo "<strong>Rua:</strong> " . $row['rua'] . "<br>";
                echo "<strong>Número:</strong> " . $row['numero'] . "<br>";
                echo "<strong>Complemento:</strong> " . $row['complemento'] . "<br>";
                echo "<div class='imagem-container'>";
                echo "<img class='capa' src='img/$destinatario/{$row['capa']}' alt='Capa'>";
                echo "<div class='navegacao'>";
                echo "<button onclick='anteriorImagem()'>Anterior</button>";
                echo "<button onclick='proximaImagem()'>Próxima</button>";
                echo "</div>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>

    <div class='container'>
        <ul>
            <?php
            while ($row = mysqli_fetch_assoc($resultado2)) {
                echo "<li>";
                echo "<strong>Proprietario:</strong> " . $row['proprietario'] . "<br>";
                echo "<strong>Telefone de contato:</strong> " . $row['telefone'] . "<br>";
                echo "<strong>Email de contato:</strong> " . $row['email'] . "<br>";
                echo "</li>";
                echo "<input type='hidden' name='destinatario' value='" . $row['proprietario'] . "'>";
            }
            ?>
        </ul>
    </div>

    <div class='container'>
        <form action='enviar_mensagem.php' method='post'>
            <input type='hidden' name='destinatario' value='<?php echo $destinatario; ?>'>
            <label for='mensagem'>Mensagem:</label>
            <textarea name='mensagem' id='mensagem' rows='4' required></textarea>
            <input type='submit' value='Enviar Mensagem'>
        </form>
    </div>

    <script>
       
        var diretorioImagens = "/img/$destinatario";
        var imagens = <?php echo json_encode($imagens); ?>;
        var indiceAtual = 0;

        function anteriorImagem() {
            if (indiceAtual > 0) {
                indiceAtual--;
                exibirImagemAtual();
            }
        }

        function proximaImagem() {
            if (indiceAtual < imagens.length - 1) {
                indiceAtual++;
                exibirImagemAtual();
            }
        }

        function exibirImagemAtual() {
            document.querySelector('.capa').src = imagens[indiceAtual];
        }
    </script>

</body>

</html>

<?php
mysqli_free_result($resultado);
mysqli_free_result($resultado2);
mysqli_free_result($resultado3);
mysqli_close($conexao);
?>