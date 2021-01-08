<?php 

$item = $_GET['item'];

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");

mysqli_select_db($con, $base) or die('error');

$res = mysqli_query($con, "SELECT * FROM produto P 
INNER JOIN categoriaProduto C ON P.id_categoria = C.id_categoria
where P.id_produto = $id");

$res2 = mysqli_query($con, "SELECT * FROM imagemProduto WHERE id_produto = $id");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
    <?php 
    while($escrever = mysqli_fetch_array($res)){
        $id = $escrever['id_produto'];
        $nm_produto = $escrever['nome_produto'];
        $preco = 'R$ ' . number_format($escrever['preco_produto'], 2, ',', '.');
        $estoque = $escrever['estoque'];
        $desc = $escrever['descricao'];
        $categoria = $escrever['nome_categoria'];
        $img = $escrever['img_produto'];
        

        echo $escrever['nome_produto'];
    }
        ?>
    </title>
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
              <a class="nav-link active" id="calças" href="Calcas.php">Calças</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="perfil" href="Perfil.php"><i class="fas fa-user"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="carrinho" href="Carrinho.php"><i class="fas fa-shopping-cart"></i></a>
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
        <?php
        echo "<br><br>";
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div style='width: 500px;' class='col-sm'>";
        echo "<img src='./Produtos/$img' style='width: 500px;' class='img-fluid' alt='Responsive image' draggable='false'><br>";
        echo "</div>";
        echo "<div class='col-sm'>";
        echo "<h4 style='color: grey;'>" . $categoria . "</h4>";
        echo "<h2>" . $nm_produto . "</h2>";
        echo "<h4>" . $preco . "</h3>";
        echo "<h6> Item parcelado em até 2x no cartão </h6><br>";
        echo "<p>" . $desc . "</p><br>";
        echo "<form action='carrinho.php?acao=add&id=" . $id . "' method='POST'>";
        echo "<h6> Tamanhos </h6>";
        echo "<select>";
        echo "<option> P </option>";
        echo "<option> M </option>";
        echo "<option> G </option>";
        echo "<option> GG </option>";
        echo "</select><br><br>";
        echo "<button class='btn btn-secondary' type='submit'>Adicionar ao Carrinho</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<br><br><hr><br><br>";
        echo "<center>";
        while($escrever2=mysqli_fetch_array($res2)){
            echo "<img class='img-fluid ml-2 mr-2 mt-2' style='width: 300px;' src='./Produtos/" . $escrever2['img'] . "' draggable='false'>";
        }
        echo "</center><br><br><br>";
        ?>
        <div class="rodape" style="color: rgb(68, 68, 68);">
          <center>
            © nome do e-Commerce
          </center>
        </div><br>
</body>
</html>