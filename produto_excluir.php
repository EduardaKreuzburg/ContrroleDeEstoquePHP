<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('location: ./login.php');
    }

    require_once('./DB.php');

    if(isset($_GET['cod'])){
        $cod = (integer)$_GET['cod'];
        $query = "DELETE FROM `produtos` WHERE `codigo` =  $cod";
        $result = mysqli_query($db, $query);

        if ($result) {
        ?>
            <script>
                alert("Excluído com sucesso...");
            </script>
        <?php
        }else{
        ?>
            <script>
                alert("Erro ao excluir");
            </script>
        <?php
        }
    }


    $query = "SELECT * FROM `produtos`";
    $result = mysqli_query($db, $query);

    if ($result) {
        $rows = mysqli_fetch_all($result);
        mysqli_close($db);
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
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/excluir.css">
    <title>Excluir</title>
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
                <li> <a href="./produto_atualizar.php"> <div> <img src="./icons/white_update.svg" alt=""> <p> Atualizar </p> </div>  </a> </li>
                <li> <a href="./produto_consulta.php"> <div> <img src="./icons/white_magnifier.svg" alt=""> <p> Consultar </p> </div>  </a> </li>
                <li> <a href="./produto_excluir.php"> <div class="selected"> <img src="./icons/white_exclude.svg" alt=""> <p> Excluir </p> </div>  </a> </li>
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
            <img src="./icons/grey_exclude.svg" alt="">
            <p class="title">Excluir produto no estoque</p>
        </header>
        <main>
            <?php 
            if (isset($rows) && !empty($rows)) {
            ?>
            <table>
                <tr>
                    <td>Código</td>
                    <td>Produto</td>
                    <td>Descrição</td>
                    <td>Quantidade</td>
                    <td>Valor u.</td>
                    <td>Excluir</td>
                </tr>

                <?php
                foreach ($rows as $row) {
                ?>

                <tr>
                    <td><?php echo($row[0]) ?></td>
                    <td><?php echo($row[1]) ?></td>
                    <td><?php echo($row[2]) ?></td>
                    <td><?php echo($row[3]) ?></td>
                    <td><?php echo($row[4]) ?></td>                
                    <td class="cel_exclude">
                        <a href="./produto_excluir.php?cod=<?php echo($row[0]); ?>"> 
                            <img class="button_exclude" src="./icons/garbage.svg" alt=""> 
                        </a>
                    </td>
                </tr>

                <?php
                }
                ?>

            </table>
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