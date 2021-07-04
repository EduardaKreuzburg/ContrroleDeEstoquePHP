<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('location: ./login.php');
    }

    require_once('./DB.php');

    $query = "SELECT * FROM `produtos`";
    $result = mysqli_query($db, $query);

    if ($result) {
        $rows = mysqli_fetch_all($result);
    }

    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $query = "SELECT * FROM `produtos` WHERE `codigo` = '".$search."' OR `nome` LIKE '%".$search."%'";

        $result = mysqli_query($db, $query);

        if ($result) {
            $rows = mysqli_fetch_all($result);
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
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/consulta.css">
    <title>Consulta</title>
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
                <li> <a href="./produto_consulta.php"> <div class="selected"> <img src="./icons/white_magnifier.svg" alt=""> <p> Consultar </p> </div>  </a> </li>
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
            <img src="./icons/grey_magnifier.svg" alt="">
            <p class="title">Consultar produto no estoque</p>
        </header>
        <main>
            <div>
                <form action="./produto_consulta.php" method="post">
                    <div class="search_group">
                        <input type="text" name="search" placeholder="Buscar: código/nome">
                        <button type="submit">
                            <img src="./icons/white_magnifier.svg" alt="">
                        </button>
                    </div>
                </form>
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
                        <td>Valor total</td>
                    </tr>

                    <?php
                    foreach ($rows as $row) {
                        $total_produto = $row[3] * $row[4];
                    ?>

                    <tr>
                        <td><?php echo($row[0]) ?></td>
                        <td><?php echo($row[1]) ?></td>
                        <td><?php echo($row[2]) ?></td>
                        <td><?php echo($row[3]) ?></td>
                        <td><?php echo($row[4]) ?></td>
                        <td><?php echo($total_produto) ?></td>           
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
            </div>
        </main>
    </main>
</body>
</html>