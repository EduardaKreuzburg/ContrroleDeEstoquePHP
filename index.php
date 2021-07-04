<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('location: ./login.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/root.css">
    <link rel="stylesheet" href="./css/home.css">
    <title>Inicio</title>
</head>
<body>
    <header>
        <div>
            
            <p>Bem vindo(a), <?php echo($_SESSION['name']) ?> </p>
            <a href="./logout.php"> <img src="./icons/purple_logout_right.svg" alt=""> </a>
        </div>
    </header>
    <main>
        <a href="./produto_inserir.php">
            <div>
                <img src="./icons/purple_add.svg" alt="">
                <p>INSERIR PRODUTO</p>
            </div>
        </a>
        
        <a href="./produto_atualizar.php">
            <div>
                <img src="./icons/purple_update.svg" alt="">
                <p>ATUALIZAR PRODUTO</p>
            </div>
        </a>
        
        <a href="./produto_consulta.php">
            <div>
                <img src="./icons/purple_magnifier.svg" alt="">
                <p>CONSULTAR PRODUTO</p>
            </div>
        </a>
        
        <a href="./produto_excluir.php">
            <div>
                <img src="./icons/purple_exclude.svg" alt="">
                <p>EXCLUIR PRODUTO</p>
            </div>
        </a>
        
        <a href="./produto_baixa.php">
            <div>
                <img src="./icons/purple_down.svg" alt="">
                <p>BAIXAR PRODUTO NO ESTOQUE</p>
            </div>
        </a>
        
        <a href="./produto_listar.php">
            <div>
                <img src="./icons/purple_cursor.svg" alt="">
                <p>RELATÓRIO GERAL DE PRODUTOS</p>
            </div>
        </a>
    </main>
</body>
</html>