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


  <!-- START about us -->
  <section class="aboutus" id="aboutus">

    <div class="container">
      <div class="text-center">
        <br>
        <h1>Learn more about us!</h1>
        <p>Welcome to Devotion Diaries, your online sanctuary for spiritual reflection and growth. At Devotion Diaries, we believe in the power of personal devotion and the transformative impact it can have on one's life. Our platform is designed to provide a sacred space for individuals to express their thoughts, connect with their spirituality, and cultivate a deeper sense of purpose.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg-4">
        <div class="card border-0">
          <div class="card-body text-center py-5">
            <h4 class="card-title">Our Mission</h4>
            <p class="lead card-subtitle">At the heart of Devotion Diaries is a mission to inspire and empower individuals on their spiritual journey. We aim to create a supportive community where users can freely share their devotion, insights, and experiences, fostering a sense of unity and understanding among diverse spiritual practices.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4">
        <div class="card border-0">
          <div class="card-body text-center py-5">
            <h4 class="card-title">What we are</h4>
            <p class="lead card-subtitle">Devotion Diaries was founded by a group of passionate individuals who share a common vision for creating a positive impact in the world through the exploration of devotion. Our team is composed of seasoned developers, designers, and spiritual enthusiasts, united by the belief that technology can be a powerful tool for fostering spiritual growth.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4">
        <div class="card border-0">
          <div class="card-body text-center py-5">
            <h4 class="card-title">Goals</h4>
            <p class="lead card-subtitle">Our platform inspires spiritual growth and fosters a positive, inclusive community for daily devotion practices. We encourage consistent routines, mindful reflection, and celebrate diverse spiritual practices. Providing accessible resources and a user-friendly experience, our goal is to enable personal progress and a sense of accomplishment on individual spiritual journeys.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


<!-- START overview -->
<section class="overView" id="overview">
    <div id="overview" class="overview">
      <div class="slidershow-container">
        <div class="slidershow middle">
          <div class="slides">
            <input type="radio" name="r" id="r1" checked>
            <input type="radio" name="r" id="r2">
            <input type="radio" name="r" id="r3">
            <input type="radio" name="r" id="r4">
            <input type="radio" name="r" id="r5">
            <div class="slide s1">
              <img src="Images/dashboard.png" alt="">
            </div>
            <div class="slide">
              <img src="Images/profile.png" alt="">
            </div>
            <div class="slide">
              <img src="Images/dailyPrompt.png" alt="">
            </div>
            <div class="slide">
              <img src="Images/newEntry.png" alt="">
            </div>
            <div class="slide">
              <img src="Images/view.png" alt="">
            </div>
          </div>

          <div class="navigationBTN">
            <label for="r1" class="bar"></label>
            <label for="r2" class="bar"></label>
            <label for="r3" class="bar"></label>
            <label for="r4" class="bar"></label>
            <label for="r5" class="bar"></label>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>