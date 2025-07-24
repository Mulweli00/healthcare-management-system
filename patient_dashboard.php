<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.html");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Patient Dashboard</title>
  <link rel="stylesheet" href="patient_dashboard.css">
</head>
<body>
  <h2>Welcome, <?php echo $username; ?></h2>
  <ul>
    <li><a href="../appointment_scheduling/appointment_booking_form.html">Book Appointment</a></li>
    <li><a href="../appointment_scheduling/view_appointments.php?patient=<?php echo $username; ?>">View Appointments</a></li>
    <li><a href="../billing/view_billing.php?patient=<?php echo $username; ?>">View Bills</a></li>
    <li><a href="../medical_records/view_records.php?patient=<?php echo $username; ?>">View Medical Records</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</body>
</html>
