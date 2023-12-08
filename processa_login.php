<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $conexao = mysqli_connect("localhost", "root", "1@josecobradoR", "dispocampo");

    if (!$conexao) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql_usuarios = "SELECT * FROM usuarios WHERE usuario=?";
    $stmt_usuarios = mysqli_prepare($conexao, $sql_usuarios);

    if ($stmt_usuarios) {
        mysqli_stmt_bind_param($stmt_usuarios, "s", $usuario);
        mysqli_stmt_execute($stmt_usuarios);

        $resultado_usuarios = mysqli_stmt_get_result($stmt_usuarios);

        if ($resultado_usuarios && mysqli_num_rows($resultado_usuarios) == 1) {
            $row = mysqli_fetch_assoc($resultado_usuarios);
            if (password_verify($senha, $row['senha'])) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: dashboard.php");
                exit();
            }
        }

        mysqli_stmt_close($stmt_usuarios);
    }

    $sql_proprietarios = "SELECT * FROM proprietarios WHERE nome=?";
    $stmt_proprietarios = mysqli_prepare($conexao, $sql_proprietarios);

    if ($stmt_proprietarios) {
        mysqli_stmt_bind_param($stmt_proprietarios, "s", $usuario);
        mysqli_stmt_execute($stmt_proprietarios);

        $resultado_proprietarios = mysqli_stmt_get_result($stmt_proprietarios);

        if ($resultado_proprietarios && mysqli_num_rows($resultado_proprietarios) == 1) {
            $row = mysqli_fetch_assoc($resultado_proprietarios);
            if (password_verify($senha, $row['senha'])) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: dashboardProprietario.php");
                exit();
            }
        }

        mysqli_stmt_close($stmt_proprietarios);
    }

    mysqli_close($conexao);
}

header("Location: index.html");
exit();
?>