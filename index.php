<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="home.css" rel="stylesheet">
  <link href="loginReg.php">
</head>
<body>


<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand me-auto" href="#"><img src="icons/logo.png" alt="Logo" width="50" height="50">DevotionDiaries</a>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">DevotionDiaries</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#aboutus">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#overview">Overview</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#prompt">Prompt</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#testimonials">Testimonials</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#Resources">Resources</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#faqs">FAQs</a>
          </li>
        </ul>
      </div>
    </div>
    <a href="#" class="login-button" >Login</a>
    <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>
    
<!--START home Section-->
<section class="home" id="home">
    <div class="container">
      <div class="row min-vh-100 align-items-center justify-content-center">
        <div class="content">
          <h3 class="home1">Welcome to Devotion Diaries </h3>
          <h3 class="home2">Your Daily Companion for Spiritual Growth and Reflection</h3>
          <p class="home3">Discover Tranquility in Every Entry: Commence Your Online Devotion Diary</p>
          <a class="sign-in-button" href="loginReg.php#register">Start Now</a>
        </div>
      </div>
    </div>
  </section>


  <!-- redirect the user to login page -->
  <script>
    function login() {
      window.location.href = "loginReg.php";
    }
  </script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>