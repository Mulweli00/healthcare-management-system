<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
  <h2>Welcome, Admin <?php echo $username; ?></h2>
  <ul>
    <li><a href="../patient_registration/index.html">Register Patient</a></li>
    <li><a href="../appointment_scheduling/appointment_booking_form.html">Book Appointment</a></li>
    <li><a href="../appointment_scheduling/view_appointments.php">View Appointments</a></li>
    <li><a href="../medical_records/view_records.php">View Medical Records</a></li>
    <li><a href="../billing/billing_entry.html">Enter Billing</a></li>
    <li><a href="../billing/view_billing.php">View All Bills</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</body>
</html>
