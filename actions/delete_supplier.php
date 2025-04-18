<?php
include("../config/db.php");

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM supplier WHERE supplier_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../public/suppliers.php");
