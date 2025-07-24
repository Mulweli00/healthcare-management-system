<?php
include("../sql/connect.php");

$patient_username = $_POST['patient_username'];
$appointment_id = $_POST['appointment_id'];
$nurse_id = $_POST['nurse_id']; // Now this is a numeric ID
$nurse_notes = $_POST['nurse_notes'];

$checkPatient = $conn->prepare("SELECT * FROM patients WHERE username = ?");
$checkPatient->bind_param("s", $patient_username);
$checkPatient->execute();
if ($checkPatient->get_result()->num_rows == 0) {
    die("❌ Error: Patient username does not exist. <a href='nurse_entry.html'>Back</a>");
}

$checkAppointment = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
$checkAppointment->bind_param("i", $appointment_id);
$checkAppointment->execute();
if ($checkAppointment->get_result()->num_rows == 0) {
    die("❌ Error: Appointment ID does not exist. <a href='nurse_entry.html'>Back</a>");
}

$checkNurse = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'nurse'");
$checkNurse->bind_param("i", $nurse_id);
$checkNurse->execute();
if ($checkNurse->get_result()->num_rows == 0) {
    die("❌ Error: Nurse ID is invalid or not a nurse. <a href='nurse_entry.html'>Back</a>");
}

$sql = "INSERT INTO medical_records (patient_username, appointment_id, nurse_id, nurse_notes, nurse_submit_time)
VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $patient_username, $appointment_id, $nurse_id, $nurse_notes);
$stmt->execute();

echo "✅ Nurse checkup submitted successfully. <a href='nurse_entry.html'>Back</a>";
?>
