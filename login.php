<?php
session_start();
include("../sql/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $selected_role = $_POST['role']; 

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password']) && $selected_role === $user['role']) {
            // Correct match
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            switch ($user['role']) {
                case 'admin':
                    header("Location: admin_dashboard.php");
                    break;
                case 'nurse':
                    header("Location: nurse_dashboard.php");
                    break;
                case 'doctor':
                    header("Location: doctor_dashboard.php");
                    break;
                case 'patient':
                    header("Location: patient_dashboard.php");
                    break;
                default:
                    echo "❌ Unknown role. <a href='login.html'>Back</a>";
            }
        } else {
            echo "❌ Incorrect password or role. <a href='login.html'>Try again</a>";
        }
    } else {
        echo "❌ Username not found. <a href='login.html'>Try again</a>";
    }
}
?>