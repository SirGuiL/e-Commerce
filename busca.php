<?php
session_start();

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");

mysqli_select_db($con, $base) or die('error');

if(isset($_GET['acao'])){

    if($_GET['acao'] == 'order'){
        $subcategoria = $_POST['subcategoria'];
        $order = $_POST['order'];

        if(isset($_POST['ordenar'])){

            if($subcategoria == 'Subcategoria'){

                if($_POST['order'] == 'Mais Baratos'){
                    $res = mysqli_query($con, "SELECT * FROM produto P 
                    INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria
                    WHERE C.nome_categoria = '$item' ORDER BY P.preco_produto");
                }
                if($_POST['order'] == 'Mais Caros'){
                    $res = mysqli_query($con, "SELECT * FROM produto P 
                    INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria
                    WHERE C.nome_categoria = '$item' ORDER BY P.preco_produto DESC");
                }
                if($_POST['order'] == 'Últimos adicionados'){
                    $res = mysqli_query($con, "SELECT * FROM produto P 
                    INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria
                    WHERE C.nome_categoria = '$item' ORDER BY P.id_produto DESC");
                }
            }

            if($subcategoria != 'Subcategoria'){
                $msg = $subcategoria;
                if($_POST['order'] == 'Mais Baratos'){
                    $res = mysqli_query($con, "SELECT * FROM produto P 
                    INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria
                    INNER JOIN subCategoriaProduto SCP on P.id_produto = SCP.id_produto
                    INNER JOIN subCategoria SC on SCP.id_subCategoria = SC.id_subCategoria
                    WHERE P.id_categoria = 1 and SC.nome_subCategoria = '$subcategoria' ORDER BY P.preco_produto");
                }
                if($_POST['order'] == 'Mais Caros'){
                    $res = mysqli_query($con, "SELECT * FROM produto P 
                    INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria
                    INNER JOIN subCategoriaProduto SCP on P.id_produto = SCP.id_produto
                    INNER JOIN subCategoria SC on SCP.id_subCategoria = SC.id_subCategoria
                    WHERE P.id_categoria = 1 and SC.nome_subCategoria = '$subcategoria' ORDER BY P.preco_produto DESC");
                }
                if($_POST['order'] == 'Últimos adicionados'){
                    $res = mysqli_query($con, "SELECT * FROM produto P 
                    INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria
                    INNER JOIN subCategoriaProduto SCP on P.id_produto = SCP.id_produto
                    INNER JOIN subCategoria SC on SCP.id_subCategoria = SC.id_subCategoria
                    WHERE P.id_categoria = 1 and SC.nome_subCategoria = '$subcategoria' ORDER BY P.id_produto DESC");
                }
                if($_POST['order'] == 'Ordenar'){
                    $res = mysqli_query($con, "SELECT * FROM produto P
                    INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria
                    INNER JOIN subCategoriaProduto SCP on P.id_produto = SCP.id_produto
                    INNER JOIN subCategoria SC on SCP.id_subCategoria = SC.id_subCategoria
                    WHERE P.id_categoria = 1 and SC.nome_subCategoria = '$subcategoria' ORDER BY P.id_produto");
                }
            }

        }

    }

    if($_GET['acao'] == 'busca'){
        $busca = $_POST['busca'];
    }

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
          <form class="form-inline d-flex md-form justify-content-center form-sm mt-0" action="produtos.php?tipo=busca" method="POST">
            <input class="form-control form-control-sm ml-3 w-75 mt-4 mb-4 mr-2 w-90" type="search" placeholder="Buscar" aria-label="Search" list="lista">
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