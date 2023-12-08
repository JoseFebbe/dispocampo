<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $nome_local = $_POST["nome_local"];

    if (isset($_POST["tipo"]) && is_array($_POST["tipo"])) {
        $tipos = implode(', ', $_POST["tipo"]);
    } else {
        $tipos = "";
    }

    $pais = $_POST["pais"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $bairro = $_POST["bairro"];
    $rua = $_POST["rua"];
    $complemento = $_POST["complemento"];
    $numero = $_POST["numero"];

    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

    $conexao = mysqli_connect("localhost", "root", "1@josecobradoR", "dispocampo");

    if (!$conexao) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sqlProprietario = "INSERT INTO proprietarios (nome, telefone, email, senha, usuario) VALUES ('$nome', '$telefone', '$email', '$hashSenha', '$usuario')";

    if (mysqli_query($conexao, $sqlProprietario)) {

        $proprietarioId = mysqli_insert_id($conexao);

        $sqlEndereco = "INSERT INTO endereco (pais, estado, cidade, bairro, rua, complemento, numero) VALUES ('$pais', '$estado', '$cidade', '$bairro', '$rua', '$complemento', '$numero')";

        if (mysqli_query($conexao, $sqlEndereco)) {

            $enderecoId = mysqli_insert_id($conexao);

            $sqlLocais = "INSERT INTO locais (nome, local, tipo_evento, endereco_id, proprietario) VALUES ('$nome_local', '$cidade', '$tipos', '$enderecoId', '$usuario')";

            if (mysqli_query($conexao, $sqlLocais)) {

                $locaisId = mysqli_insert_id($conexao);

                $sqlProprietarioLocal = "INSERT INTO proprietario_local (proprietario_id, local_id) VALUES ($proprietarioId, $locaisId)";

                if (mysqli_query($conexao, $sqlProprietarioLocal)) {

                    $diretorioImagens = "img/$usuario/";
                    if (!is_dir($diretorioImagens)) {
                        mkdir($diretorioImagens, 0777, true);
                    } else {
                    }

                    $mensagemSucesso = "Dados inseridos com sucesso!";
                    $mensagemSucessoEncoded = urlencode($mensagemSucesso);
                    header("Location: sucesso.php?mensagemSucesso=$mensagemSucessoEncoded");
                } else {
                    echo "Erro ao inserir dados na tabela proprietario_local: " . mysqli_error($conexao);
                }
            } else {
                echo "Erro ao inserir dados na tabela locais: " . mysqli_error($conexao);
            }
        } else {
            echo "Erro ao inserir dados na tabela endereco: " . mysqli_error($conexao);
        }
    } else {
        echo "Erro ao inserir dados na tabela proprietarios: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>
