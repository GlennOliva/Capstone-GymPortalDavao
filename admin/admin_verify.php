<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        .verification-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .verification-box {
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 400px;
            text-align: center;
        }
        .verification-input {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
            width: 100%;
        }
        .btn-verify {
            width: 100%;
            padding: 10px;
        }
        .resend-link {
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container verification-container">
        <div class="verification-box">
            <h3>Account Verification</h3>
            <p>Enter the verification code that was sent to your email</p>
            <form method="POST">
                <input type="text" name="verification_code" class="verification-input" placeholder="Enter your 5-digit verification code" required>
                <button type="submit" name="verify" class="btn btn-primary btn-verify">Verify</button>
            </form>
            <a href="admin_resendcode.php" class="resend-link">Didn't Receive a code? Resend</a>
        </div>
    </div>
</body>
</html>


<?php
// Connect to your database
include('../config/dbcon.php');

if (isset($_POST['verify'])) {
    $verification_code_input = $_POST['verification_code'];

    // Check if the verification code matches the one in the database and has not expired
    $sql = "SELECT * FROM tbl_admin WHERE verification_code = '$verification_code_input' AND verification_expires < NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update the user as verified
        $update_sql = "UPDATE tbl_admin SET email_verified = 1 WHERE verification_code = '$verification_code_input'";
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>
                Swal.fire({
                    title: 'Account Verified',
                    text: 'Your account has been verified successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'admin_login.php';
                });
            </script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Invalid Code',
                text: 'The verification code is invalid or expired.',
                icon: 'error',
                confirmButtonText: 'Try Again'
            });
        </script>";
    }

    $conn->close();
}
?>
