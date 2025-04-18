<?php
include("../config/db.php");
$id = $_GET['id'];
$conn->query("DELETE FROM product WHERE product_id = $id");
header("Location: ../public/products.php");
?>
