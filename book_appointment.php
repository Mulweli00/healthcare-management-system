<?php
include("../sql/connect.php");

$username = $_POST['username'];
$date = $_POST['appointment_date'];
$time = $_POST['time'];
$reason = $_POST['reason'];

// Insert appointment
$sql = "INSERT INTO appointments (patient_username, appointment_date, appointment_time, reason)
VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $date, $time, $reason);
$stmt->execute();

echo "<p style='color:green; font-weight:bold;'>Appointment booked successfully.</p>
      <a href='../login/patient_dashboard.php'>Back to Dashboard</a>";
?>
