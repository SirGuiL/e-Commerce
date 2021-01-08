<?php
session_start();

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");

mysqli_select_db($con, $base) or die('error');

$resProdutos = mysqli_query($con, "SELECT * FROM produto P INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria ORDER BY P.id_produto");

$res = mysqli_query($con, "SELECT * FROM oferta O 
INNER JOIN produto P ON O.id_produto = P.id_produto 
INNER JOIN categoriaProduto C on P.id_categoria = C.id_categoria
ORDER BY id_oferta DESC");

$resLancamento = mysqli_query($con, "SELECT * FROM produto P INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria ORDER BY P.id_produto DESC");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Descrição da loja">
        <title> e-commerce </title>
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
                  <a class="nav-link" id="outros" href="produtos.php">Outros Produtos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="camisetas" href="produtos.php?item=camisetas">Camisetas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="blusas" href="produtos.php?item=blusas">Blusas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="mangaLonga" href="produtos.php?item=manga longa">Manga Longa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="calças" href="produtos.php?item=calças">Calças</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="perfil" href="perfil.php"><i class="fas fa-user"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="carrinho" href="carrinho.php"><i class="fas fa-shopping-cart"></i></a>
                </li>
              </ul>
            </div>
          </nav>
          <div style="background: rgb(80, 79, 79);">
          <form class="form-inline d-flex md-form justify-content-center form-sm mt-0" action="produtos.php?tipo=busca" method="POST">
            <input class="form-control form-control-sm ml-3 w-75 mt-4 mb-4 mr-2 w-90" type="search" placeholder="Buscar" aria-label="Search" list="lista">
            <datalist id="lista">
                <?php
                while($escrever=mysqli_fetch_array($resProdutos)){
                   echo "<option value='" . $escrever['nome_produto'] . "'>" . $escrever['nome_produto'] . " - " . $escrever['nome_categoria'] . "</option>";
                }
                ?>
            </datalist>
            <button class="btn btn-secondary" type="submit"><i class="fas fa-search" style="color: lightgrey;" aria-hidden="true"></i></button>
          </form>
          </div>
          <div id="carouselExampleIndicators" style="height: 500px;" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" style="height: 400px;" src="./imagens/img1.jpg" draggable="false" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" style="height: 400px;" src="./imagens/img2.jpg" draggable="false" alt="Second slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          
          <center>
          <h2 style="font-family: sans-serif;">Últimas Ofertas</h2>
          </center>

          <div class="container">
          <div class="row mb-5">
          <!--<div class="card-columns">-->
            <?php
            if(mysqli_num_rows($res) == 0){
                echo "<center>";
                echo "<h1> Não há ofertas no momento </h1>";
                echo "</center>";
            }
            else{
                while($escrever=mysqli_fetch_array($res)){
                    echo "<div class='col-md-4'>";
                    echo "<div class='card mb-4 shadow-sm'>";
                    echo "<a href='produto.php?id=" . $escrever['id_produto'] . "'>";
                    echo "<img id='" . $escrever['nome_produto'] . "' class='card-img-top' style='cursor: pointer;' src='./Produtos/". $escrever['img_produto'] ."' alt='Card image cap' draggable='false'>";
                    echo "</a>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $escrever['nome_produto'] . "</h5>";
                    echo "<h6 class='card-subtitle'>" . $escrever['nome_categoria'] . "</h6>";
                    echo "</div>";
                    echo "<center>";
                    echo "<div class='card-body'>";
                    echo "<a style='color: grey;' class='card-link'><del>R$ " . number_format($escrever['preco_produto'], 2, ',', '.') . "</del></a>";
                    echo "<a style='color: black; font-weight: 600;' class='card-link'>R$ " . number_format($escrever['valor_promocao'], 2, ',', '.') . "</a>";
                    echo "</div>";
                    echo "</center>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
          </div>
          </div>

          <center>
          <h2 style="font-family: sans-serif;">Lançamentos</h2>
          </center>

          <div class="container">
          <div class="row mb-5">
          <!--<div class="card-columns">-->
            <?php
                while($escrever=mysqli_fetch_array($resLancamento)){
                    echo "<div class='col-md-4'>";
                    echo "<div class='card mb-4 shadow-sm'>";
                    echo "<a href='produto.php?id=" . $escrever['id_produto'] . "'>";
                    echo "<img id='" . $escrever['nome_produto'] . "' class='card-img-top' style='cursor: pointer;' src='./Produtos/". $escrever['img_produto'] ."' alt='Card image cap' draggable='false'>";
                    echo "</a>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $escrever['nome_produto'] . "</h5>";
                    echo "<h6 class='card-subtitle'>" . $escrever['nome_categoria'] . "</h6>";
                    echo "</div>";
                    echo "<center>";
                    echo "<div class='card-body'>";
                    echo "<a style='color: black; font-weight: 600;' class='card-link'>" . number_format($escrever['preco_produto'], 2, ',', '.') . "</a>";
                    echo "</div>";
                    echo "</center>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
          </div>
          </div>
          <div class="rodape" style="color: rgb(68, 68, 68);">
              <center>
                © nome do e-Commerce
              </center>
          </div><br>
    </body>
</html>