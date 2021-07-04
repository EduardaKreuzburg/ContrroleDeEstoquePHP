<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('location: ./login.php');
    }
    
    require_once('./DB.php');

    if(isset($_POST['cod'])){
        $cod = (integer)$_POST['cod'];
        $query = "SELECT * FROM `produtos` WHERE `codigo` =  $cod";
        $result = mysqli_query($db, $query);
        

        if ($result && $result->num_rows >0) {
            $rows = mysqli_fetch_all($result);
            if (is_array($rows) && !empty($rows)) {
                
                $nova_quantia = $rows[0][3] - $_POST['quantia'];
                if ($nova_quantia >= 0) {
                    $query = "UPDATE `produtos` SET `quantidade` = '".$nova_quantia."' WHERE `codigo` =  $cod";
                    $result = mysqli_query($db, $query);
                    if (!$result) {
                    ?>
                        <script>
                            alert("Erro durante a venda, não foi possível dar a baixa no estoque");
                        </script>

                    <?php
                    }
                }else{
                ?>
                    <script>
                        alert("Erro durante a venda, quantia em estoque inferior a quantia vendida");
                    </script>
                <?php
                }
            }
        }else{
        ?>
            <script>
                alert("Erro durante a venda, não foi possível dar a baixa no estoque!\nVerifique se o código informado existe realmente.");
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
    <link rel="stylesheet" href="./css/baixa.css">
    <title>Baixa</title>
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
                <li> <a href="./produto_excluir.php"> <div> <img src="./icons/white_exclude.svg" alt=""> <p> Excluir </p> </div>  </a> </li>
                <li> <a href="./produto_baixa.php"> <div class="selected"> <img src="./icons/white_down.svg" alt=""> <p> Baixa </p> </div>  </a> </li>
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
            <img src="./icons/grey_down.svg" alt="">
            <p class="title">Baixa de produto</p>
        </header>
        <main>
            <div>
                <form action="./produto_baixa.php" method="post">
                    <div class="input_group">
                        <input type="number" name="cod" placeholder="Código do produto: 7" min="0" required>
                        <input type="number" name="quantia" placeholder="Quantia vendida: 5" min="1" required> 
                    </div>
                    <button type="submit">
                        <p>VENDER</p>
                    </button>
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