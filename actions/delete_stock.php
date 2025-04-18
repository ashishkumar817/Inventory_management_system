<?php
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stock_id = $_POST['stock_id'];

    $query = "DELETE FROM stock WHERE stock_id='$stock_id'";

    if ($conn->query($query)) {
        header("Location: ../public/stock.php");
    } else {
        echo "Error deleting stock: " . $conn->error;
    }
}
?>
