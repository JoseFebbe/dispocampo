<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$nomeUsuario = $_SESSION['usuario'];
$caminhoImagens = "img/$nomeUsuario/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $arquivoTemporario = $_FILES["imagem"]["tmp_name"];
    $nomeArquivo = $_FILES["imagem"]["name"];
    $caminhoCompleto = $caminhoImagens . $nomeArquivo;

    echo "teste ".$arquivoTemporario. " <br> ". $caminhoCompleto."<br>";

    if (move_uploaded_file($arquivoTemporario, $caminhoCompleto)) {
        chmod($caminhoCompleto, 0777);

        echo "sucesso";
        header("Location: pagina_sucesso.php");
        exit();
    } else {
        echo "Erro ao enviar o arquivo. Código de erro: " . $_FILES["imagem"]["error"];
    }
}
?>
