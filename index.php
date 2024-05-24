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
              <a class="nav-link mx-lg-2" href="#faqs">FAQs</a>
            </li>
          </ul>
        </div>
      </div>
      <a href="loginReg.php" class="login-button">Login</a>
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
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6" aria-label="Slide 7"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7" aria-label="Slide 8"></button>
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
            <div class="carousel-item">
              <img src="Images/overview/04.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="Images/overview/05.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="Images/overview/06.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="Images/overview/07.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="Images/overview/08.png" class="d-block w-100" alt="...">
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


  <section class="prompt" id="prompt">
    <div class="container">
      <div class="row">
        <div class="text">
          <h1>Daily Prompt</h1>
        </div>
        <div class="col-md-6" id="img">
          <img src="Images/bible07.jpg" class="img-fluid fix-image" alt="Image">
        </div>
        <div class="col-md-6">
          <div class="transparent-box">
            <?php
            include 'database_connect.php';
            $sql = "SELECT daily_word_title, daily_word_text FROM daily_word ORDER BY daily_word_id DESC LIMIT 1";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $title = $row["daily_word_title"];
                $body = $row["daily_word_text"];
            ?>
                <div class="text">
                  <h2 class="title"><?php echo $title; ?></h2>
                  <p class="body"><?php echo $body; ?></p>
                </div>
            <?php
              }
            } else {
              echo "No daily word found.";
            }
            $mysqli->close();
            ?>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="faqs" id="faqs">
    <div class="container">
      <div class="row">
        <div class="col-md-12"> <!-- Use full width for the single column -->
          <br>
          <br>
          <div class="text3">
            <h1>Frequently Asked Questions</h1>
          </div>


          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" id="accorbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  How do I create an account on Devotion Diaries?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                <div class="accordion-body" id="accorpar">
                  <p>Creating an account on Devotion Diaries is easy. Simply click on the "Sign Up" button, fill in the required information, and follow the prompts to set up your personal Devotion Diary.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" id="accorbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  Is my information and diary content private?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                <div class="accordion-body" id="accorpar">
                  <p> Yes, we prioritize the privacy and security of our users. Your information and devotion entries are kept confidential and are only visible to you, unless you choose to share them with the community.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" id="accorbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                  Are there any fees associated with using Devotion Diaries?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                <div class="accordion-body" id="accorpar">
                  <p> Devotion Diaries is currently a free platform for users. We may introduce premium features in the future, but basic usage and access to essential features will always remain free.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" id="accorbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                  Are the devotionals provided in DevotionDiaries based on any particular denomination or belief system?
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                <div class="accordion-body" id="accorpar">
                  <p>DevotionDiaries aims to provide a diverse range of devotionals that resonate with Christians from various denominations and belief backgrounds, fostering inclusivity and spiritual growth.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" id="accorbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                  How can I get support if I encounter any issues with DevotionDiaries?
                </button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                <div class="accordion-body" id="accorpar">
                  <p>Users can reach out to the DevotionDiaries support team via email or through the app's built-in support feature for assistance with any technical issues or inquiries.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" id="accorbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                  How often are new devotionals and features added to DevotionDiaries?
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                <div class="accordion-body" id="accorpar">
                  <p>DevotionDiaries regularly updates its content library with new devotionals and features to enrich the user experience and provide fresh insights and inspiration for spiritual growth.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" id="accorbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                  Can I provide feedback or suggest new features for DevotionDiaries?
                </button>
              </h2>
              <div id="collapseSeven" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                <div class="accordion-body" id="accorpar">
                  <p>Yes, DevotionDiaries values user feedback and actively encourages users to share their suggestions and ideas for improving the app. Users can submit feedback through the app or website to contribute to its ongoing development and enhancement.</p>
                </div>
              </div>
            </div>
          </div>






        </div>
      </div>
    </div>
    <br>
    <br>
  </section>


  <!-- Footer -->
  <footer class="text-center text-white fixed-bottom-footer" style="background-color: #6b8a60">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-8 ">
        <p style="color: white; margin-top: 30px">
          Devotion Diaries, your dedicated guide to spiritual growth,
          invites you on a transformative journey of reflection and tranquility.
          Embrace the power of daily devotion with our intuitive platform,
          where each entry becomes a stepping stone to a more enriched and mindful life.
          Start your personalized spiritual adventure today with Devotion Diaries -
          where every word is a step closer to inner peace and self-discovery.
        </p>
      </div>
    </div>

    <div class="text-center mb-3">
      <a href="facebook.com" class="text-white me-4" style="font-size: 24px;">
        <i class="bi bi-facebook"></i>
      </a>
      <a href="twitter.com" class="text-white me-4" style="font-size: 24px;">
        <i class="bi bi-twitter"></i>
      </a>
      <a href="google.com" class="text-white me-4" style="font-size: 24px;">
        <i class="bi bi-google"></i>
      </a>
      <a href="instagram.com" class="text-white me-4" style="font-size: 24px;">
        <i class="bi bi-instagram"></i>
      </a>
      <a href="devotiondiaries@gmail.com" class="text-white me-4" style="font-size: 24px;">
        <i class="bi bi-threads"></i>
      </a>
    </div>
    <!-- Section: Social -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #d9ead3">
      <p style="color: #000">© 2024 Copyright: <a class="text-blue" href="https://DevotionDiaries.com/">DevotionDiaries.com</a></p>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->




  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>