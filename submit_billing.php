<?php
include("../sql/connect.php");

$patient_username = $_POST['patient_username'];
$appointment_id = $_POST['appointment_id'];
$medical_record_id = $_POST['medical_record_id'];

$doctor_charge = floatval($_POST['doctor_charge']);
$medication_charge = floatval($_POST['medication_charge']);
$lab_charge = floatval($_POST['lab_charge']);
$other_charge = isset($_POST['other_charge']) ? floatval($_POST['other_charge']) : 0.00;

$total_charge = $doctor_charge + $medication_charge + $lab_charge + $other_charge;

$checkPatient = $conn->prepare("SELECT * FROM patients WHERE username = ?");
$checkPatient->bind_param("s", $patient_username);
$checkPatient->execute();
if ($checkPatient->get_result()->num_rows == 0) {
    die("❌ Error: Patient username not found. <a href='billing_entry.html'>Back</a>");
}

$checkAppointment = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
$checkAppointment->bind_param("i", $appointment_id);
$checkAppointment->execute();
if ($checkAppointment->get_result()->num_rows == 0) {
    die("❌ Error: Appointment ID not found. <a href='billing_entry.html'>Back</a>");
}

$checkRecord = $conn->prepare("SELECT * FROM medical_records WHERE id = ?");
$checkRecord->bind_param("i", $medical_record_id);
$checkRecord->execute();
$recordResult = $checkRecord->get_result();

if ($recordResult->num_rows == 0) {
    die("❌ Error: Medical Record ID not found. <a href='billing_entry.html'>Back</a>");
}

$record = $recordResult->fetch_assoc();

if (
    $record['patient_username'] !== $patient_username ||
    $record['appointment_id'] != $appointment_id
) {
    die("❌ Error: The Medical Record does not match the entered patient or appointment. <a href='billing_entry.html'>Back</a>");
}

$sql = "INSERT INTO billing (patient_username, appointment_id, medical_record_id, doctor_charge, medication_charge, lab_charge, other_charge, total_charge)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siidddds", $patient_username, $appointment_id, $medical_record_id, $doctor_charge, $medication_charge, $lab_charge, $other_charge, $total_charge);
$stmt->execute();

echo "✅ Billing record saved successfully. <a href='billing_entry.html'>Back</a>";
?>

