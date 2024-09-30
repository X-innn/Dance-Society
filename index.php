<?php
session_start();

require_once('helper.php');

$welcome_message = "Welcome!";
$profile_link = '';
$logout_link = '';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

  if (isset($_SESSION['name']) && isset($_SESSION['gender'])) {
    $name = $_SESSION['name'];
    $gender = $_SESSION['gender'];

    if ($gender == 'Male') {
      $welcome_message = "Welcome, Mr. " . $name . " ! ";
    } else {
      $welcome_message = "Welcome, Ms. " . $name . " ! ";
    }
  } 

  $profile_link = '<a href="edit_profile.php">Edit Profile</a>';
  $logout_link = '<a href="logout.php">Logout</a>';
}
?>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Home Page</title>
</head>
<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  body {
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
    background-color:#e6e6fa;
  }

  label.logo {
    color: #ff6347;
    font-size: 40px;
    line-height: 80px;
    padding: 0 100px;
    font-weight: bold;
  }

  .menu-bar {
    background: #00bfff;
    text-align: center;
  }

  .menu-bar ul {
    display: inline-flex;
    list-style: none;
    color: blue;
  }

  .menu-bar ul li {
    width: 120px;
    margin: 15px;
    padding: 15px;
  }

  .event{
    background-color:grey;
  }

  .menu-bar ul li a {
    text-decoration: none;
    color: blue;
  }

  .menu-bar{
    background-color:#00bfff;
  }
  
  .menu-bar ul li a:hover {
    background: rgb(213, 243, 95);
    border-radius: 3px;
  }

  .eventpage{
    background: rgb(213, 243, 95);
    border-radius: 3px;
  }

  .menu-bar .fa {
    margin-right: 8px;
  }

  .sub-menu-1 {
    display: none;
  }
  li:hover{
    background: rgb(213, 243, 95);
    border-radius: 3px;
  }

  .menu-bar ul li:hover .sub-menu-1 {
    display: block;
    position: absolute;
    background: rgb(213, 243, 95);
    margin-top: 15px;
    margin-left: -15px;
  }

  .menu-bar ul li:hover .sub-menu-1 ul {
    display: block;
    margin: 10px;
  }

  .menu-bar ul li:hover .sub-menu-1 ul li {
    width: 150px;
    padding: 10px;
    border-bottom: 1px dotted white;
    background: transparent;
    border-radius: 0;
    text-align: left;
  }

  .menu-bar ul li:hover .sub-menu-1 ul li:last-child {
    border-bottom: none;    
  }

  .menu-bar ul li:hover .sub-menu-1 ul li a:hover {
    color: red;
  }

  .fa-angle-right {
    float: right;
  }

  .sub-menu-2 {
    display: none;
  }

  .hover-me:hover .sub-menu-2 {
    position: absolute;
    display: block;
    margin-top: -40px;
    margin-left: 140px;
    background: rgb(213, 243, 95);
  }

  .footer {
    background: rgb(213, 243, 95);
  }

  .upper {
    display: block;
    border: 5px black solid;
    margin-right: 6px;
    padding: 0.8%;
  }
</style>

<div class="menu-bar">

  <p class="upper" style="float: right; font-size: 27px; margin-top: 0.2%" ><?php echo $welcome_message; ?> <br> <?php echo $profile_link; ?> <?php echo $logout_link; ?></p>
  <label class="logo"><a class="navbar-brand" href="index.php">Well Dance Society</a></label>
  <ul>
    <li class="active"><a href="index.php"><i class="fa fa-home"></i>Home</a>
      <div class="sub-menu-1">
        <ul>
          <li><a href="register.php">Register</a></li>
          <li class="hover-me"><a href="#">Login</a><i class="fa fa-angle-right"></i>
            <div class="sub-menu-2">
              <ul>
                <li><a href="admin_login.php">Admin Login</a></li>
                <li><a href="login.php">User Login</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </li>

    <li><a href="teamMember.php"><i class="fa fa-user"></i>Abouts Us</a>
    </li>
    <li><a href="contact.php"><i class="fa fa-phone"></i>Contact Us</a></li>
    <li><a href="#"><i class="fa fa-diamond"></i>Event</a>
      <div class="sub-menu-1">
        <ul>
          <li><a href="menu.php">Browse Event</a></li>
          <li><a href="booking.php">Book Event</a></li>
        </ul>
      </div>
    </li>
    <li><a href="#"><i class="fa fa-hand-o-up"></i>Book</a>
      <div class="sub-menu-1">
        <ul>
          <li><a href="bookRecord.php">Booked Record</a></li>
        </ul>
      </div>
    </li>
  </ul>
</div>

<div class="container" style="width:100%;">
  <div id="myCarousel" class="carpise slide" data-ride="carousel">

    <!-- Indicators-->


    <!-- Wrapper for slides -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <div style="display:block;margin-left:auto;margin-right:auto; width:80%">
      <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="web photo/dance11.jpg" class="d-block w-100" alt="Chania">
            <div class="carousel-caption d-none d-md-block">

              <h3 style="font-size:45px;">Welcome to <br> Well Dance Society</h3>
              <p style="font-size:20px;">The place to enjoy you body</p>

            </div>
          </div>
          <div class="carousel-item">
            <img src="web photo/dancing.jpg" class="d-block w-100" alt="Chania">
            <div class="carousel-caption d-none d-md-block">
              <h3 style="font-size:45px;">Beautiful Place</h3>
              <p style="font-size:20px;">Get Excellect View</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="web photo/dance8.jpg" class="d-block w-100" alt="Chania">
            <div class="carousel-caption d-none d-md-block">
              <h3 style="font-size:45px;">Talented Instructors</h3>
              <p style="font-size:20px;">Relax you heart</p>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="text-center">
  <p>Copyright &copy; 2024 All right reserved by Well Dance Society</p>
</footer>

</body>

</html>