<?php
session_start();

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");
mysqli_select_db($con, $base) or die('error');

if(isset($_POST['confirmar'])){

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = md5($_POST['senha']);
    $confirmSenha = md5($_POST['cSenha']);

    if($senha == $confirmSenha){

    $query = "SELECT * FROM cliente where email_cliente = '$email'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0){
        echo "<script>alert('Email já cadastrado');</script>";
    }
    else{
        $query = "INSERT INTO cliente(nome_cliente, email_cliente, senha_cliente) VALUES ('$nome', '$email', '$senha')";
        $inserir = mysqli_query($con, $query);

        $query2 = "SELECT * FROM cliente WHERE email_cliente = '$email' AND senha_cliente = '$senha'";
        $conferir = mysqli_query($con, $query2);

        if(mysqli_num_rows($conferir) == 0){
          echo "<script> alert('Falha ao cadastrar'); </script>";
        }
        else{
          echo "<script> alert('Cadastrado com sucesso'); </script>";
          $user = mysqli_fetch_assoc($conferir);
          $id = $user['id_cliente'];
          header("location:endereco.php?id=" . $id);
        }
    }
    }
    else{
        echo "<script>alert('Senha e Confirmar senha não são iguais');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
</head>
<body>
    <div class="box">
      <h2> Cadastro </h2>
      <form action="cadastro.php" method="POST">
        <div class="inputBox">
          <input type="email" name="email" required>
          <label> E-mail </label>
        </div>
        <div class="inputBox">
          <input type="text" name="nome" required>
          <label> Nome </label>
        </div>
        <div class="inputBox">
          <input type="password" name="senha" required>
          <label> Senha </label>
        </div>
        <div class="inputBox">
          <input type="password" name="cSenha" required>
          <label> Confirmar senha </label>
        </div>
        <input type="submit" name="confirmar" value="Confirmar">
      </form>
    </div>
</body>
</html>