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
        $row = mysqli_fetch_assoc($result);
        $admin_name = !empty($row['username']) ? $row['username'] : $row['email'];
        $image = $row['image'];
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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

        .profile-gym {
    width: 60%;
    margin: 0 auto; /* Centers the element horizontally */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adds a box shadow */
    padding: 20px; /* Optional padding */
    background-color: #fff; /* Optional: set a background color */
    border-radius: 10px; /* Optional: rounded corners */
}

        
      /* Flexbox for gym fields */
.profile-gym .image-upload {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 20px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
}

.profile-gym .row {
    display: flex;
    flex-direction: column; /* Ensure label and select are stacked vertically */
    margin-bottom: 15px;
}

textarea {
    width: 100%; /* Full width of the form */
    padding: 10px; /* Padding for spacing inside the textarea */
    border: 1px solid #ddd; /* Light border around the textarea */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Set the font size */
    resize: vertical; /* Allow resizing only vertically */
    height: 120px; /* Default height */
    margin-bottom: 15px; /* Space below the textarea */
}

.profile-gym .row input,
.profile-gym .row select,
.profile-gym textarea {
    width: 100%; /* Full width of the form */
    padding: 10px; /* Padding for spacing inside the fields */
    border: 1px solid #ddd; /* Light border around the fields */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Set the font size */
}

.profile-gym .address {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.profile-gym .payment-group {
    display: flex;
    justify-content: space-between;
}

.profile-gym .payment-group input, .profile-gym .payment-group select {
    width: 48%;
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
    background-color: #28a745;
}

/* Styling for the current gym image */
.gym-image {
    width: 150px; /* Set a fixed width for the image */
    height: 150px; /* Set a fixed height for the image */
    object-fit: cover; /* Ensure the image maintains aspect ratio */
    border-radius: 10px; /* Optional: make the image rounded */
    margin-bottom: 10px; /* Add space between the image and the label */
}

.image-upload-container {
    display: flex;
    flex-direction: column; /* Arranges elements vertically */
    align-items: center;    /* Centers items horizontally */
    justify-content: center; /* Centers items vertically within the container */
    margin-top: 20px;       /* Adds some space above the container */
}

.upload-label {
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 10px; /* Adds space between the label and input */
}

.image-upload input[type="file"] {
    padding: 10px;
}


/* Media query for screens smaller than 768px (tablets and small screens) */
@media screen and (max-width: 768px) {
    .profile-gym {
        width: 90%; /* Make the profile container wider on smaller screens */
        padding: 15px; /* Reduce padding */
    }

    .profile-gym .row {
        flex-direction: column; /* Stack inputs vertically */
        justify-content: flex-start;
    }

    .profile-gym .row input, .profile-gym .row select {
        width: 100%; /* Make each input take full width on smaller screens */
        margin-bottom: 10px;
    }

    .profile-gym .payment-group input, .profile-gym .payment-group select {
        width: 100%; /* Full width for payment fields */
        margin-bottom: 10px;
    }
    
    .gym-image {
        width: 100px; /* Reduce image size on smaller screens */
        height: 100px;
    }
}

/* Media query for screens smaller than 480px (mobile devices) */
@media screen and (max-width: 480px) {
    .profile-gym {
        width: 100%; /* Full width on mobile */
        padding: 10px; /* Reduce padding further for small screens */
    }

    .profile-gym .image-upload {
        flex-direction: column; /* Stack the upload area vertically */
    }

    .profile-gym .buttons {
        flex-direction: column; /* Stack buttons vertically */
        align-items: stretch; /* Ensure buttons take full width */
    }

    .buttons .edit-btn, .buttons .upload-btn {
        padding: 8px 16px; /* Smaller buttons */
        width: 100%; /* Full width on mobile */
    }

    textarea {
        height: 100px; /* Reduce height of the textarea on mobile */
    }

    .gym-image {
        width: 80px; /* Further reduce image size for small screens */
        height: 80px;
    }
    
    .image-upload-container {
        margin-top: 10px; /* Reduce margin on mobile */
    }

    .upload-label {
        font-size: 16px; /* Smaller font size on mobile */
    }
}


    </style>
	
	<!-- SIDEBAR -->
	<section id="sidebar">
        <h1 class="logo">GYM PORTAL DAVAO</h1>
		<ul class="side-menu">
            <li><a href="profile.php" ><i class='bx bxs-user-circle icon'></i> Profile</a></li>
            <li><a href="gym.php" ><i class='bx bx-dumbbell icon'></i> Gym</a></li>
            <li><a href="gym_about.php" ><i class='bx bxs-inbox icon'></i> About</a></li>
            <li><a href="gym_class.php" ><i class='bx bxs-chart icon'></i> Classes</a></li>
            <li><a href="gym_services.php" ><i class='bx bxs-widget icon'></i> Services</a></li>
            <li><a href="gym_events.php" ><i class='bx bx-table icon'></i> Events</a></li>
            <li><a href="gym_inventory.php" class="active"><i class='bx bxs-notepad icon'></i> Inventory</a></li>
            <!-- <li><a href="gym_contact.php" ><i class='bx bxs-message icon'></i> Contact</a></li> -->
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

		<!-- MAIN -->
		<main>
            <h1 class="title">Edit User Progress</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Admin</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Edit Progress</a></li>
            </ul>

            <?php
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_userprogress WHERE id=$id";

            $result = mysqli_query($conn,$sql);

                    //check if the query is executed or not!
                    if($result == True)
                    {
                        //check if the data is available or not
                        $count = mysqli_num_rows($result);

                        //ccheck if we have admin data or not
                        if($count==1)
                        {
                            //display the details
                            //echo "admin available"; 
                            $row = mysqli_fetch_assoc($result);

                            $id = $row['id'];
                            $exercise = $row['excercise'];
                            $weight = $row['weight'];
                            $repetition = $row['repetition'];
                            $user_id = $row['user_id'];
                        
                        }
                        else
                        {
                            header('Location: gym_class.php');
                            exit();
                        }
                    }
            
            ?>

         <!-- GYM FORM -->
         <div class="profile-gym">
    <form method="POST" enctype="multipart/form-data">
        <!-- Image upload -->


        <!-- First row -->
        <div class="row">
            <input type="text" name="exercise" placeholder="Enter Exercise" value="<?php echo htmlspecialchars($exercise); ?>" required>
        </div>

        <div class="row">
            <input type="text" name="weight" placeholder="Enter Weight" value="<?php echo htmlspecialchars($weight); ?>" required>
        </div>

        <div class="row">
            <input type="text" name="reps" placeholder="Enter Repetition" value="<?php echo htmlspecialchars($repetition); ?>" required>
        </div>
        <!-- Second row -->

        
        <div class="row">
    <input type="date" name="created_at" placeholder="Repetition Date" required>
</div>

        <!-- Buttons -->
        <div class="buttons">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="submit" name="update_inventory" value="Edit" class="upload-btn">
        </div>
    </form>
</div>



<?php
if (isset($_POST['update_inventory'])) {

    $exercise = $_POST['exercise'];
    $weight= $_POST['weight'];
    $repetition = $_POST['reps'];
    $id = $_POST['id'];
    $created_at = $_POST['created_at'];
   

    // Update query
    $sql = "UPDATE tbl_userprogress SET excercise = '$exercise', weight = '$weight', repetition = '$repetition', created_at = '$created_at' WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($res == true) {
        // SweetAlert success message
        echo '<script>
                swal({
                    title: "Success",
                    text: "Userprogress successfully updated!",
                    icon: "success"
                }).then(function() {
                     window.location = "gym_progress.php?id=' . $user_id . '";
                });
            </script>';
    } else {
        // SweetAlert error message
        echo '<script>
                swal({
                    title: "Error",
                    text: "User progress details failed to update.",
                    icon: "error"
                }).then(function() {
                    window.location = "edit_progress.php?id=' . $id . '";
                });
            </script>';
    }
}
?>











		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

    <?php include('../components/admin_footer.php');?>
