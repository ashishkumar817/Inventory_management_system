<?php
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stock_id = $_POST['stock_id'];
    $product_id = $_POST['product_id'];
    $quantity_added = $_POST['quantity_added'];
    $date_added = $_POST['date_added'];
    $supplier_id = $_POST['supplier_id'];

    $query = "UPDATE stock SET product_id='$product_id', quantity_added='$quantity_added',
              date_added='$date_added', supplier_id='$supplier_id' WHERE stock_id='$stock_id'";

    if ($conn->query($query)) {
        header("Location: ../public/stock.php");
    } else {
        echo "Error updating stock: " . $conn->error;
    }
}
?>
