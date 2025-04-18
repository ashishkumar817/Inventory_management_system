<?php
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity_added = $_POST['quantity_added'];
    $date_added = $_POST['date_added'];
    $supplier_id = $_POST['supplier_id'];

    $query = "INSERT INTO stock (product_id, quantity_added, date_added, supplier_id)
              VALUES ('$product_id', '$quantity_added', '$date_added', '$supplier_id')";

    if ($conn->query($query)) {
        header("Location: ../public/stock.php");
    } else {
        echo "Error adding stock: " . $conn->error;
    }
}
?>
