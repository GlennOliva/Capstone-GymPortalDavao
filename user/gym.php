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
    <title>Gym Page</title>
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
                        <a class="nav-link" href="#services" style="color:#000000">Services</a>
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
                            <li class="dropdown-item" style="color:#000000">Welcome: User</li>
                            <li><a class="dropdown-item" href="profile.php" style="color:#000000">Profile</a></li>
                            <li><a class="dropdown-item" href="login.php" style="color:#000000">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container my-5">
    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-md-4 mx-auto">
            <div class="input-group">
                <input type="text" id="gymSearch" class="form-control" placeholder="Find Gym" aria-label="Search Gym">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bx bx-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row text-center" id="gymCardsContainer">
        <?php
        // SQL query to get gym data
        $sql = "SELECT * FROM tbl_gym";
        $result = mysqli_query($conn, $sql);

        // Check if there are records in the database
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Store data from each row in variables
                $gym_name = $row['gym_name'];
                $gym_address = $row['gym_address'];
                $gym_image = $row['gym_image']; // Assuming this is the file path of the image
                $gym_id = $row['id'];
                $admin_id = $row['admin_id'];
        ?>
                <!-- Gym Cards -->
                <div class="col-md-3 mb-4 gym-card" data-name="<?php echo strtolower($gym_name); ?>" data-address="<?php echo strtolower($gym_address); ?>">
                    <div class="card h-100">
                        <img src="../admin/gym_image/<?php echo $gym_image; ?>" class="card-img-top" alt="Gym Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $gym_name; ?></h5>
                            <p class="card-text"><?php echo $gym_address; ?></p>
                            <input type="hidden" class="admin-id" value="<?php echo $admin_id; ?>">
                            <a href="view_gym.php?id=<?php echo $gym_id; ?>&admin_id=<?php echo $admin_id; ?>" class="btn btn-primary">Visit!</a>
                        </div>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "<p>No gyms found</p>";
        }
        ?>
    </div>
</section>

<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener for search input
        $('#gymSearch').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase(); // Get the search term
            // Filter gym cards
            $('.gym-card').filter(function() {
                $(this).toggle(
                    $(this).data('name').includes(searchTerm) || 
                    $(this).data('address').includes(searchTerm)
                );
            });
        });
    });
</script>



    <section id="services" class="services py-5">
        <div class="container">
            <h2 class="text-center mb-5">GYM SERVICES</h2>
            <div class="row text-center">
                <!-- First Service Card -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="img/gym-new3.jfif" class="card-img-top" alt="Personal Training">
                        <div class="card-body">
                            <h5 class="card-title">Personal Training</h5>
                            <p class="card-text">Achieve your fitness goals with our certified personal trainers who will create a personalized workout plan just for you.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Second Service Card -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="img/gym-new3.jfif" class="card-img-top" alt="Group Classes">
                        <div class="card-body">
                            <h5 class="card-title">Group Fitness Classes</h5>
                            <p class="card-text">Join our energetic group fitness classes such as Yoga, Zumba, and HIIT to stay motivated and fit with like-minded individuals.</p>
                        </div>
                    </div>
                </div>
    
                <!-- Third Service Card -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="img/gym-new2.jpg" class="card-img-top" alt="Spa and Wellness">
                        <div class="card-body">
                            <h5 class="card-title">Spa & Wellness</h5>
                            <p class="card-text">Relax and rejuvenate after your workout with our in-house spa services, including massages, saunas, and more.</p>
                        </div>
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