<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Gym</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showPrivacyModal()">Own Gym</a>
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
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="register.php">Register</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


     <!-- Privacy Agreement Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">Privacy Agreement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <!-- Privacy content -->
                <p><strong>Personal Data Collection:</strong> As part of our registration process, we collect essential personal information to ensure secure access and personalized service. This includes but is not limited to your name, contact information, and gym usage preferences. We handle all data in compliance with relevant data protection laws, ensuring that your information remains safe and private.</p>
                
                <p><strong>Usage of Collected Data:</strong> The data we gather is solely for improving your experience and personalizing services within the Davao Gym Portal. This may include sending updates about gym activities, promotions, or any changes in gym policies. We do not share your information with third parties without your explicit consent.</p>
                
                <p><strong>Security Measures:</strong> We take all necessary precautions to secure your data. Our system is equipped with advanced encryption to prevent unauthorized access, ensuring that only authorized personnel can handle your personal information. Your data will be stored securely and will only be used for the intended purpose as per our agreement.</p>
                
                <p><strong>User Responsibilities:</strong> As a user, you agree to follow the gym rules, including respecting equipment, maintaining hygiene standards, and abiding by gym hours. Violations may lead to suspension or termination of access to our facilities to ensure a safe and enjoyable environment for all members.</p>
                
                <p><strong>Right to Withdraw Consent:</strong> You may withdraw consent for the use of your data at any time by contacting our support team. Doing so may limit certain features of the Davao Gym Portal, but we will respect your privacy choices and discontinue data processing accordingly.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="agreeToPrivacy()">Agree</button>
            </div>
        </div>
    </div>
</div>


    <section id="hero" class="position-relative">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- Background color overlay -->
                    <div class="overlay"></div>
                    <img src="img/gym-new.jpg" class="d-block w-100" style="height: 600px;" alt="...">
                </div>
                <div class="carousel-item">
                    <div class="overlay"></div>
                    <img src="img/gym-new2.jpg" class="d-block w-100" style="height: 600px;" alt="...">
                </div>
                <div class="carousel-item">
                    <div class="overlay"></div>
                    <img src="img/gym-new3.jfif" class="d-block w-100" style="height: 600px;" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
    
            <!-- Removed d-none d-md-block classes -->
            <div class="carousel-caption text-start" style="margin-bottom: 10%;">
                <h1 class="display-4" style="color:white;">"Your Fitness Journey Starts Here"</h1>
                <p class="lead" style="color:white;">Get in shape, stay in shape.</p>
                <a href="home.php" class="btn btn-warning btn-lg">FIND GYM</a>
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
    <script>
        function showPrivacyModal() {
            // Show the privacy modal when "Own Gym" is clicked
            var privacyModal = new bootstrap.Modal(document.getElementById('privacyModal'));
            privacyModal.show();
        }

        function agreeToPrivacy() {
            // Close the modal and redirect to register.php when "Agree" is clicked
            var privacyModal = bootstrap.Modal.getInstance(document.getElementById('privacyModal'));
            privacyModal.hide();
            window.location.href = 'register.php';
        }
    </script>
</html>