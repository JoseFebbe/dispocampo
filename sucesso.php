
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sucesso.css"> 
    <title>Sucesso</title>
</head>
<body>
    <div class="container">
        <h2>Sucesso</h2>
        <p><?php echo $mensagemSucesso; ?></p>
        
        <button id="retornarBtn">Retornar ao Login</button>
    </div>

    <script>
        document.getElementById("retornarBtn").addEventListener("click", function() {
            window.location.href = "index.html";
        });
    </script>
</body>
</html>
