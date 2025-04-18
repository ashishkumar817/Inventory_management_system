<?php
include("../config/db.php");
$p_name = $_POST['p_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity_in_stock'];

$sql = "INSERT INTO product (p_name, description, price, quantity_in_stock) 
        VALUES ('$p_name', '$description', $price, $quantity)";
$conn->query($sql);
header("Location: ../public/products.php");
?>
