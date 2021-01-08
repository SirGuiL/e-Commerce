<?php
session_start();

if(!isset($_SESSION['Administrador'])){
    header("Location:loginAdm.php");
}
else{

    $host  = "localhost";
    $user  = "root";
    $pass  = "28102002";
    $base  = "ecommerce";
    $con   = mysqli_connect($host, $user, $pass) or die("error");

    mysqli_select_db($con, $base) or die('error');

    $email = $_SESSION['Administrador'];

    $query = mysqli_query($con, "SELECT * FROM administrador WHERE email_adm = $email");

    if(mysqli_num_rows($query) == 0){
        session_destroy();
        header("Location:loginAdm.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Área do Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand" id="logo" href="index.php"> Logo </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" id="outros" href="Adm.php?acao=graficos">Graficos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="camisetas" href="Adm.php?acao=graficos">Adicionar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="blusas" href="Adm.php?acao=graficos">Remover</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="mangaLonga" href="Adm.php?acao=graficos">Alterar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="carrinho" href="Adm.php?acao=add">Novo Adiministrador</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="carrinho" href="Sair.php">Sair</a>
            </li>
          </ul>
        </div>
      </nav>
      <?php
      
      if(isset($_GET['acao'])){

        if($_GET['acao'] == 'graficos'){

          echo "<h1> Gráficos </h1>";
          echo "<div id='curve_chart' style='width: 700px; height: 500px'></div>";
          echo "<div id='piechart_3d' style='width: 700px; height: 500px;'></div>";
          
        }
        if($_GET['acao'] == 'adicionar'){

        }
        if($_GET['acao'] == 'remover'){

        }
        if($_GET['acao'] == 'alterar'){

        }
        if($_GET['acao'] == 'add'){

        }
      }

      ?>

      <?php

      if(isset($_POST['datas'])){
        $query = "SELECT * FROM pedido WHERE dt_pedido = $dt_pedido";
        $result = mysqli_query($con, $query);

        $
      }
      
      ?>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
  
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Data', 'Valor Bruto'],
            ['13/07',  6000],
            ['14/07',  9000],
            ['15/07',  7200],
            ['16/07',  5100],
          ]);
  
          var options = {
            title: 'Renda',
            curveType: 'function',
            legend: { position: 'bottom' }
          };
  
          var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
          chart.draw(data, options);

          var data = google.visualization.arrayToDataTable([
          ['Produto', 'Quantidade'],
          ['Calças',     11],
          ['Blusas',      2],
          ['Camisetas',  2],
          ['Bermudas', 2],
          ['Meias',    7]
          ]);

          var options = {
          title: 'Vendas',
          is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data, options);
        }
      </script>
</body>
</html>