<?php
include("../sql/connect.php");

$patient_username = $_POST['patient_username'];
$doctor_id = $_POST['doctor_id']; // Now this is a numeric ID
$diagnosis = $_POST['diagnosis'];
$prescription = $_POST['prescription'];

$checkRecord = $conn->prepare("SELECT * FROM medical_records WHERE patient_username = ?");
$checkRecord->bind_param("s", $patient_username);
$checkRecord->execute();
if ($checkRecord->get_result()->num_rows == 0) {
    die("❌ Error: No medical record exists for this patient yet. <a href='doctor_entry.html'>Back</a>");
}

$checkDoctor = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'doctor'");
$checkDoctor->bind_param("i", $doctor_id);
$checkDoctor->execute();
if ($checkDoctor->get_result()->num_rows == 0) {
    die("❌ Error: Doctor ID is invalid or not a doctor. <a href='doctor_entry.html'>Back</a>");
}

$sql = "UPDATE medical_records 
        SET doctor_id = ?, doctor_diagnosis = ?, prescription = ?, doctor_submit_time = NOW() 
        WHERE patient_username = ? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $doctor_id, $diagnosis, $prescription, $patient_username);
$stmt->execute();

echo "✅ Doctor diagnosis submitted successfully. <a href='doctor_entry.html'>Back</a>";
?>
