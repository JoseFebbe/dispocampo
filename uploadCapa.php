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


    echo "testando" . $nomeUsuario . "<br>" . $caminhoImagens . "<br>" . $arquivoTemporario . "<br>" . $nomeArquivo . "<br>" . $caminhoCompleto . "<br>";
    if (move_uploaded_file($arquivoTemporario, $caminhoCompleto)) {


        chmod($caminhoCompleto, 0777);

        $conexao = mysqli_connect("localhost", "root", "1@josecobradoR", "dispocampo");

        if (!$conexao) {
            die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
        }
        $sqlVerificar = "SELECT capa FROM locais WHERE proprietario = '$nomeUsuario'";
        $resultadoVerificar = mysqli_query($conexao, $sqlVerificar);
        
        $row = mysqli_fetch_assoc($resultadoVerificar);
        
        if ($row['capa'] !== null) {

            echo "if";
            $sqlUpdate = "UPDATE locais SET capa = '$nomeArquivo' WHERE proprietario = '$nomeUsuario'";
            mysqli_query($conexao, $sqlUpdate);
        } else {
            echo "else";
            $sqlInsert = "update locais set capa='$nomeArquivo' where proprietario='$nomeUsuario'";
            mysqli_query($conexao, $sqlInsert);
        }
        
        mysqli_close($conexao);
        

        header("Location: pagina_sucesso.php");
        exit();
    } else {
        echo "Erro ao enviar o arquivo. Código de erro: " . $_FILES["imagem"]["error"];
    }
}
?>