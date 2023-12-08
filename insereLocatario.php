<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $pais = $_POST["pais"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $bairro = $_POST["bairro"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

    $conexao = mysqli_connect("localhost", "root", "1@josecobradoR", "dispocampo");

    if (!$conexao) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO usuarios (usuario, senha, nome, telefone, pais, estado, cidade, bairro, rua, numero, complemento) VALUES ('$usuario', '$hashSenha', '$nome', '$telefone', '$pais', '$estado', '$cidade', '$bairro', '$rua', '$numero', '$complemento')";

    if (mysqli_query($conexao, $sql)) {
        $mensagemSucesso = "Dados inseridos com sucesso!";
        $mensagemSucessoEncoded = urlencode($mensagemSucesso);
        header("Location: sucesso.php?mensagemSucesso=$mensagemSucessoEncoded");
    } else {
        echo "Erro ao inserir os dados: " . mysqli_error($conexao) ;
    }

    mysqli_close($conexao);
}
