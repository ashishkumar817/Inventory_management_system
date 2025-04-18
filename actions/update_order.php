<?php
include("../config/db.php");

$id = $_POST['id'];
$customer_id = $_POST['customer_id'];
$order_date = $_POST['order_date'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE order_ SET customer_id=?, order_date=?, status=? WHERE order_id=?");
$stmt->bind_param("issi", $customer_id, $order_date, $status, $id);
$stmt->execute();

header("Location: ../public/orders.php");
