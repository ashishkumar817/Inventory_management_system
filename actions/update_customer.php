<?php
include("../config/db.php");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
// Validate phone number format (e.g., +91-9876543210 or +1 8001234567)
if (!preg_match('/^\+?\d{1,4}[-\s]?\d{7,14}$/', $phone)) {
    die("❌ Invalid phone number format. Please use a format like +91-9876543210.");
}

// Optionally: Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("❌ Invalid email address.");
}


$stmt = $conn->prepare("UPDATE customers SET name=?, email=?, phone=?, address=? WHERE customer_id=?");
$stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);
$stmt->execute();

header("Location: ../public/customers.php");
