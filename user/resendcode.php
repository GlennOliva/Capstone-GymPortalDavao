<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resend Verification Code</title>
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
            <h3>Resend Verification Code</h3>
            <p>Enter your email address to receive a new verification code</p>
            <form method="POST">
                <input type="email" name="email" class="verification-input" placeholder="Enter your email address" required>
                <button type="submit" name="resend" class="btn btn-primary btn-verify">Resend Code</button>
            </form>
            <a href="admin_verify.php" class="resend-link">Back to Verification</a>
        </div>
    </div>

<?php
// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Change path if necessary

if (isset($_POST['resend'])) {
    include('../config/dbcon.php');

    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM tbl_user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate a new verification code
        $new_verification_code = rand(10000, 99999); // Generate a random 5-digit code
        $verification_expires = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set expiration to 1 hour

        // Update the verification code in the database
        $update_sql = "UPDATE tbl_user SET verification_code = '$new_verification_code', verification_expires = '$verification_expires' WHERE email = '$email'";
        if ($conn->query($update_sql) === TRUE) {
            // Send email with the new verification code using PHPMailer
            $mail = new PHPMailer(true); // Create a new PHPMailer instance

            try {
                //Server settings
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'davaogymportal@gmail.com'; // Your SMTP username
                $mail->Password = 'esyp btxq pfve kwvp'; // Your SMTP password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587; // TCP port to connect to

                //Recipients
              // Recipients
                $mail->setFrom('davaogymportal@gmail.com', 'Davao Gym Portal');
                $mail->addAddress($email); // Add a recipient

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Email Verification - Davao Gym Portal';
                $mail->Body = "Hi ,<br><br>Please verify your email by entering this 5-digit code:<br><strong>$new_verification_code</strong><br><br>Thank you!";
                $mail->AltBody = "Your new verification code is: $new_verification_code. It will expire in one hour."; // Plain text for non-HTML mail clients

                $mail->send();
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Code Sent',
                    text: 'A new verification code has been sent to your email.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'verify.php'; // Redirect to admin_verify.php
                    }
                });
            </script>";
            } catch (Exception $e) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Failed',
                        text: 'Failed to send email. Mailer Error: {$mail->ErrorInfo}',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Database Error',
                    text: 'Error updating verification code: " . $conn->error . "',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Email Not Found',
                text: 'This email address is not registered.',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    $conn->close();
}
?>
