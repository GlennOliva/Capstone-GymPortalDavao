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



// Fetch data from tbl_inventory
$sql = "SELECT inventory_name, quantity, created_at FROM tbl_inventory WHERE admin_id = '$admin_id'";
$res = mysqli_query($conn, $sql);

// Initialize arrays to hold data for the chart
$item_labels = []; // this will store 'inventory_name (Month)'
$quantities = [];

if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        // Loop through each row and store data for the chart
        while ($row = mysqli_fetch_assoc($res)) {
            $inventory_name = $row['inventory_name'];
            $quantity = $row['quantity'];
            $created_at = date("M", strtotime($row['created_at'])); // Format the date to show month (e.g., Jan, Feb)

            // Add to chart data arrays
            $item_labels[] = $inventory_name . " (" . $created_at . ")";
            $quantities[] = $quantity;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <h1 class="title">Inventory Management</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Admin</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Inventory</a></li>
            </ul>

            <div class="gym-table-container">
                <!-- Insert Button -->
                <canvas id="inventoryChart" width="800" height="300"></canvas>

                <a href="add_inventory.php" class="insert-button">Insert Inventory</a>

                <!-- Gym Table -->
                <table class="gym-table">
                    <thead>
                        <tr>
                            <th>no#</th>
                            <th>Image</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    // Fetch data from tbl_gym
    $sql = "SELECT * FROM tbl_inventory WHERE admin_id = '$admin_id'";
    $res = mysqli_query($conn, $sql);

    // Check if there are any records
    if ($res == true) {
        $count = mysqli_num_rows($res);
        $sn = 1; // Serial Number

        if ($count > 0) {
            // Loop through each row and display data
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $inventory_name = $row['inventory_name'];
                $quantity = $row['quantity'];
                $image = $row['inventory_image'];
    ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><img src="inventory_image/<?php echo $image;?>" style="width: 50px; height: auto;" alt=""></td>
                    <td><?php echo $inventory_name; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td class="action-buttons">
    <a href="edit_inventory.php?id=<?php echo $id; ?>" class="edit">Edit</a>
    <a href="delete_inventory.php?id=<?php echo $id; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this inventory?');">Delete</a>
</td>

                </tr>
    <?php
            }
        } else {
            // If no records found
            echo "<tr><td colspan='8'>No About data found</td></tr>";
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


    <script>
    const ctx = document.getElementById('inventoryChart').getContext('2d');
    
    const inventoryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($item_labels); ?>, // X-axis: Item names with month
            datasets: [{
                label: 'Quantity',
                data: <?php echo json_encode($quantities); ?>, // Y-axis: Quantities
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>



    <?php include('../components/admin_footer.php');?>
