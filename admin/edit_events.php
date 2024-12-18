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
        <li><a href="dashboard.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li><a href="profile.php" ><i class='bx bxs-user-circle icon'></i> Profile</a></li>
            <li><a href="gym.php" ><i class='bx bx-dumbbell icon'></i> Gym</a></li>
            <li><a href="gym_about.php" ><i class='bx bxs-inbox icon'></i> About</a></li>
            <li><a href="gym_class.php" ><i class='bx bxs-chart icon'></i> Classes</a></li>
            <li><a href="gym_services.php" ><i class='bx bxs-widget icon'></i> Services</a></li>
            <li><a href="gym_events.php" class="active"><i class='bx bx-table icon'></i> Events</a></li>
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
            <h1 class="title">Edit Events</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Admin</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Edit Events</a></li>
            </ul>
            <?php
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_event WHERE id=$id";

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
                            $event_name = $row['event_name'];
                            $description = $row['description'];
                            $image = $row['event_image'];
                        
                        }
                        else
                        {
                            header('Location: gym_events.php');
                            exit();
                        }
                    }
            
            ?>

         <!-- GYM FORM -->
         <div class="profile-gym">
    <form method="POST" enctype="multipart/form-data">
        <!-- Image upload -->
        <div class="image-upload-container">
            <!-- Current class image -->
            <img src="events_image/<?php echo $image; ?>" alt="Current Class Image" class="gym-image">
            <!-- Upload label -->
            <span class="upload-label">Upload Event Image</span>
            <!-- Upload input -->
            <div class="image-upload">
                <input type="file" name="class_image" id="class_image">
            </div>
        </div>

        <div class="row">
            <select name="gym_id" id="gym_id" required>
                <option value="">Select a gym</option>
                <?php
                // Fetch gyms from the database
                $query = "SELECT * FROM tbl_gym WHERE admin_id = $admin_id";
                $result = mysqli_query($conn, $query);

                // Populate dropdown options
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = ($row['id'] == $row['gym_id']) ? 'selected' : '';
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . htmlspecialchars($row['gym_name']) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- First row -->
        <div class="row">
            <input type="text" name="event_name" placeholder="Enter Class" value="<?php echo htmlspecialchars($event_name); ?>" required>
        </div>
        <!-- Second row -->
        <textarea name="description" placeholder="Enter Description" required><?php echo htmlspecialchars($description); ?></textarea>

        <!-- Buttons -->
        <div class="buttons">
            <input type="submit" name="update_event" value="Edit" class="upload-btn">
        </div>
    </form>
</div>



<?php
if (isset($_POST['update_event'])) {
    $event_name = $_POST['event_name'];
    $description = $_POST['description'];
    $gym_id = $_POST['gym_id'];

    // Image upload handling
    if (isset($_FILES['class_image']['name']) && $_FILES['class_image']['name'] != "") {
        $image_name = $_FILES['class_image']['name'];
        $ext = pathinfo($image_name, PATHINFO_EXTENSION); // Using pathinfo to get the extension
        $image_name = "Events-Image-" . rand(0000, 9999) . '.' . $ext; // Rename the image

        $source_path = $_FILES['class_image']['tmp_name'];
        $destination_path = "events_image/" . $image_name; // Folder to store the image

        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload == false) {
            echo '<script>
                    swal({
                        title: "Error",
                        text: "Failed to upload image.",
                        icon: "error"
                    }).then(function() {
                        window.location = "edit_events.php?id=' . $id . '";
                    });
                </script>';
            die();
        }
    } else {
        $image_name = $image; // Use the old image if no new one is uploaded
    }

    // Update query
    $sql = "UPDATE tbl_event SET gym_id='$gym_id', event_name='$event_name', description='$description', event_image='$image_name' WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($res == true) {
        // SweetAlert success message
        echo '<script>
                swal({
                    title: "Success",
                    text: "Event details successfully updated!",
                    icon: "success"
                }).then(function() {
                    window.location = "gym_events.php";
                });
            </script>';
    } else {
        // SweetAlert error message
        echo '<script>
                swal({
                    title: "Error",
                    text: "Event details failed to update.",
                    icon: "error"
                }).then(function() {
                    window.location = "edit_events.php?id=' . $id . '";
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
