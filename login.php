<?php
    
    require_once("./DB.php");

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $query = "SELECT nome FROM usuarios WHERE email = '" . $_POST['email'] . "' AND senha = '" . md5($_POST['password']) . "'";

        $result = mysqli_query($db, $query);
        if ($result) {

            $row = mysqli_fetch_assoc($result);
            if (is_array($row)) {
                session_start();
                $_SESSION['name'] = $row['nome'];
                session_write_close();
                mysqli_close($db);
                header('location: ./');
            }else{
                ?>
                    <script>
                        alert("Erro no login");
                    </script>
                <?php
            }
        }

    }

    session_start();
    if (isset($_SESSION['name'])) {
        header('location: ./');
    }
    session_write_close();
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
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
    <main class="login">
        <div class="header_container_center">
            <p class="title">Bem vindo de volta!</p>
            <p>Por favor, preencha seus dados de login para continuar.</p>
        </div>

        <form action="./login.php" method="post">
            <div class="input_group">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Senha" required>
            </div>

            <button type="submit">Login</button>

        </form>

        <p>Ainda não tem conta? <a href="./cad_user.php">Registre-se.</a> </p>
    </main>
</body>
</html>