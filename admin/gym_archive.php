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
        
        /* Style for the table */
        .gym-table-container {
            margin: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .gym-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .gym-table th {
            background-color: #00BFFF;
            color: white;
            padding: 10px;
        }

        .gym-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .gym-table tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            justify-content: space-around;
        }

       
        .action-buttons a {
         
         display: inline-block; /* Ensures it behaves like a button */
 margin: 10px 0;
 background-color: #00BFFF;
 color: white;
 padding: 10px 20px; /* Spacing inside the button */
 border: none;
 border-radius: 5px;
 text-align: center; /* Center text horizontally */
 text-decoration: none; /* Remove underline from link */
 cursor: pointer; /* Show a pointer cursor */
     }
   
     .action-buttons a.delete {
         background-color: #ff4d4d;
     }

     .insert-button {
 display: inline-block; /* Ensures it behaves like a button */
 margin: 10px 0;
 background-color: #32CD32; /* Green background */
 color: white;
 padding: 10px 20px; /* Spacing inside the button */
 border: none;
 border-radius: 5px;
 text-align: center; /* Center text horizontally */
 text-decoration: none; /* Remove underline from link */
 cursor: pointer; /* Show a pointer cursor */
}

.insert-button:hover {
 background-color: #28a745; /* Slightly darker green on hover */
}

/* Responsive Styling */
@media screen and (max-width: 768px) {
    .gym-table-container {
        margin: 15px; /* Reduce margins for smaller screens */
        padding: 10px;
    }

    /* Add a wrapper for the table to make it scrollable */
    .gym-table-container {
        overflow-x: auto; /* Enable horizontal scrolling */
    }

    .gym-table {
        width: 1000px; /* Set a minimum width to force scrolling */
    }
}

@media screen and (max-width: 480px) {
    /* Further reduce margin and padding for mobile devices */
    .gym-table-container {
        margin: 10px;
        padding: 5px;
    }

    .gym-table {
        width: 800px; /* Set a width that fits content and enables scrolling */
    }

    /* Adjust the padding of the action buttons on smaller screens */
    .action-buttons a {
        padding: 8px 10px; /* Smaller buttons for mobile */
    }

    .insert-button {
        padding: 8px 10px; /* Smaller insert button for mobile */
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
            <li><a href="gym_services.php"><i class='bx bxs-widget icon'></i> Services</a></li>
            <li><a href="gym_events.php"><i class='bx bx-table icon'></i> Events</a></li>
            <li><a href="gym_inventory.php"><i class='bx bxs-notepad icon'></i> Inventory</a></li>
            <!-- <li><a href="gym_contact.php" ><i class='bx bxs-message icon'></i> Contact</a></li> -->
            <li>
				<a href="#" class="active"><i class='bx bxs-group icon'></i></i>Members<i
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
    <h1 class="title">Archive</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Admin</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Archive</a></li>
    </ul>

    <div class="gym-table-container">
        <!-- Gym Table -->
        <table class="gym-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Contact #</th>
                    <th>Email</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
    <?php
    // Fetch archived data
    $sql = "
    SELECT 
        m.*, 
        u.first_name, 
        u.last_name, 
        u.age, 
        u.contact_no, 
        u.email, 
        c.class_name
    FROM 
        tbl_membership AS m
    JOIN 
        tbl_user AS u ON m.user_id = u.id
    JOIN 
        tbl_class AS c ON m.class_id = c.id
    WHERE 
        m.admin_id = '$admin_id' AND m.status = 'Archived'
    ";
    $res = mysqli_query($conn, $sql);

    // Check if there are any records
    if ($res == true) {
        $count = mysqli_num_rows($res);
        $sn = 1; // Serial Number

        if ($count > 0) {
            // Loop through each row and display data
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $user_id = $row['user_id'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $age = $row['age'];
                $contact_no = $row['contact_no'];
                $email = $row['email'];
                $class_name = $row['class_name'];
    ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $first_name; ?></td>
                    <td><?php echo $last_name; ?></td>
                    <td><?php echo $age; ?></td>
                    <td><?php echo $contact_no; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $class_name; ?></td>
                </tr>
    <?php
            }
        } else {
            // If no records found
            echo "<tr><td colspan='8'>No archived data found</td></tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Failed to retrieve data</td></tr>";
    }
    ?>
            </tbody>
        </table>
    </div>
</main>

		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

    <?php include('../components/admin_footer.php');?>