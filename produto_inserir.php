<?php
   
    session_start();
    if (!isset($_SESSION['name'])) {
        header('location: ./login.php');
    }

    require_once('./DB.php');
    
    if (isset($_POST['nome'])) {
        $query = "INSERT INTO `produtos`(`nome`, `descricao`, `quantidade`, `valor_unitario`) VALUES ('".$_POST['nome']."', '".$_POST['descricao']."', ".$_POST['quantidade'].", ".$_POST['valor'].")";
        
        $result = mysqli_query($db, $query);

        if ($result) {
        ?>
            <script>
                alert("Inserido com sucesso...");
            </script>

        <?php
        }else{
        ?>

            <script>
                alert("Erro ao inserir...");
            </script>

        <?php
        }

    }

    mysqli_close($db);
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
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/inserir.css">
    <title>Inserir</title>
</head>

<body>
    <aside class="menu">
        <header>
            <p>Bem vindo(a), <?php echo($_SESSION['name']) ?> </p>
        </header>
        <main>
            <ul>
                <li> <a href="./"> <div> <img src="./icons/white_home.svg" alt=""> <p> Home </p> </div>  </a> </li>
                <li> <a href="./produto_inserir.php"> <div class="selected"> <img src="./icons/white_add.svg" alt=""> <p> Inserir </p> </div>  </a> </li>
                <li> <a href="./produto_atualizar.php"> <div> <img src="./icons/white_update.svg" alt=""> <p> Atualizar </p> </div>  </a> </li>
                <li> <a href="./produto_consulta.php"> <div> <img src="./icons/white_magnifier.svg" alt=""> <p> Consultar </p> </div>  </a> </li>
                <li> <a href="./produto_excluir.php"> <div> <img src="./icons/white_exclude.svg" alt=""> <p> Excluir </p> </div>  </a> </li>
                <li> <a href="./produto_baixa.php"> <div> <img src="./icons/white_down.svg" alt=""> <p> Baixa </p> </div>  </a> </li>
                <li> <a href="./produto_listar.php"> <div> <img src="./icons/white_cursor.svg" alt=""> <p> Relatório </p> </div>  </a> </li>
            </ul>
        </main>
        <footer>
            <div>
                <a href="./logout.php"> 
                    <img src="./icons/white_logout_left.svg" alt="">
                    <p> Sair </p> 
                </a> 
            </div>
        </footer>
    </aside>
    <main>
        <header>
            <img src="./icons/grey_add.svg" alt="">
            <p class="title">Inserir produto no estoque</p>
        </header>
        <main>
            <form action="./produto_inserir.php" method="post">

                <label for="nome">
                    <p> Nome do produto: </p> 
                    <input type="text" name="nome" id="nome" required>
                </label>

                <div class="input_group">

                    <label for="quantidade">
                        <p> Quantidade: </p> 
                        <input type="number" name="quantidade" id="quantidade" min="0" required>
                    </label>

                    <label for="valor">
                         <p> Valor: </p> 
                        <input type="number" name="valor" id="valor" min="0.00" step="0.01" required>
                    </label>

                </div>

                <label for="descricao">
                     <p> Descrição do produto: </p> 
                    <textarea name="descricao" id="descricao" cols="30" rows="8" required></textarea>
                </label>

                <div>
                    <button type="submit"> <p> Inserir </p> </button>
                </div>

            </form>
        </main>
    </main>
</body>

</html>