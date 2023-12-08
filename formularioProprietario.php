<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/app/icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/formularios.css">
    <title>Cadastro</title>

</head>

<body>
    <form method="post" action="insereProprietario.php" id="locatario-form">
        <h2>Cadastro de Proprietários</h2>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">

        <label for="nome_local">Nome do Local:</label>
        <input type="text" id="Nome_local" name="nome_local">

        <label for="tipo">Evento:</label>
        <select id="tipo" name="tipo[]" multiple>
            <option value="esporte">Esportes</option>
            <option value="casamento">Casamento</option>
            <option value="formatura">Formatura</option>
            <option value="encontro">Encontros de Família</option>
            <option value="acampamento">Acampamentos</option>
        </select>

        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais">

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado">

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro">

        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua">

        <label for="complemento">Complemento:</label>
        <input type="text" id="complemento" name="complemento">

        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero">

        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario">

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha">

        <input type="submit" value="Salvar">
    </form>
</body>

</html>