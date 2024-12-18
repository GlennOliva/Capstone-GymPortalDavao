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
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['user_id'])) {
    $admin_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_user WHERE id = $admin_id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $id = $rows['id'];
        $admin_name = !empty($rows['username']) ? $rows['username'] : $rows['email'];
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
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            margin-top: 20px;
            padding: 2.5%;
        }

        .sidebar {
            flex: 1;
            max-width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #ccc;
            text-align: center;
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

        .sidebar .nav-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .nav-menu li {
            margin: 10px 0;
        }

        .sidebar .nav-menu li a {
            text-decoration: none;
            color: black;
            display: block;
            padding: 10px;
            background-color: #f7f9f2;
            border-radius: 5px;
            text-align: center;
        }

        .sidebar .contact-btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px;
            background-color: #6cb7f7;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
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

        .main-content h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .main-content p {
            text-align: justify;
        }

        @media (max-width: 575px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                max-width: 100%;
                margin-bottom: 20px;
                border-right: none;
                border-bottom: 1px solid #ccc;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
                min-width: 100%;
            }
        }


.text-center {
    text-align: center;
}



/* General table styling */
.gym-table-container {
    margin: 30px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow-x: auto; /* Enable horizontal scrolling */
}

.gym-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    min-width: 800px; /* Prevent table from shrinking too much */
}

.gym-table th, .gym-table td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.gym-table th {
    background-color: #00BFFF;
    color: white;
    font-size: 16px;
}

.gym-table td {
    font-size: 14px;
}

.gym-table img {
    width: 50px;
    height: auto;
    border-radius: 5px;
}

/* Responsive styling */
@media (max-width: 768px) {
    .gym-table th, .gym-table td {
        padding: 8px;
        font-size: 12px;
    }

    /* Reduce image size for smaller screens */
    .gym-table img {
        width: 40px;
    }
}
@media (max-width: 480px) {
    /* Keep the thead visible for clarity */
    .gym-table thead {
        display: none;
    }

    /* Display each row as a block on mobile */
    .gym-table tbody, .gym-table tr {
        display: block;
        width: 100%;
    }

    /* Style each table row on mobile to look like cards */
    .gym-table tr {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        background-color: white;
    }

    /* Stack the table data cells in a column format */
    .gym-table td {
        display: block; /* Force the table cells into block format */
        text-align: left; /* Left-align text for mobile readability */
        padding: 8px 30px; /* Adjust padding for mobile */
        border: none; /* Remove borders around each cell */
        position: relative; /* Relative position for pseudo-element */
        font-size: 14px; /* Adjust font size */
    }

    /* Add the label for each cell as a before element */
    .gym-table td:before {
        content: attr(data-label); /* Use data-label to show the th text */
        font-weight: bold;
        color: #00BFFF; /* Blue color for the label */
        text-transform: uppercase;
        margin-right: 10px;
        position: absolute;
        left: 0;
        top: 0;
        padding-top: 8px;
    }

    /* Set padding so the labels align properly */
    .gym-table td {
        padding-left: 0%; /* Offset to ensure data starts after the label */
        display: flex;
    }

    /* Decrease image size for mobile */
    .gym-table img {
        width: 30px;
        height: auto;
        margin-bottom: 10px;
    }
}







    </style>
</head>
<body>
    <!-- Navbar -->
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
                     <li class="dropdown-item" style="color:#000000">Welcome: <?php echo $username;?></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php" >Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Container -->
   
    <?php
    // Get the id and admin_id from the URL
    $id = $_GET['id'];
    $admin_id = $_GET['admin_id'];

    // Prepare the SQL statement
    $sql = "SELECT * FROM tbl_gym WHERE id = ? AND admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are records
    if ($result->num_rows > 0) {
        // Fetch the gym data
        $gym = $result->fetch_assoc();
        $gym_name = $gym['gym_name'];
        $gym_address = $gym['gym_address'];
        $gym_image = $gym['gym_image'];
        $gym_contact = $gym['gym_contact'];
        $id = $gym['id'];
        $admin_id = $gym['admin_id'];
    } else {
        echo "<p>No gym found</p>";
    }
    $stmt->close();

    // Second SQL statement for about information
    if (isset($_GET['id']) && isset($_GET['admin_id'])) {
        $gym_id = $_GET['id'];
        $admin_id = $_GET['admin_id'];

        $sql = "SELECT * FROM tbl_about WHERE gym_id = ? AND admin_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ii", $gym_id, $admin_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are records
            if ($result->num_rows > 0) {
                $gym = $result->fetch_assoc();
                $about_image = $gym['about_image'];
                $about_purpose = $gym['purpose'];
                $about_summary = $gym['summary'];
            } else {
                echo "<p>No gym found</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Failed to prepare SQL statement.</p>";
        }
    } else {
        echo "<p>Invalid parameters.</p>";
    }
    ?>
    <!-- Main Container -->
   <!-- Main Container -->
<section class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="../admin/gym_image/<?php echo $gym_image; ?>" alt="Gym Image" class="img-fluid">
        <h3><?php echo $gym_name; ?></h3>
        <p>Address: <?php echo $gym_address; ?></p>
        <p>Contact: <?php echo $gym_contact;?></p> <!-- Update this if you have a contact field in your database -->
        <p>Payment Scheme: Monthly, Quarterly, Annually</p> <!-- Update this if you have a payment scheme field -->

            <ul class="nav-menu">
                <li><a href="view_gym.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">About</a></li>
                <li><a href="view_class.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">Classes</a></li>
                <li><a href="view_services.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">Services</a></li>
                <li><a href="view_events.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">Events</a></li>
                <li><a href="view_inventory.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">Inventory</a></li>
            </ul>

            <a href="contact.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?> &user_id=<?php echo $user_id;?>" class="contact-btn">Apply Now!</a>
        </div>

     <!-- Main Content -->
<div<!-- Main Content -->
    <div class="main-content">
        <h1 class="text-center">Inventory</h1>
        <div class="gym-table-container">
            <!-- Gym Table -->
            <table class="gym-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                <?php
    // Second SQL statement for class information
    if (isset($_GET['id']) && isset($_GET['admin_id'])) {
        $gym_id = $_GET['id'];
        $admin_id = $_GET['admin_id'];

        $sql = "SELECT * FROM tbl_inventory WHERE gym_id = ? AND admin_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ii", $gym_id, $admin_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are records
            if ($result->num_rows > 0) {
                echo '<div class="row text-center">';
                while ($class = $result->fetch_assoc()) {
                    $inventory_image = $class['inventory_image'];
                    $inventory_name = $class['inventory_name'];
                    $quantity = $class['quantity'];
                    $i = 1;
                    ?>
                    
         
         <tr>
                        <td><?php echo $i++;?></td>
                        <td><img src="../admin/inventory_image/<?php echo $inventory_image;?>" alt="Item 1" width="50"></td>
                        <td><?php echo $inventory_name;?></td>
                        <td><?php echo $quantity;?></td>
                    </tr>
                    
                    <!-- Add more items as needed -->
                </tbody>



                    <?php
                }
                echo '</div>';
            } else {
                echo "<p>No Inventory found</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Failed to prepare SQL statement.</p>";
        }
    } else {
        echo "<p>Invalid parameters.</p>";
    }
    ?>
                    
            </table>
        </div>
    </div>
    

        
    </section>

    <!-- Footer -->
    <footer class="text-center text-white" style="background-color: #F7F9F2; padding: 20px 0;">
        <div class="container" style="color: #000000">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@davaogymportal.com</p>
                    <p>Phone: +63 123 456 789</p>
                </div>
                <div class="col-md-4">
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
</html>
