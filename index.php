<?php
include './config/config.php';
session_start();

if (isset($_SESSION['status'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var signupModal = new bootstrap.Modal(document.getElementById('signup'));
            signupModal.show();
        });
    </script>";
}
if (isset($_SESSION['sts'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var loginModal = new bootstrap.Modal(document.getElementById('login'));
            loginModal.show();
        });
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
    <link rel="stylesheet" href="./style/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./style/homepage.css">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>Homepage — KCEAP</title>
    
</head>
    <style>
     .hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/yamiro.jpg') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    background-attachment: fixed;
    position: relative;
    padding: 20px;
}

    </style>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="img/logo.png" alt="KCEAP Logo" width="40" height="auto" class="me-2">
                <strong>KCEAP SIMS</strong>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="hero-content">
                <img src="img/logo.png" alt="KCEAP Logo" class="hero-logo">
                <h1 class="hero-title">KCEAP Scholarship Information and Management System</h1>
                <p class="hero-subtitle">
                    Welcome to the KCEAP Scholarship Information And Management System (SIMS) — your one-stop platform to learn about, 
                    apply for, and manage your scholarship. Designed for a smooth and transparent experience for both applicants and administrators.
                </p>
                <div class="d-flex flex-wrap justify-content-center">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login" href="#">Login</a>
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup" href="#">Register</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about-section">
        <div class="container">
            <h2 class="text-center section-title">About Us</h2>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="img/logo.png" alt="About KCEAP" class="img-fluid about-img">
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <p class="lead">
                            The KCEAP Scholarship Information and Management System streamlines the application, review, and disbursement process, 
                            ensuring efficient and transparent scholarship administration for eligible students.
                        </p>
                        <div class="text-center mt-4">
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#learn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Modal -->
    <div class="modal fade" id="learn" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="aboutModalLabel">About KCEAP Scholarship</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="about-kceap">
                        <h4 class="fw-bold mt-3">Qualifications</h4>
                        <p>To be eligible for the KCEAP Scholarship, applicants must meet the following criteria:</p>
                        <ol class="mb-4">
                            <li>A Filipino citizen and bonafide resident of Kabankalan City</li>
                            <li>With good moral character and without any derogatory record: <br>
                                A. For SHS Category: A grade 10 or ALS (HIGH SCHOOL) graduate with at least eighty (GWA)
                                and no failing grade in any subject in his/her last school year in highschool. <br>
                                B. For COLLEGE Category: A K-12 or ALS (Senior High School)graduate with at least eighty
                                percent (80%) GWA and with no failing grade in any subject in his/her semester in High
                                School. <br>
                            </li>
                            <li>With parents or guardian having a combined gross monthly income of not more than
                                Thirty-Thousand pesos(P30,000.00)</li>
                            <li>Presently not enjoying any other government-funded scholarship grant</li>
                        </ol>
                        
                        <h4 class="fw-bold">Documentary Requirements</h4>
                        <ul class="mb-4">
                            <li>Copy of COMELEC or COMELEC Certification</li>
                            <li>Duly registered birth certificate</li>
                            <li>Copy of id pictures taken within six months</li>
                            <li>Family monthly gross income of thirty thousand pesos(30,000) or below.</li>
                            <li>Latest report card</li>
                            <li>Certificate of good moral</li>
                        </ul>
                        
                        <h4 class="fw-bold">Termination of grant & appeal process</h4>
                        <p>The scholarships office shall determine if a scholar has violated the condition of the
                            scholarship agreement or any of the grounds for termination, as provided below upon approval
                            of the board.</p>
                            
                        <h4 class="fw-bold">Grounds for termination</h4>
                        <ol class="mb-4">
                            <li>Non-compliance of the scholarship requirements, terms and condition of the program, or
                                policies of the office after due notice;</li>
                            <li>Academic deficiencies;</li>
                            <li>Expulsion or dismissal from the academic institution;</li>
                            <li>Forging or falsification of official grades or records;</li>
                            <li>Giving false information necessary to the selection process during interview;</li>
                            <li>Abandonment of scholarship and/or non-communication with the KCEAP office despite efforts
                                exerted by said office to communicate;</li>
                            <li>Engage or involve in illegal activities;</li>
                            <li>Conviction of an offense under the revised penal code or special law;</li>
                            <li>Other causes as may be determined by the board.</li>
                        </ol>
                        
                        <h4 class="fw-bold">Appeal process</h4>
                        <ol>
                            <li>The scholarship may appeal the termination of the scholarship grants within ten (10)
                                calendar days from notice of termination. In case of minors, the parent may appeal on
                                the scholar's behalf.</li>
                            <li>The appellant may appeal the termination of the scholarship grant in writing, stating
                                the name of the student, date of termination, reason or ground for the termination, and
                                the reason why the appellant believes that termination was wrongful or unfair. The
                                letter shall be addressed to scholarship board and shall be submitted through the
                                scholarship office.</li>
                        </ol>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="section features-section">
        <div class="container">
            <h2 class="text-center section-title">Key Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <img src="img/process.png" alt="Easy Application" class="feature-icon">
                        <h3 class="feature-title">Easy Application Process</h3>
                        <p>Streamlined application process for students with step-by-step guidance and real-time status updates.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <img src="img/upload.png" alt="Secure Upload" class="feature-icon">
                        <h3 class="feature-title">Secure Document Upload</h3>
                        <p>Upload and manage your supporting documents quickly and safely with our encrypted file storage.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <img src="img/data-management.png" alt="Data Management" class="feature-icon">
                        <h3 class="feature-title">Secure Data Management</h3>
                        <p>Your data is protected with industry-standard security measures and regular backups.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class='bx bx-map me-2'></i> Old City Hall, Kabankalan City, Philippines</li>
                        <li class="mb-2"><i class='bx bx-envelope me-2'></i> example@example.com</li>
                        <li class="mb-2"><i class='bx bx-phone me-2'></i> 0964 952 1388</li>
                        <li><i class='bx bxl-facebook me-2'></i> 
                            <a href="https://www.facebook.com/share/1HgsUuBAvC/" target="_blank" class="text-white">Kceap kabankalan</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="text-white">Home</a></li>
                        <li class="mb-2"><a href="#about" class="text-white">About</a></li>
                        <li class="mb-2"><a href="#features" class="text-white">Features</a></li>
                        <li><a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#login">Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h5>About KCEAP</h5>
                    <p>The Kabankalan City Educational Assistance Program provides scholarship opportunities to qualified students of Kabankalan City.</p>
                </div>
            </div>
            <div class="footer-bottom text-center pt-4">
                <hr class="my-4 bg-light opacity-10">
                <p class="mb-0">&copy; 2025 KCEAP Scholarship Information and Management System. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="loginModalLabel">Login to Your Account</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($_SESSION['sts'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['sts']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['sts']); ?>
                    <?php endif; ?>

                    <form action="login.php" method="POST" class="loginForm">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">Login</button>
                        <div class="text-center mt-3">
                            <p>Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signup" data-bs-dismiss="modal">Register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="signup" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="signupModalLabel">Create New Account</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($_SESSION['status'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['status']); ?>
                    <?php endif; ?>

                    <form action="signup.php" method="POST" enctype="multipart/form-data" class="signupform">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name" placeholder="e.g. BELANO MATT ANDREI G." required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled selected>Select your category</option>
                                <option value="COLLEGE">COLLEGE</option>
                                <option value="HIGHSCHOOL">HIGHSCHOOL</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="signupEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="signupEmail" name="email" placeholder="e.g. matt@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="signupPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="signupPassword" name="password" placeholder="Create a password" required>
                            <small class="text-danger password-message" style="display: none;">Passwords do not match!</small>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="cpassword" placeholder="Confirm your password" required>
                            <small class="text-danger password-message" style="display: none;">Passwords do not match!</small>
                        </div>
                        <div class="mb-3">
                            <label for="profilePicture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profilePicture" name="profile" accept="image/png, image/jpeg, image/jpg" required>
                            <small class="text-muted">Accepted formats: JPG, JPEG, PNG</small>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">Register</button>
                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#login" data-bs-dismiss="modal">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="./script/bootstrap.bundle.min.js"></script>
    <script src="./script/indexFunction.js"></script>
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('bg-dark');
                navbar.style.boxShadow = '0 2px 15px rgba(0, 0, 0, 0.1)';
            } else {
                navbar.classList.remove('bg-dark');
                navbar.style.boxShadow = 'none';
            }
        });
    </script>
     <script>
        // Password match validation
        document.getElementById('signupPassword').addEventListener('input', validatePassword);
        document.getElementById('confirmPassword').addEventListener('input', validatePassword);

        function validatePassword() {
            const password = document.getElementById('signupPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const messages = document.querySelectorAll('.password-message');
            
            if (password || confirmPassword) {
                messages.forEach(msg => {
                    msg.style.display = password === confirmPassword ? 'none' : 'block';
                });
            } else {
                messages.forEach(msg => msg.style.display = 'none');
            }
        }
    </script>
</body>
</html>