<?php
include('../config/dbcon.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo '<script>
        window.onload = function() {
            swal({
                title: "Error",
                text: "You must login first before you proceed!",
                icon: "error"
            }).then(function() {
                window.location = "admin_login.php";
            });
        };
    </script>';
    exit;
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_user WHERE id = $user_id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $id = $rows['id'];
        $admin_name = !empty($rows['username']) ? $rows['username'] : $rows['email'];
        $image = $rows['image'];
        $lastname = $rows['last_name'];
        $firstname = $rows['first_name'];
        $middle_name = $rows['middle_name'];
        $email = $rows['email'];
        $contact_no = $rows['contact_no'];
        $username = $rows['username'];
        $age = $rows['age'];
        $sex = $rows['sex'];
        $zip_code = $rows['zipcode'];
        $about_user = $rows['about_user'];
        $fullname = $firstname . ' ' . $lastname;

    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="css/landing-page.css">


<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
        padding: 2.5%;
    }

    .sidebar {
        flex: 1;
        max-width: 270px;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-right: 1px solid #ccc;
        text-align: center; /* Center content on small screens */
    }

    .sidebar img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 20px;
    }

    .sidebar p {
        margin: 5px 0;
        font-weight: bold;
        text-align: justify;
    }

    .main-content {
        flex: 2;
        padding: 20px;
        background-color: #fff;
        margin-left: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        min-width: 300px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        border-radius: 5px;
        width: 100%; /* Ensure the form control takes full width on mobile */
    }

    .btn {
        margin-right: 10px;
    }

    .btn-container {
        text-align: center;
    }

    /* Flex form group for larger screens */
    @media (min-width: 576px) {
        .form-group-inline {
            display: flex;
            justify-content: space-between;
        }

        .form-group-inline .form-group {
            flex: 1;
            margin-right: 10px;
        }

        .form-group-inline .form-group:last-child {
            margin-right: 0;
        }
    }

    /* Mobile view adjustments */
    @media (max-width: 575px) {
        .container {
            flex-direction: column;
            padding: 10px;
        }

        .sidebar {
            max-width: 100%;
            margin-bottom: 20px;
            border-right: none;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }

        .main-content {
            margin-left: 0;
            padding: 15px;
            min-width: 100%;
        }

        .form-control {
            width: 100%;
        }

        .btn-container {
            text-align: center;
        }


    }
</style>


</head>
<body>
    <nav class="navbar navbar-expand-lg "  style="background-color: #F7F9F2; position: sticky; top: 0; z-index: 1000;">
        <div class="container-fluid">
            <!-- Logo on the left -->
            <a class="navbar-brand" href="#">DAVAO GYM PORTAL</a>
            <!-- Toggler button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links (centered) -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown" style="padding-left: 15%;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php" style="color:#000000">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gym.php" style="color:#000000">Gym</a>
                    </li>
               
               
                </ul>
            </div>

            <!-- Dropdown (aligned to the right) -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item">Welcome: <?php echo $username;?></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php" >Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="container">
        <!-- Sidebar -->
        <div class="sidebar text-center">
        <img src="<?php echo !empty($image) ? 'user_image/' . $image : '../admin/profile_image/userpng.png'; ?>" alt="Owner Image">
           
            <p>Name: <?php echo $fullname;?></p>
            <p>Age: <?php echo $age;?></p>
            <p>Email: <?php echo $email;?></p>
            <p>Contact: <?php echo $contact_no;?></p>
            <a href="user_progress.php" class="btn btn-primary" style="margin-top: 20px;">Progress</a>

        </div>

        <!-- Main Content -->
        <div class="main-content">
        <form method="post" enctype="multipart/form-data">
                <div class="form-group-inline">
                    <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="name" placeholder="First Name" value="<?php echo $firstname;?>" required>
                    </div>
                    <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="name" placeholder="Last Name" value="<?php echo $lastname;?>" required>
                    </div>
                    <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" class="form-control" name="user_name" id="name" placeholder="User Name" value="<?php echo $username;?>" required>
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" class="form-control" name="age" id="age" placeholder="Age" required value="<?php echo $age;?>">
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact #</label>
                    <input 
                            type="text" 
                            class="form-control" 
                            name="contact" 
                            placeholder="Contact #" 
                            maxlength="11" 
                            oninput="validateContact(this)" 
                            required
                            value="<?php echo $contact_no;?>">
                    >
                    </div>
                    <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" name="current_password" id="name" placeholder="Enter Current Password" required>
                    </div>
                </div>

                <div class="form-group-inline">
                <div class="form-group">
                    <label for="name">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="name" placeholder="Enter New Password" required>
                    </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $email;?>" required>
                </div>
                    <div class="form-group">
                        <label for="contact">Upload image</label>
                        <input type="file" class="form-control" name="image" id="" required>
                    </div>
                </div>
         
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="dob" placeholder="MM/DD/YYYY" required>
                    </div>
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <input type="text" class="form-control" name="sex" id="sex" placeholder="Sex" value="<?php echo $sex;?>"  required >
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Zip Code</label>
                        <input type="text" class="form-control" name="zip_code" id="zipcode" placeholder="Zip Code" required value="<?php echo $zip_code;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="about">About User</label>
                    <textarea class="form-control" id="about" name="about_user" rows="4" placeholder="About User" required><?php echo $about_user;?></textarea>
                </div>
                <div class="btn-container">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                    <button type="submit" name="update_profile" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>


    <script>
        function validateContact(input) {
        // Allow only numeric values
        input.value = input.value.replace(/[^0-9]/g, '');

        // Ensure the length is at most 11
        if (input.value.length > 11) {
            input.value = input.value.slice(0, 11);
        }
    }
    </script>


    <?php
if (isset($_POST['update_profile'])) {
    $id = $_POST['id'];
    $lastname = $_POST['last_name'];
    $firstname = $_POST['first_name'];
    $age = $_POST['age'];
    $currentpassword = md5($_POST['current_password']);
    $newpassword = isset($_POST['new_password']) && !empty($_POST['new_password']) ? md5($_POST['new_password']) : $currentpassword;
    $email = $_POST['email'];
    $contact_no = $_POST['contact'];
    $username = $_POST['user_name'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $zip_code = $_POST['zip_code'];
    $about_user = $_POST['about_user'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        $ext_parts = explode('.', $image_name);
        $ext = end($ext_parts);
        $image_name = "User-Pic" . rand(0000, 9999) . "." . $ext;
        $src = $_FILES['image']['tmp_name'];
        $destination = "user_image/" . $image_name;

        if (!move_uploaded_file($src, $destination)) {
            echo '<script>
                swal({
                    title: "Error",
                    text: "Failed to upload image",
                    icon: "error"
                }).then(function() {
                    window.location = "profile.php";
                });
            </script>';
            exit;
        }
    }

    // Update the database
    $sql = "UPDATE tbl_user SET
            first_name = '$firstname',
            last_name = '$lastname',
            age = '$age',
            dob = '$dob',
            sex = '$sex',
            zipcode = '$zip_code',
            email = '$email',
            contact_no = '$contact_no',
            username = '$username',
            password = '$newpassword',
            image = '$image_name',
            about_user = '$about_user'
            WHERE id = $id";
            
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>
            swal({
                title: "Success",
                text: "Profile updated successfully",
                icon: "success"
            }).then(function() {
                window.location = "profile.php";
            });
        </script>';
    } else {
        // If something goes wrong, output the SQL error for debugging
        echo '<script>
            swal({
                title: "Error",
                text: "Failed to update profile: ' . mysqli_error($conn) . '",
                icon: "error"
            }).then(function() {
                window.location = "profile.php";
            });
        </script>';
    }
}
?>

    
    

     <!-- Footer -->
     <footer class="text-center text-white" style="background-color: #F7F9F2; padding: 20px 0;">
        <div class="container" style="color: #000000">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@davaogymportal.com</p>
                    <p>Phone: +63 123 456 789</p>
                </div>
                <div class="col-md-4" >
                    <h5>Follow Us</h5>
                    <a href="#" class="text-black me-2"><i class='bx bxl-facebook'></i></a>
                    <a href="#" class="text-black me-2"><i class='bx bxl-twitter'></i></a>
                    <a href="#" class="text-black"><i class='bx bxl-instagram'></i></a>
                </div>
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>We provide information on the best gyms in Davao City to help you achieve your fitness goals.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <p>&copy; 2024 Davao Gym Portal. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>





 
    
    
</body>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</html>