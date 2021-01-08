<?php
session_start();

$total = 0;

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");

mysqli_select_db($con, $base) or die('error');

if(!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
}

if(isset($_GET['acao'])){
    
    if($_GET['acao'] == 'add'){

        $id = intval($_GET['id']);
        if(!isset($_SESSION['carrinho'][$id])){
            $_SESSION['carrinho'][$id] = 1;
        }
        else{
            $_SESSION['carrinho'][$id] += 1;
        }

    }

    if($_GET['acao'] == 'del'){
        $id = intval($_GET['id']);
        if(isset($_SESSION['carrinho'][$id])){
            unset($_SESSION['carrinho'][$id]);
        }
    }

    if($_GET['acao'] == 'up'){
        if(is_array($_POST['produto'])){
            foreach($_POST['produto'] as $id => $qtd){
                $id = intval($id);
                $qtd = intval($qtd);
                if(!empty($qtd) || $qtd <> 0){
                    $_SESSION['carrinho'][$id] = $qtd;
                }
                else{
                    unset($_SESSION['carrinho'][$id]);
                }
            }
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrinho</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand" id="logo" href="#"> Logo </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" id="outros" href="Outros.php">Outros Produtos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="camisetas" href="Camisetas.php">Camisetas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="blusas" href="Blusas.php">Blusas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="mangaLonga" href="MangaLonga.php">Manga Longa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="calças" href="Calcas.php">Calças</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="perfil" href="Perfil.php"><i class="fas fa-user"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="carrinho" href="Carrinho.php"><i class="fas fa-shopping-cart"></i></a>
            </li>
          </ul>
        </div>
      </nav>
      <div style="background: rgb(80, 79, 79);">
        <form class="form-inline d-flex md-form justify-content-center form-sm mt-0" action="search.php" method="POST">
          <input class="form-control form-control-sm ml-3 w-75 mt-4 mb-4 mr-2 w-90" type="search" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-secondary" type="submit"><i class="fas fa-search" style="color: lightgrey;" aria-hidden="true"></i></button>
        </form>
        </div>

        <table class="table">
        <thead class="thead-dark">
            <tr><th colspan="5"><center>Carrinho</center></th></tr>
          <tr>
            <th scope="col">Produto</th>
            <th scope="col">Valor</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Subtotal</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            <?php 
            
                if(count($_SESSION['carrinho']) == 0){
                    echo "<tr> <td colspan='4'> Não há itens no carrinho </td> </tr>";
                }
                else{
                    foreach($_SESSION['carrinho'] as $id => $qtd){
                        $query = "SELECT * FROM produto WHERE id_produto = $id";
                        $sql = mysqli_query($con, $query) or die(mysql_error());
                        $escrever = mysqli_fetch_assoc($sql);

                        $produto = $escrever['nome_produto'];
                        $preco = number_format($escrever['preco_produto'], 2, ',', '.');
                        $sub = number_format($escrever['preco_produto'] * $qtd, 2, ',', '.');
                        $total += floatval($sub);

                        echo "<tr>";
                        echo "<th scope='row'>" . $produto . "</th>";
                        echo "<td> R$ " . $preco . "</td>";
                        echo "<td><form action='Carrinho.php?acao=up&id=" . $id . "' method='POST'><input type='number' style='width: 80px;' name='produto[" . $id . "]' value='" . $qtd . "'><button class='btn btn-secondary ml-1 mb-1'><i class='fas fa-sync-alt'></i></button></form></td>";
                        echo "<td> R$ " . $sub . "</td>";
                        echo "<td> <a href='Carrinho.php?acao=del&id=" . $id . "'> Remover </a> </td>";
                        echo "</tr>";
                    }
                }

            ?>
        <tbody>
            <?php
            if($total != 0){
            echo "<tr><td colspan='3'>Total:</td><td id='total'>R$ " . $total . "</td></tr>";
            }
            else{
                echo "<tr><td colspan='3'>Total:</td><td></td></tr>";
            }
            ?>
        </tbody>
        </center>
      </table><br>
      <a class="btn btn-secondary ml-2" href="Outros.php"> Voltar a Comprar </a>
      <a class="btn btn-secondary mr-2" style="margin-left: auto;" href="Finalizar.php?total=<?php echo $total ?>"> Finalizar Compra </a>
</body>
</html>