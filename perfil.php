<?php
session_start();

if(!isset($_SESSION['id_cliente']) || !isset($_SESSION['email'])){
  header("location:login.php");
}
$id_cliente = $_SESSION['id_cliente'];

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");

mysqli_select_db($con, $base) or die('error');

$res = mysqli_query($con, "SELECT * FROM pedido P INNER JOIN cliente C ON P.id_cliente = C.id_cliente WHERE id_cliente = $id_cliente ORDER BY P.id_produto");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body>
    <?
    echo $_SESSION['id_usuario'];
    ?>
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
              <a class="nav-link active" id="perfil" href="#"><i class="fas fa-user"></i></a>
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
      <table class="table">
        <thead class="thead-dark">
            <tr><th colspan="3"><center>Pedidos de <?php echo $_SESSION['email'] ?></center></th></tr>
            <tr>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Data da Compra</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
        <?php

        $host  = "localhost";
        $user  = "root";
        $pass  = "28102002";
        $base  = "ecommerce";
        $con   = mysqli_connect($host, $user, $pass) or die("error");
        mysqli_select_db($con, $base) or die('error');


        $query = "SELECT * FROM pedido WHERE id_cliente = $id_cliente";

        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) == 0){
          echo "<tr>";
          echo "<td> Ainda não há pedidos </td>";
          echo "</tr>";
        }
        else{
        while($escrever=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<th scope='row'>" . $escrever['id_pedido'] . "</th>";
        echo "<td>" . $escrever['dt_pedido'] . "</td>";
        echo "<td>" . $escrever['valor_pedido'] . "</td>";
        echo "</tr>";
        }
          #<tr>
            #<th scope="row">1</th>
            #<td>05/07/2020</td>
            #<td>R$ 100</td>
          #</tr>
          #<tr>
            #<th scope="row">2</th>
            #<td>05/07/2020</td>
            #<td>R$ 100</td>
          #</tr>
          #<tr>
            #<th scope="row">3</th>
            #<td>05/07/2020</td>
            #<td>R$ 100</td>
          #</tr>
        }
        ?>
        </tbody>
      </table>
      <div>
        <form class="form-inline d-flex md-form justify-content-center form-sm mt-0" action="Perfil.php" method="POST">
          <input class="form-control form-control-sm ml-3 w-75 mt-4 mb-4 mr-2 w-90" type="search" placeholder="Buscar pedido por código" aria-label="Search">
          <button class="btn btn-dark" type="submit"><i class="fas fa-search" style="color: lightgrey;" aria-hidden="true"></i></button>
        </form>
      </div>
</body>
</html>