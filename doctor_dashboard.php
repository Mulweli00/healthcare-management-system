<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.html");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Doctor Dashboard</title>
  <link rel="stylesheet" href="doctor_dashboard.css">
</head>
<body>
  <h2>Welcome, Dr. <?php echo $username; ?></h2>
  <ul>
    <li><a href="../medical_records/doctor_entry.html">Submit Diagnosis</a></li>
    <li><a href="../medical_records/view_records.php">View Medical Records</a></li>
    <li><a href="../appointment_scheduling/view_appointments.php">View Appointments</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</body>
</html>
