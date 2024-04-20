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
      <a href="#" class="login-button">Login</a>
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


  <!-- ABOUT US SECTION -->
  <!-- START about us -->
  <section class="aboutUs" id="aboutus">
    <div class="container">
      <div class="text-center">
        <h1>Learn more about us!</h1>
        <p>Welcome to Devotion Diaries, your online sanctuary for spiritual reflection and growth. At Devotion Diaries, we believe in the power of personal devotion and the transformative impact it can have on one's life. Our platform is designed to provide a sacred space for individuals to express their thoughts, connect with their spirituality, and cultivate a deeper sense of purpose.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg-4" id="aboutuscard">
        <div class="card border-0">
          <div class="card-body text-center py-5">
            <h4 class="card-title">Our Mission</h4>
            <p class="lead card-subtitle">At the heart of Devotion Diaries is a mission to inspire and empower individuals on their spiritual journey. We aim to create a supportive community where users can freely share their devotion, insights, and experiences, fostering a sense of unity and understanding among diverse spiritual practices.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4" id="aboutuscard">
        <div class="card border-0">
          <div class="card-body text-center py-5">
            <h4 class="card-title">What we are</h4>
            <p class="lead card-subtitle">Devotion Diaries was founded by a group of passionate individuals who share a common vision for creating a positive impact in the world through the exploration of devotion. Our team is composed of seasoned developers, designers, and spiritual enthusiasts, united by the belief that technology can be a powerful tool for fostering spiritual growth.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4" id="aboutuscard">
        <div class="card border-0">
          <div class="card-body text-center py-5">
            <h4 class="card-title">Goals</h4>
            <p class="lead card-subtitle">Our platform inspires spiritual growth and fosters a positive, inclusive community for daily devotion practices. We encourage consistent routines, mindful reflection, and celebrate diverse spiritual practices. Providing accessible resources and a user-friendly experience, our goal is to enable personal progress and a sense of accomplishment on individual spiritual journeys.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END aboutus -->

  <!-- overview -->
  <section class="overview" id="overview">
    <div class="container">
      <div class="text-center">
        <h1>Overview</h1>
        <p>Devotion Diaries offers users a serene digital retreat for spiritual introspection and development. Through its user-friendly interface and diverse features, the platform fosters personal growth by facilitating heartfelt reflections, fostering connections with one's spirituality, and nurturing a deeper sense of purpose in life.</p>
      </div>
      <div class="d-flex justify-content-center">
        <div id="carouselExampleIndicators" class="carousel slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="Images/overview/01.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="Images/overview/02.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="Images/overview/03.png" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </section>




  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>