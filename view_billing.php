<?php
session_start();
include("../sql/connect.php");

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    echo "❌ Access denied.";
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

echo "<h2>Billing Records</h2>";

if ($role !== 'patient') {
    echo '<form method="GET">
            <input type="text" name="search" placeholder="Search by patient username..." value="' . (isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') . '">
            <input type="submit" value="Search">
          </form><br>';
}

if ($role === 'patient') {
    $stmt = $conn->prepare("SELECT * FROM billing WHERE patient_username = ? ORDER BY created_at DESC");
    $stmt->bind_param("s", $username);
} else {
    if (isset($_GET['search']) && $_GET['search'] !== '') {
        $search = "%" . $_GET['search'] . "%";
        $stmt = $conn->prepare("SELECT * FROM billing WHERE patient_username LIKE ? ORDER BY created_at DESC");
        $stmt->bind_param("s", $search);
    } else {
        $stmt = $conn->prepare("SELECT * FROM billing ORDER BY created_at DESC");
    }
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Appointment ID</th>
            <th>Medical Record ID</th>
            <th>Doctor (R)</th>
            <th>Medication (R)</th>
            <th>Lab (R)</th>
            <th>Other (R)</th>
            <th>Total (R)</th>
            <th>Date</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['patient_username']}</td>
                <td>{$row['appointment_id']}</td>
                <td>{$row['medical_record_id']}</td>
                <td>{$row['doctor_charge']}</td>
                <td>{$row['medication_charge']}</td>
                <td>{$row['lab_charge']}</td>
                <td>{$row['other_charge']}</td>
                <td><strong>{$row['total_charge']}</strong></td>
                <td>{$row['created_at']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='color:red;'>No billing records found.</p>";
}
?>
