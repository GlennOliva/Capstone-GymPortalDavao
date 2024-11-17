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
                window.location = "login.php";
            });
        };
    </script>';
    exit;
}

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
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/landing-page.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="#about" style="color:#000000">About</a>
                    </li>
               
                </ul>
            </div>
            <!-- Dropdown (aligned to the right) -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-user" style="color:#000000"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item" style="color:#000000">Welcome: <?php echo $username;?></li>
                            <li><a class="dropdown-item" href="profile.php" style="color:#000000">Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php" style="color:#000000">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container my-5">
    <!-- Gym Cards Carousel -->
    <div id="gymCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php
            // SQL query to get gym data
            $sql = "SELECT * FROM tbl_gym";
            $result = mysqli_query($conn, $sql);

            // Initialize counter to track carousel items
            $item_count = 0;

            // Check if there are records in the database
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Store data from each row in variables
                    $gym_name = $row['gym_name'];
                    $gym_address = $row['gym_address'];
                    $gym_image = $row['gym_image']; // Assuming this is the file path of the image
                    $gym_id = $row['id'];
                    $admins_id = $row['admin_id'];
                    // Open a new carousel item every 4 cards
                    if ($item_count % 4 == 0) {
                        if ($item_count != 0) {
                            echo '</div></div>'; // Close previous .carousel-item and .row divs
                        }
                        echo '<div class="carousel-item ' . ($item_count == 0 ? 'active' : '') . '">';
                        echo '<div class="row">';
                    }
            ?>
                    <div class="col-12 col-md-3">
                        <div class="card" style="height: 70vh;">
                            <img src="../admin/gym_image/<?php echo $gym_image; ?>" class="card-img-top" alt="Gym Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $gym_name; ?></h5>
                                <p class="card-text"><?php echo $gym_address; ?></p>
                                <a href="view_gym.php?id=<?php echo $gym_id; ?>&admin_id=<?php echo $admins_id; ?>" class="btn btn-primary">Visit!</a>
                            </div>
                        </div>
                    </div>
            <?php
                    $item_count++;
                }
                echo '</div></div>'; // Close the last .carousel-item and .row divs
            } else {
                echo "<p>No gyms found</p>";
            }
            ?>
        </div>

        <!-- Carousel controls -->
        <a class="carousel-control-prev" href="#gymCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#gymCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</section>

    
    

    <section id="about" class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <img src="img/gym-new2.jpg" class="img-fluid" alt="About Davao Gym Portal">
                </div>
                <div class="col-md-5 content">
                    <div>
                        <h2>About Davao Gym Portal</h2>
                        <p>Davao Gym Portal is your ultimate guide to finding the best gyms in Davao City. Whether you're a fitness enthusiast or a beginner, our platform offers a comprehensive list of gyms that cater to all your fitness needs. We aim to connect gym-goers with top-rated fitness centers in the city, providing all the necessary information to help you choose the right gym for your fitness journey.</p>
                        <p>Our mission is to promote a healthier lifestyle by making it easy for you to find the perfect gym that suits your preferences and goals. From state-of-the-art facilities to personalized training programs, Davao Gym Portal is here to help you achieve your fitness goals.</p>
                    </div>
                </div>
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