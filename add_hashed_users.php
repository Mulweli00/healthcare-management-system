<?php
include("../sql/connect.php");

function addUser($conn, $username, $password, $role) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed, $role);
    $stmt->execute();
    echo "User '$username' added<br>";
}

addUser($conn, "admin1", "password123", "admin");
addUser($conn, "nurse1", "password123", "nurse");
addUser($conn, "doctor1", "password123", "doctor");

$conn->close();
?>
