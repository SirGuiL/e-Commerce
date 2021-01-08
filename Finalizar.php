<?php
session_start();

if(!isset($_SESSION['id_cliente'])){
    header("location:login.php");
}

$host  = "localhost";
$user  = "root";
$pass  = "28102002";
$base  = "ecommerce";
$con   = mysqli_connect($host, $user, $pass) or die("error");

mysqli_select_db($con, $base) or die('error');


$data = date('d/m/Y', strtotime('+10 days'));


$total = $_GET['total'];


$cliente = $_SESSION['id_cliente'];


$query = "INSERT INTO pedido(dt_pedido, id_cliente, valor_pedido, dt_entrega) values
('now()', $cliente, $total, '$data')";

$resultado = mysqli_query($con, $query);



$query2 = "SELECT * FROM pedido WHERE dt_pedido = 'now()' AND id_cliente = $cliente AND valor_pedido = $total AND dt_entrega = '$data'";
$resultado2 = mysqli_query($con, $query2);

while($escrever = mysqli_fetch_array($resultado2)){
    $id_pedido = $escrever['id_pedido'];
}

foreach($_SESSION['carrinho'] as $id => $qtd){

    $query3 = "INSERT INTO produtoPedido (id_produto, id_pedido) VALUES ($id, $id_pedido)";
    $resultado3 = mysqli_query($con, $query3);

}

?>