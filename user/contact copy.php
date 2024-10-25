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
    <!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Include SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
            max-width: 270px;
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

/* Styling for the contact form */
.contact-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
  
    border-radius: 8px;
   
}

.contact-form .form-group {
    margin-bottom: 15px;
}

.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form textarea {
    border: 1px solid #bbb;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    font-size: 16px;
    box-shadow: none;
}

.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.contact-form .submit-btn {
    background-color: #5cb3fd;
    border-color: #5cb3fd;
    font-size: 16px;
    padding: 10px 0;
    width: 100%;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.contact-form .submit-btn:hover {
    background-color: #007bff;
    border-color: #007bff;
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
                            <li class="dropdown-item">Welcome: User</li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="login.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


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
if (isset($_GET['id']) && isset($_GET['admin_id']) && isset($_GET['user_id'])) {
    $gym_id = $_GET['id'];
    $admin_id = $_GET['admin_id'];
    $user_id = $_GET['user_id'];

    // Use a placeholder for the user_id
    $sql = "SELECT * FROM tbl_user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Correctly bind the user_id
        $stmt->bind_param("i", $user_id); // 'i' indicates that user_id is an integer
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are records
        if ($result->num_rows > 0) {
            $gym = $result->fetch_assoc();
            $first_name = $gym['first_name'];
            $last_name = $gym['last_name'];
            $email = $gym['email'];
            $contact = $gym['contact_no'];
            $full_name = $first_name . ' ' . $last_name; // Added space between first and last name
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
    <section class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="../admin/gym_image/<?php echo $gym_image;?>" alt="Gym Image">
            <h3><?php echo $gym_name;?></h3>
            <p>Address: <?php echo $gym_address;?></p>
            <p>Contact: <?php echo $gym_contact;?></p>
            <p>Payment Scheme: Monthly, Quarterly, Annually</p>

            <ul class="nav-menu">
                <li><a href="view_gym.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">About</a></li>
                <li><a href="view_class.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">Classes</a></li>
                <li><a href="view_services.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">Services</a></li>
                <li><a href="view_events.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">Events</a></li>
                <li><a href="view_inventory.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>">Inventory</a></li>
            </ul>

            <a href="contact.php?id=<?php echo $id; ?>&admin_id=<?php echo $admin_id; ?>&user_id=<?php echo $user_id;?>" class="contact-btn">Apply Now!</a>
        </div>

     <!-- Main Content -->
     <div class="main-content">
        <h1 class="text-center">Contact</h1>
        <form  method="POST" class="contact-form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $full_name;?>" readonly required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email;?>" readonly required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" value="<?php echo $contact;?>" readonly required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message" required></textarea>
            </div>
            <button type="submit" name="send_message" class="btn btn-primary submit-btn">Submit</button>
        </form>
    </div>


    <?php
if (isset($_POST['send_message'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];

    // Prepare SQL statement to prevent SQL injection
    $sql = "INSERT INTO tbl_contact (full_name, email, contact, message, admin_id, gym_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssssiii", $name, $email, $contact, $message, $admin_id, $gym_id, $user_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Success message
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Message Sent!",
                        text: "Your message has been sent successfully.",
                        confirmButtonText: "OK"
                    });
                  </script>';
        } else {
            // Error message
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong! Please try again.",
                        confirmButtonText: "OK"
                    });
                  </script>';
        }
        $stmt->close();
    } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to prepare the SQL statement.",
                    confirmButtonText: "OK"
                });
              </script>';
    }
}
?>

    

        
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
