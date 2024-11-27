<?php
include('../config/dbcon.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
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

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT * FROM tbl_admin WHERE id = $admin_id";

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
    } 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" href="../admin/css/style.css">
	<title>Admin</title>
</head>
<body>

    <style>
        .logo {
           font-size: 20px;
           text-align: center;
           font-weight: bold;
           margin-top: 30px;
        }

        .profile-container {
    display: flex;
    align-items: center;
    margin-top: 20px;
}

.profile-owner {
    display: flex;
    align-items: center;
    width: 100%;
}

.profile-image {
    margin-right: 20px;
}

.profile-image img {
    border-radius: 50%;
    width: 100px; /* Adjust size as needed */
    height: 100px; /* Adjust size as needed */
}

.profile-details {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.profile-details h2 {
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
}

.row {
    display: flex;
    justify-content: space-between;
}

.row input {
    width: 32%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.contact-group {
    display: flex;
    justify-content: space-between;
}

.contact-group input {
    width: 32%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 2%;
        }

        .buttons .edit-btn, .buttons .upload-btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .edit-btn {
            background-color: #f39c12;
            color: white;
        }

        .upload-btn {
            background-color: #27ae60;
            color: white;
        }

        /* Responsive Styling */
@media screen and (max-width: 768px) {
    .profile-container {
        flex-direction: column; /* Stack profile image and details vertically */
        align-items: center; /* Center align the content */
    }

    .profile-image {
        margin-right: 0; /* Remove right margin on smaller screens */
        margin-bottom: 20px; /* Add bottom margin for spacing */
    }

    .row {
        flex-direction: column; /* Stack input fields vertically */
        width: 100%; /* Full width on smaller screens */
    }

    .row input {
        width: 100%; /* Full width inputs */
        margin-bottom: 15px; /* Add spacing between inputs */
    }

    .contact-group {
        flex-direction: column; /* Stack contact fields vertically */
        width: 100%; /* Full width on smaller screens */
    }

    .contact-group input {
        width: 100%; /* Full width inputs */
        margin-bottom: 15px; /* Add spacing between inputs */
    }

    .buttons {
        justify-content: center; /* Center buttons on smaller screens */
        margin-top: 15px;
    }
}

@media screen and (max-width: 480px) {
    .profile-owner {
        flex-direction: column; /* Move profile-image to the top */
        align-items: center;
    }

    .profile-image img {
        width: 80px; /* Reduce size for mobile */
        height: 80px;
        margin: 0 auto 20px; /* Center the image and add bottom margin */
    }

    .profile-details h2 {
        font-size: 16px; /* Smaller font size for mobile */
    }

    .buttons .edit-btn, 
    .buttons .upload-btn {
        padding: 8px 16px; /* Smaller buttons on mobile */
    }
}


       
    </style>
	
	<!-- SIDEBAR -->
	<section id="sidebar">
        <h1 class="logo">GYM PORTAL DAVAO</h1>
		<ul class="side-menu">
        <li><a href="dashboard.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li><a href="profile.php" class="active"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
            <li><a href="gym.php" ><i class='bx bx-dumbbell icon'></i> Gym</a></li>
            <li><a href="gym_about.php" ><i class='bx bxs-inbox icon'></i> About</a></li>
            <li><a href="gym_class.php"><i class='bx bxs-chart icon'></i> Classes</a></li>
            <li><a href="gym_services.php"><i class='bx bxs-widget icon'></i> Services</a></li>
            <li><a href="gym_events.php"><i class='bx bx-table icon'></i> Events</a></li>
            <li><a href="gym_inventory.php"><i class='bx bxs-notepad icon'></i> Inventory</a></li>
            <li>
				<a href="#"><i class='bx bxs-group icon'></i></i>Members<i
						class='bx bx-chevron-right icon-right'></i></a>
				<ul class="side-dropdown">
                <li><a href="gym_member.php">Membership</a></li>
                <li><a href="gym_pending.php">Pending Application</a></li>
                <li><a href="gym_archive.php">Archive</a></li>

				</ul>
			</li>

        </ul>
	</section>
	<!-- SIDEBAR -->


 



	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav >
			<i class='bx bx-menu toggle-sidebar'></i>
			<div class="profile" style="margin-left: 92%;">
            <img src="<?php echo !empty($image) ? 'admin_image/' . $image : 'profile_image/admin_defaultprofile.png'; ?>" alt="Owner Image">
                <ul class="profile-link">
                <li><p style="padding-left: 10%; padding-top: 3%;">Hi there! <b><?php echo $admin_name;?></b></p></li>
					<li><a href="profile.php"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
					<li><a href="admin_logout.php"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->


        <?php
        $sql = "SELECT * FROM tbl_admin"
        
        ?>

		<!-- MAIN -->
		<main>
            <h1 class="title">Profile</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Admin</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Profile</a></li>
            </ul>
        
            <!-- PROFILE FORM -->
            <div class="profile-container">
                <!-- GYM OWNER FORM -->
                <div class="profile-owner">
                <div class="profile-image">
    <img src="<?php echo !empty($image) ? 'admin_image/' . $image : 'profile_image/admin_defaultprofile.png'; ?>" alt="Owner Image">
</div>

                    <div class="profile-details">
                        <h2>GYM OWNER</h2>
                        <!-- First row -->
                        <form action="" method="post" enctype="multipart/form-data">  
                        <div class="row">
                            <input type="text" placeholder="Last Name" name="lastname" value="<?php echo $lastname;?>" required>
                            <input type="text" placeholder="First Name" name="firstname" value="<?php echo $firstname;?>" required>
                            <input type="text" placeholder="Middle Name" name="middlename" value="<?php echo $middle_name;?>" required>
                        </div>
                        <div class="row">
                        <input type="text" placeholder="Username" name="username" value="<?php echo $username;?>" required>
                            <input type="password" placeholder="Enter Current Password" name="current_password">
                            <input type="password" placeholder="Enter New Password" name="new_password"  >
                            
                        </div>
                        <!-- Second row -->
                        <div class="contact-group">
                            <input type="email" placeholder="Email" name="email" value="<?php echo $email;?>" required>
                            <input 
        type="text" 
        class="form-control" 
        name="contact_no" 
        placeholder="Contact #" 
        maxlength="11" 
        oninput="validateContact(this)" 
        required
        value="<?php echo $contact_no;?>">
                            <input type="file" name="image" id="" placeholder="Image">
                        </div>

                            <!-- Buttons -->
                    <div class="buttons">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $image;?>">
                        <input class="edit-btn" type="submit" value="Edit" name="update_profile">
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </main>


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
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];

    // Handle password
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Check if the new password is provided
    if (!empty($new_password)) {
        $password = md5($new_password); // Hash the new password
    } else {
        // Retain the current password
        $get_password_sql = "SELECT password FROM tbl_admin WHERE id = $id";
        $password_result = mysqli_query($conn, $get_password_sql);
        if ($password_result && mysqli_num_rows($password_result) > 0) {
            $password_row = mysqli_fetch_assoc($password_result);
            $password = $password_row['password'];
        } else {
            echo '<script>
                swal({
                    title: "Error",
                    text: "Failed to retrieve current password",
                    icon: "error"
                }).then(function() {
                    window.location = "profile.php";
                });
            </script>';
            exit;
        }
    }

    // Handle image upload
    $image_name = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : "";
    if ($image_name != "") {
        $ext_parts = explode('.', $image_name);
        $ext = end($ext_parts);
        $image_name = "Admin-Pic" . rand(0000, 9999) . "." . $ext;
        $src = $_FILES['image']['tmp_name'];
        $destination = "admin_image/" . $image_name;

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
    } else {
        // Retain the current image if no new image is uploaded
        $image_name = $_POST['current_image'];
    }

    // Update the database
    $sql = "UPDATE tbl_admin SET
        first_name = '$firstname',
        last_name = '$lastname',
        middle_name = '$middlename',
        email = '$email',
        contact_no = '$contact_no',
        username = '$username',
        password = '$password',
        image = '$image_name'
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
        echo '<script>
            swal({
                title: "Error",
                text: "Failed to update profile",
                icon: "error"
            }).then(function() {
                window.location = "profile.php";
            });
        </script>';
    }
}
?>


        
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

    <?php include('../components/admin_footer.php');?>
