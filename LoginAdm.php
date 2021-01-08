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
  $senha = md5($_POST['senha']);

  $query = "SELECT * FROM administrador WHERE email_adm = '$email' AND senha_adm = '$senha'";
  $result = mysqli_query($con, $query);
  
  if(mysqli_num_rows($result) > 0){
    header("location:Adm.php");
  }
  else{
    echo "<script> alert('Email ou senha inválidos.'); </script>";
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
      <h2> Login </h2>
      <form action="loginAdm.php" method="POST">
        <div class="inputBox">
          <input type="email" name="email" required>
          <label> E-mail </label>
        </div>
        <div class="inputBox">
          <input type="password" name="senha" required>
          <label> Senha </label>
        </div><br>
        <input type="submit" name="confirmar" value="Confirmar">
      </form>
    </div>
</body>
</html>