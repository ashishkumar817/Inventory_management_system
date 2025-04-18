<?php
include("../config/db.php");

$id = $_POST['id'];
$s_name = $_POST['s_name'];
$s_contact_no = $_POST['s_contact_no'];
$s_addr = $_POST['s_addr'];

$stmt = $conn->prepare("UPDATE supplier SET s_name = ?, s_contact_no = ?, s_addr = ? WHERE supplier_id = ?");
$stmt->bind_param("sssi", $s_name, $s_contact_no, $s_addr, $id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ../public/suppliers.php");
exit;
