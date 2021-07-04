<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('location: ./login.php');
    }

    require_once('./DB.php');
    
    if (isset($_GET['cod']) && isset($_GET['nome']) && isset($_GET['descricao']) && isset($_GET['qt']) && isset($_GET['valor'])) {
        
        $query = "UPDATE `produtos` SET `nome` = '".
        $_GET['nome']."', `descricao` = '".
        $_GET['descricao']."', `quantidade` = ".
        $_GET['qt'].", `valor_unitario` = ".
        $_GET['valor']." WHERE `codigo` = ".
        $_GET['cod']."";
        
        
        $result = mysqli_query($db, $query);

        if ($result) {
        ?>
        
            <script>
                alert("Atualizado com sucesso...");
            </script>

        <?php
        }else{
        ?>

            <script>
                alert("Erro ao atualizar...");
            </script>

        <?php
        }

    }

    
    $query = "SELECT * FROM `produtos`";
    $result = mysqli_query($db, $query);

    if ($result) {
        $rows = mysqli_fetch_all($result);
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
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/atualizar.css">
    <title>Atualizar</title>
</head>
<body>
    <aside class="menu">
        <header>
            <p>Bem vindo(a), <?php echo($_SESSION['name']) ?> </p>
        </header>
        <main>
            <ul>
                <li> <a href="./"> <div> <img src="./icons/white_home.svg" alt=""> <p> Home </p> </div>  </a> </li>
                <li> <a href="./produto_inserir.php"> <div> <img src="./icons/white_add.svg" alt=""> <p> Inserir </p> </div>  </a> </li>
                <li> <a href="./produto_atualizar.php"> <div class="selected"> <img src="./icons/white_update.svg" alt=""> <p> Atualizar </p> </div>  </a> </li>
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
            <img src="./icons/grey_update.svg" alt="">
            <p class="title">Atualizar produto no estoque</p>
        </header>
        <main>
            <?php 
            
            if (isset($rows) && !empty($rows)) {
            ?>
            <div>
                <p>Campos editáveis!</p>
                <table>
                    <tr>
                        <td>Código</td>
                        <td>Produto</td>
                        <td>Descrição</td>
                        <td>Quantidade</td>
                        <td>Valor u.</td>                    
                        <td>Confirmar edição</td>                    
                    </tr>
    
                    <?php
                    
                    foreach ($rows as $row) {
                    ?>
                    <tr>
                        <form action="./produto_atualizar.php" method="get">
                            <td>
                                <input type="text" name="cod" value="<?php echo($row[0]) ?>" disabled>
                                <input style="display: none;" type="text" name="cod" value="<?php echo($row[0]) ?>">
                            </td>
                            <td>
                                <input type="text" name="nome" value="<?php echo($row[1]) ?>">
                            </td>
                            <td>
                                <input type="text" name="descricao" value="<?php echo($row[2]) ?>">
                            </td>
                            <td>
                                <input type="text" name="qt" value="<?php echo($row[3]) ?>">
                            </td>
                            <td>
                                <input type="text" name="valor" value="<?php echo($row[4]) ?>">
                            </td>
                            <td class="cel_exclude">
                            
                                <button type="submit"> 
                                    <img src="./icons/pencil.svg" alt=""> 
                                </button>
                            </td>
                        </form>
                    </tr>
    
                    <?php
                    }
                    ?>
                </table>
            </div>
            <?php
            }else{
            ?>
                <h2>Sem nenhum produto para listar aqui...</h2>
            <?php
            }
            ?>
        </main>
    </main>
</body>
</html>