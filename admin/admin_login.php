<?php
include('../config/dbcon.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
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

        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h1 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-control {
            margin-bottom: 1rem;
            border-radius: 5px;
        }

        .login-btn {
            background-color: #5b9bd5;
            color: white;
            border-radius: 5px;
            width: 100%;
        }

        .login-btn:hover{
            background-color: #6D9EEB;
            color: white;
        }

       

        .create-account-btn {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            width: 100%;
            margin-top: 1rem;
        }

        .create-account-btn:hover {
            background-color:  #3FB028;
            color: white;
           
        }

     
    </style>
</head>
<body>
    <div class="login-container">
        <div class="back-arrow">
            <a href="#"><i class="bi bi-arrow-left"></i></a>
        </div>
        <h1>Davao Gym Portal</h1>
        <form method="post">
            <input type="text" name="username_email" class="form-control" placeholder="Email / Username">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <input type="submit" name="login" class="btn login-btn" value="Login">
            <hr style="border: 1px solid #000;">
            <a href="admin_register.php" class="btn create-account-btn">Create New Account</a>
        </form>
    </div>


    <?php
    if(isset($_POST['login']))
    {
        $username_email = $_POST['username_email'];
        $password = md5($_POST['password']);


        $sql = "SELECT * FROM tbl_admin WHERE (username = '$username_email' || email = '$username_email') && password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $rows = mysqli_fetch_assoc($result);
            $_SESSION['admin_id'] = $rows['id'];
            $_SESSION['username'] = $rows['username'];
            $_SESSION['email'] = $rows['email'];
            echo "<script>
    swal({
        title: 'Login Successful',
        text: 'Welcome, " . (!empty($rows['username']) ? $rows['username'] : $rows['email']) . "!',
        icon: 'success',
        button: 'OK'
    }).then(function() {
        window.location.href = 'profile.php'; // Redirect to the profile page
    });
</script>";
    } else {
        // If no user found, show an error message
        echo "<script>
                swal({
                    title: 'Login Failed',
                    text: 'Invalid username, email, or password.',
                    icon: 'error',
                    button: 'Try Again'
                });
              </script>";
    }
}
    
    
    ?>
</body>
</html>
