<?php
session_start();
include("../sql/connect.php");

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    echo "❌ Access denied.";
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

echo "<h2>Appointments</h2>";

if ($role !== 'patient') {
    echo '<form method="GET">
            <input type="text" name="search" placeholder="Search by patient username..." value="' . (isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') . '">
            <input type="submit" value="Search">
          </form><br>';
}

if ($role === 'patient') {
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE patient_username = ? ORDER BY appointment_date, appointment_time");
    $stmt->bind_param("s", $username);
} else {
    if (isset($_GET['search']) && $_GET['search'] !== '') {
        $search = "%" . $_GET['search'] . "%";
        $stmt = $conn->prepare("SELECT * FROM appointments WHERE patient_username LIKE ? ORDER BY appointment_date, appointment_time");
        $stmt->bind_param("s", $search);
    } else {
        $stmt = $conn->prepare("SELECT * FROM appointments ORDER BY appointment_date, appointment_time");
    }
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Patient Username</th>
            <th>Date</th>
            <th>Time</th>
            <th>Reason</th>
            <th>Created At</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['patient_username']}</td>
                <td>{$row['appointment_date']}</td>
                <td>{$row['appointment_time']}</td>
                <td>{$row['reason']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color:red;'>No appointments found.</p>";
}
?>