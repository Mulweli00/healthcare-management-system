<?php
include("../sql/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  // 1. Insert into patients table
  $stmt = $conn->prepare("INSERT INTO patients (username, password, email) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $password, $email);
  $stmt->execute();

  // 2. Insert into users table (for login)
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $role = "patient";

  $stmt2 = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
  $stmt2->bind_param("sss", $username, $hashedPassword, $role);
  $stmt2->execute();

  echo "Registration successful! <a href='../login/login.html'>Login now</a>";
}
?>