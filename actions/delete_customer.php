<?php
include("../config/db.php");

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM customers WHERE customer_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../public/customers.php");
