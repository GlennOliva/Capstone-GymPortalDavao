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
    justify-content: space-between;
    margin-bottom: 15px;
}

.profile-gym .row input, .profile-gym .row select {
    width: 32%; /* 3 columns of equal width */
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
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
            <li><a href="gym.php" class="active"><i class='bx bx-dumbbell icon'></i> Gym</a></li>
            <li><a href="gym_about.php" ><i class='bx bxs-inbox icon'></i> About</a></li>
            <li><a href="gym_class.php" ><i class='bx bxs-chart icon'></i> Classes</a></li>
            <li><a href="gym_services.php"><i class='bx bxs-widget icon'></i> Services</a></li>
            <li><a href="gym_events.php"><i class='bx bx-table icon'></i> Events</a></li>
            <li><a href="gym_inventory.php"><i class='bx bxs-notepad icon'></i> Inventory</a></li>
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
            <img src="admin_image/<?php echo $image;?>" alt="">
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
            <h1 class="title">Edit Gym</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Admin</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Edit Gym</a></li>
            </ul>


            <?php
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_gym WHERE id=$id";

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
                            $gym_name = $row['gym_name'];
                            $gym_email = $row['gym_email'];
                            $gym_contact = $row['gym_contact'];
                            $gym_address = $row['gym_address'];
                            $payment_method = $row['payment_method'];
                            $payment_no = $row['payment_no'];
                            $image = $row['gym_image'];
                        
                        }
                        else
                        {
                            header('Location: gym.php');
                            exit();
                        }
                    }
            
            ?>

         <!-- GYM FORM -->
           <!-- GYM FORM -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="profile-gym">
        <!-- Image upload -->
        <div class="image-upload-container">
            <!-- Current gym image -->
            <img src="gym_image/<?php echo $image; ?>" alt="Current Gym Image" class="gym-image">
            <!-- Upload label -->
            <span class="upload-label">Upload Gym Image</span>
            <!-- Upload input -->
            <div class="image-upload">
                <input type="file" name="gym_image" id="">
            </div>
        </div>

        <!-- First row -->
        <div class="row">
            <input type="text" name="gym_name" placeholder="Gym Name" value="<?php echo $gym_name ?>" required>
            <input type="email" name="gym_email" placeholder="Gym Email" value="<?php echo $gym_email; ?>" required>
            <input type="tel" name="gym_contact" placeholder="Gym Contact #" value="<?php echo $gym_contact; ?>" required>
        </div>

        <!-- Second row -->
        <input type="text" name="gym_address" class="address" placeholder="Address" value="<?php echo $gym_address; ?>" required>

        <!-- Third row -->
        <div class="payment-group">
            <select name="payment_method" required>
                <option <?php if ($payment_method == 'Credit Card') echo 'selected'; ?>>Credit Card</option>
                <option <?php if ($payment_method == 'Paypal') echo 'selected'; ?>>Paypal</option>
            </select>
            <input type="text" name="payment_no" placeholder="No. #" value="<?php echo $payment_no; ?>" required>
        </div>

        <!-- Buttons -->
        <div class="buttons">
            <input type="submit" name="edit_gym" class="upload-btn" value="Edit">
        </div>
    </div>
</form>




<?php
if (isset($_POST['edit_gym'])) {
    // Get form data
    $gym_name = $_POST['gym_name'];
    $gym_email = $_POST['gym_email'];
    $gym_contact = $_POST['gym_contact'];
    $gym_address = $_POST['gym_address'];
    $payment_method = $_POST['payment_method'];
    $payment_no = $_POST['payment_no'];
    
    // Image upload handling
    // Image upload handling
if (isset($_FILES['gym_image']['name']) && $_FILES['gym_image']['name'] != "") {
    $image_name = $_FILES['gym_image']['name'];
    
    // Fix the reference issue by splitting and storing the result in a variable
    $temp = explode('.', $image_name); // Get the extension of the image file
    $ext = end($temp); // Now pass the array to end() as a variable
    
    // Rename the image
    $image_name = "Gym-Image-" . rand(0000, 9999) . '.' . $ext;

    $source_path = $_FILES['gym_image']['tmp_name'];
    $destination_path = "gym_image/" . $image_name; // Folder to store the image

    $upload = move_uploaded_file($source_path, $destination_path);

    if ($upload == false) {
        echo "<script>swal('Error', 'Failed to upload image.', 'error');</script>";
        die();
    }

    // Remove old image if a new one is uploaded
    if ($image != "") {
        $remove_path = "gym_image/" . $image;
        unlink($remove_path);
    }
} else {
    // If no new image is uploaded, retain the old one
    $image_name = $image;
}


    // Update query
    $sql2 = "UPDATE tbl_gym 
             SET gym_name='$gym_name', 
                 gym_email='$gym_email', 
                 gym_contact='$gym_contact', 
                 gym_address='$gym_address', 
                 payment_method='$payment_method', 
                 payment_no='$payment_no', 
                 gym_image='$image_name' 
             WHERE id=$id";

    // Execute the query
    $res2 = mysqli_query($conn, $sql2);

    // Check if the query was successful
    if ($res2 == true) {
        echo "<script>
                swal('Success', 'Gym details successfully updated.', 'success')
                .then(function() {
                    window.location.href = 'gym.php';
                });
              </script>";
    } else {
        echo "<script>
                swal('Error', 'Failed to update gym details.', 'error')
                .then(function() {
                    window.location.href = 'edit_gym.php?id=$id';
                });
              </script>";
    }
}
?>











		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

    <?php include('../components/admin_footer.php');?>
