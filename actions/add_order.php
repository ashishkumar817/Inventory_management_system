<?php
include("../config/db.php");

$customer_id = $_POST['customer_id'];
$order_date = $_POST['order_date'];
$status = $_POST['status'];

$stmt = $conn->prepare("INSERT INTO order_ (customer_id, order_date, status) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $customer_id, $order_date, $status);
$stmt->execute();

header("Location: ../public/orders.php");
