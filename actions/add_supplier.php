<?php
include("../config/db.php");

// Get input data
$s_name = $_POST['s_name'];
$s_contact_no = $_POST['s_contact_no'];
$s_addr = $_POST['s_addr'];

// Prepare and bind (3 fields, 3 placeholders)
$stmt = $conn->prepare("INSERT INTO supplier (s_name, s_contact_no, s_addr) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $s_name, $s_contact_no, $s_addr);

// Execute and redirect
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: ../public/suppliers.php");
exit;
