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
    <input 
        type="text" 
        class="form-control" 
        name="contact" 
        placeholder="Contact #" 
        maxlength="11" 
        oninput="validateContact(this)" 
        required>
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
    <input 
        class="form-check-input me-2" 
        type="checkbox" 
        name="terms_agreement" 
        id="termsAgreement" 
        onclick="showPrivacyModal(this)">
    <label class="form-check-label" for="termsAgreement">
        Terms & Agreement
    </label>
</div>
    <hr style="border: 1px solid #000;">
    <button type="submit" class="btn register-btn" name="register">Create New Account</button>

    <hr style="border: 1px solid #000;">
    <a href="login.php" class="btn login-btn">LOGIN</a>

    <!-- <a href="login.php" class="btn login-btn">Login</a> -->
</form>

    </div>


    <script>
    function showPrivacyModal(checkbox) {
        // Temporarily prevent the checkbox from changing state
        checkbox.checked = false;

        // Show the modal
        var privacyModal = new bootstrap.Modal(document.getElementById('privacyModal'));
        privacyModal.show();

        // Handle the "Agree" button
        document.getElementById('agreeButton').onclick = function () {
            // Check the checkbox if the user agrees
            checkbox.checked = true;
            privacyModal.hide();
        };

        // Optional: Ensure the checkbox remains unchecked if modal is closed without agreement
        document.getElementById('privacyModal').addEventListener('hidden.bs.modal', function () {
            if (!checkbox.checked) {
                checkbox.checked = false;
            }
        });
    }


    function validateContact(input) {
        // Allow only numeric values
        input.value = input.value.replace(/[^0-9]/g, '');

        // Ensure the length is at most 11
        if (input.value.length > 11) {
            input.value = input.value.slice(0, 11);
        }
    }
</script>


<!-- Privacy Agreement Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">Privacy Agreement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <!-- Privacy content -->
                <p><strong>Personal Data Collection:</strong> As part of our registration process, we collect essential personal information to ensure secure access and personalized service. This includes but is not limited to your name, contact information, and gym usage preferences. We handle all data in compliance with relevant data protection laws, ensuring that your information remains safe and private.</p>
                <p><strong>Usage of Collected Data:</strong> The data we gather is solely for improving your experience and personalizing services within the Davao Gym Portal. This may include sending updates about gym activities, promotions, or any changes in gym policies. We do not share your information with third parties without your explicit consent.</p>
                <p><strong>Security Measures:</strong> We take all necessary precautions to secure your data. Our system is equipped with advanced encryption to prevent unauthorized access, ensuring that only authorized personnel can handle your personal information. Your data will be stored securely and will only be used for the intended purpose as per our agreement.</p>
                <p><strong>User Responsibilities:</strong> As a user, you agree to follow the gym rules, including respecting equipment, maintaining hygiene standards, and abiding by gym hours. Violations may lead to suspension or termination of access to our facilities to ensure a safe and enjoyable environment for all members.</p>
                <p><strong>Right to Withdraw Consent:</strong> You may withdraw consent for the use of your data at any time by contacting our support team. Doing so may limit certain features of the Davao Gym Portal, but we will respect your privacy choices and discontinue data processing accordingly.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="agreeButton">Agree</button>
            </div>
        </div>
    </div>
</div>



    <?php
if (isset($_POST['register'])) {
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
        $sql = "INSERT INTO tbl_user (first_name, last_name, middle_name, email, contact_no, username, password, verification_code, verification_expires)
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
                $mail->Password = 'lfyl tvzn gqzs wcvr'; // Your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
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
                        window.location.href = 'verify.php';
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




    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
