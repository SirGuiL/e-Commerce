<?php
session_start();

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");

mysqli_select_db($con, $base) or die('error');

$id = $_GET['id'];

if(isset($_POST['confirmar'])){

  $id = $_GET['id'];

  unset($_SESSION['id_cliente']);

  $uf = $_POST['UF'];
  $cidade = $_POST['cidade'];
  $bairro = $_POST['bairro'];
  $cep = $_POST['CEP'];
  $endereco = $_POST['endereco'];
  $numero = $_POST['numero'];

  if($uf == "--Estado--"){
    echo "<script> alert('Escolha um estado'); </script>";
  }
  else{
    $query = "INSERT INTO endereco(id_cliente, UF, cidade, bairro, endereco, numero, CEP)
    values ($id, '$uf', '$cidade', '$bairro', '$endereco', $numero, '$cep')";
    $result = mysqli_query($con, $query);

    $query2 = "SELECT * FROM endereco WHERE id_cliente = $id AND CEP = '$cep'";
    $result2 = mysqli_query($con, $query2);

    if(mysqli_num_rows($result2) == 0){
      echo "<script> alert('Falha ao cadastrar o endereço'); </script>";
    }
    else{
      echo "<script> alert('Cadastro realizado com sucesso'); </script>";
      header("location:login.php");
    }

  }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body><br><br><br><br><br>
    <div class="container w-50" style="margin: 0 auto;">
      <h2> Login </h2>
      <?php echo "<form action='endereco.php?id=" . $id . "' method='POST'>"; ?>
        <div class="form-group">
          <select class="form-control" name="UF" id="UF">
            <option>--Estado--</option>
            <option>AC</option>
            <option>AL</option>
            <option>AP</option>
            <option>AM</option>
            <option>BA</option>
            <option>CE</option>
            <option>ES</option>
            <option>GO</option>
            <option>MA</option>
            <option>MT</option>
            <option>MS</option>
            <option>MG</option>
            <option>PA</option>
            <option>PB</option>
            <option>PR</option>
            <option>PE</option>
            <option>PI</option>
            <option>RJ</option>
            <option>SN</option>
            <option>RS</option>
            <option>RO</option>
            <option>RR</option>
            <option>SC</option>
            <option>SP</option>
            <option>SE</option>
            <option>TO</option>
            <option>DF</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Cidade</label>
          <input type="text" class="form-control" name="cidade" id="cidade" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Bairro</label>
          <input type="text" class="form-control" name="bairro" id="bairro" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">CEP</label>
          <input type="text" class="form-control" name="CEP" id="CEP" maxlenght="5" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Endereço</label>
          <input type="text" class="form-control" name="endereco" id="endereco" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Número</label>
          <input type="number" class="form-control" name="numero" id="numero" required>
        </div>
        <button type="submit" class="btn btn-primary" name="confirmar">Confirmar</button>
      </form>
    </div>
</body>
</html>