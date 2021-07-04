<?php
    
    require_once("./DB.php");

    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])) {

        $query = "INSERT INTO `usuarios`(`nome`, `email`, `senha`) values ('".$_POST['name']."', '".$_POST['email']."', '".md5($_POST['password'])."')";

        $result = mysqli_query($db, $query);
       
        if ($result) {
           
            mysqli_close($db);
            header('location: ./login.php');
            
        }else{
            ?>
                <script>
                    alert("Erro no cadastro");
                </script>
            <?php
        }

    }

    session_start();
    if (isset($_SESSION['name'])) {
        header('location: ./');
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
    <link rel="stylesheet" href="./css/cad_user.css">
    <title>Cadastro usuário</title>
</head>
<body>
    <main class="cad_user">
        <div class="header_container_center">
            <p class="title">Registrar conta!</p>
        </div>

        <form action="./cad_user.php" method="post">
            <div class="input_group">
                <input type="text" name="name" id="name" placeholder="Nome">
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="password" name="password" id="password" placeholder="Senha">
            </div>

            <button type="submit">Registrar</button>

        </form>

        <p>Já possui conta? <a href="./login.php">Entrar.</a> </p>
    </main>
</body>
</html>