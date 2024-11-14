<?php
include('../config/dbcon.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body {
            background-color: #F7F9F2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: white;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .register-container h1 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-control {
            margin-bottom: 1rem;
            border-radius: 5px;
        }

        .register-btn {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            width: 100%;
        }

        .register-btn:hover {
            background-color: #3FB028;
        }

        .login-btn {
            background-color: #5b9bd5;
            color: white;
            border-radius: 5px;
            width: 100%;
            margin-top: 1rem;
        }

        .login-btn:hover {
            background-color: #6D9EEB;
        }

        .back-arrow {
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="back-arrow">
            <a href="#"><i class="bi bi-arrow-left"></i></a>
        </div>
        <h1>Davao Gym Portal</h1>
        <h5 class="text-center" style="font-size: 12px; padding-bottom: 5px;">Register</h5>
        <form method="post">
    <div class="row">
        <div class="col-md-4">
            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="middle_name" placeholder="Middle Initial" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
        </div>
        <div class="col-md-6">
    <input type="text" maxlength="11" pattern="\d{11}" class="form-control" name="contact" placeholder="Contact #" required>
</div>

    </div>
    <hr style="border: 1px solid #000;">
    <div class="row">
        <div class="col-md-4">
            <input type="text" class="form-control" name="username" placeholder="User Name" required>
        </div>
        <div class="col-md-4">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="col-md-4">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
        </div>
    </div>
    <div class="form-check my-3 d-flex justify-content-center align-items-center">
        <input class="form-check-input me-2" type="checkbox" value="1" id="termsAgreement" name="terms_agreement" required>
        <label class="form-check-label" for="termsAgreement">
            Terms & Agreement
        </label>
    </div>
    <hr style="border: 1px solid #000;">
    <button type="submit" class="btn register-btn" name="register">Create New Account</button>


</form>


<?php
if(isset($_POST['register'])) {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

   // Check if password and confirm password match
   if ($password === $confirm_password) {
    // Hash the password using MD5
    $hashed_password = md5($password);

    // Generate 5-digit verification code and expiration time (1 hour from now)
    $verification_code = mt_rand(10000, 99999);
    $verification_expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

    // SQL query to insert data into tbl_user with verification details
    $sql = "INSERT INTO tbl_admin (first_name, last_name, middle_name, email, contact_no, username, password, verification_code, verification_expires)
            VALUES ('$first_name', '$last_name', '$middle_name', '$email', '$contact', '$username', '$hashed_password', '$verification_code', '$verification_expires')";

    // Execute query and check if insertion was successful
    if ($conn->query($sql) === TRUE) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'davaogymportal@gmail.com'; // Your SMTP username
            $mail->Password = 'esyp btxq pfve kwvp'; // Your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('davaogymportal@gmail.com', 'Davao Gym Portal');
            $mail->addAddress($email, $first_name . ' ' . $last_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification - Davao Gym Portal';
            $mail->Body = "Hi $first_name,<br><br>Please verify your email by entering this 5-digit code:<br><strong>$verification_code</strong><br><br>Thank you!";

            $mail->send();

            echo "<script>
                swal({
                    title: 'Registration Successful',
                    text: 'Please check your email for the verification code.',
                    icon: 'success',
                    button: 'OK'
                }).then(function() {
                    window.location.href = 'admin_verify.php';
                });
            </script>";

        } catch (Exception $e) {
            echo "<script>
                swal({
                    title: 'Error',
                    text: 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}',
                    icon: 'error',
                    button: 'OK'
                });
            </script>";
        }

    } else {
        echo "<script>
            swal({
                title: 'Registration Failed',
                text: 'Error: " . $conn->error . "',
                icon: 'error',
                button: 'OK'
            }).then(function() {
                window.location.href = 'register.php';
            });
        </script>";
    }

    $conn->close();
} else {
    echo "<script>
        swal({
            title: 'Password Mismatch',
            text: 'The passwords do not match. Please try again.',
            icon: 'error',
            button: 'OK'
        });
    </script>";
}
}
?>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
