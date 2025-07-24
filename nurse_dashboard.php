<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'nurse') {
    header("Location: login.html");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Nurse Dashboard</title>
  <link rel="stylesheet" href="nurse_dashboard.css">
</head>
<body>
  <h2>Welcome, Nurse <?php echo $username; ?></h2>
  <ul>
    <li><a href="../appointment_scheduling/view_appointments.php">View Appointments</a></li>
    <li><a href="../medical_records/nurse_entry.html">Submit Checkup</a></li>
    <li><a href="../medical_records/view_records.php">View Medical Records</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</body>
</html>
