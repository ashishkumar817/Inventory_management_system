<?php
include("../config/db.php");
$id = $_POST['product_id'];
$p_name = $_POST['p_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity_in_stock'];

$sql = "UPDATE product SET 
        p_name='$p_name', 
        description='$description', 
        price=$price, 
        quantity_in_stock=$quantity 
        WHERE product_id=$id";
$conn->query($sql);
header("Location: ../public/products.php");
?>
