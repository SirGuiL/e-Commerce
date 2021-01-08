<?php
session_start();

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");

mysqli_select_db($con, $base) or die('error');

if(isset($_GET['item'])){

    $item = $_GET['item'];

    $query = "SELECT * FROM CategoriaProduto WHERE nome_categoria = $item";
    
    $result = mysqli_query($con, $query);

}

else{

    $query = "SELECT * FROM CategoriaProduto";

    $result = mysqli_query($con, $query);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> E-commerce <?php if(isset($item)) {echo " - " . $item;} ?> </title>
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
                  <a class="nav-link" id="camisetas" href="produtos.php?item=Camisetas">Camisetas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="blusas" href="produtos.php?item=Blusas">Blusas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="mangaLonga" href="produtos.php?item=Manga Longa">Manga Longa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="calças" href="produtos.php?item=Calças">Calças</a>
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
          <form class="form-inline d-flex md-form justify-content-center form-sm mt-0" action="busca.php?acao=busca" method="POST">
            <input class="form-control form-control-sm ml-3 w-75 mt-4 mb-4 mr-2 w-90" type="search" placeholder="Buscar" aria-label="Search" list="lista" name="busca">
            <datalist id="lista">
                <?php
                
                $query = "SELECT * FROM produto P INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria ORDER BY P.id_produto";
                $result = mysqli_query($con, $query);
                
                while($escrever=mysqli_fetch_array($result)){
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
          <form class="form-inline d-flex md-form justify-content-end form-sm mt-0" action="busca.php?acao=order" method="POST">
            <select class="form-control" id="exampleFormControlSelect1" name="subcategoria">
            <?php
            if(isset($item)){
                echo "<option>Subcategoria</option>";
                $query = "SELECT * FROM subCategoria SC INNER JOIN categoriaProduto C ON SC.id_categoria = C.id_categoria WHERE C.nome_categoria = '$item' group by SC.id_subCategoria";
                $result = mysqli_query($con, $query);

                while($escrever=mysqli_fetch_array($result)){
                    echo "<option>" . $escrever['nome_subCategoria'] . "</option>";
                }
            }
            else{
                echo "<option>Categorias</option>";

                $query = "SELECT * FROM CategoriaProduto";
                $result = mysqli_query($con, $query);

                while($escrever=mysqli_fetch_array($result)){
                    echo "<option>" . $escrever['nome_categoria'] . "</option>";
                }
            }

            ?>
            </select>
            <select class="form-control ml-2" id="exampleFormControlSelect1" name="order">
              <option>Ordenar</option>
              <option>Mais Baratos</option>
              <option>Mais Caros</option>
              <option>Últimos adicionados</option>
            </select>
            <button class="btn btn-secondary ml-1 mr-1" type="submit" name="ordenar"><i class="fas fa-search" style="color: lightgrey;" aria-hidden="true"></i></button>
          </form>
          
          <center>
          <?php
          if(isset($item)){
              echo "<h2 style='font-family: sans-serif;'>" . $item . "</h2>";
          }
          else{
              echo "<h2 style='font-family: sans-serif;'> Produtos </h2>";
          }
          ?>
          </center>

          <div class="container">
          <div class="row mb-5">

          <?php

                if(isset($item)){
                    $res = mysqli_query($con, "SELECT * FROM produto P INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria WHERE C.nome_categoria = '$item' ORDER BY P.id_produto");
                }
                else{
                    $res = mysqli_query($con, "SELECT * FROM produto P INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria ORDER BY P.id_produto");
                }

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
                    echo "<a style='color: black; font-weight: 600;' class='card-link'>" . $escrever['preco_produto'] . "</a>";
                    echo "</div>";
                    echo "</center>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
          </div>
          </div>
</body>