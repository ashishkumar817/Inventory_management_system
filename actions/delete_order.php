<?php
include("../config/db.php");

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM order_ WHERE order_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../public/orders.php");
