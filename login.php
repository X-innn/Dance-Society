<?php

session_start();

require_once('helper.php');

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ID = $_POST['id'];
  $password = $_POST['password'];
  $name = isset($_SESSION['name']);
  $gender = isset($_SESSION['gender']);

  $sql_select_password = "SELECT Password, Name, Gender FROM user WHERE ID = ?";
  $stmt_select_password = $con->prepare($sql_select_password);
  $stmt_select_password->bind_param("s", $ID);
  $stmt_select_password->execute();
  $result_select_password = $stmt_select_password->get_result();
  $hashed_password_row = $result_select_password->fetch_assoc();

  if ($hashed_password_row && isset($hashed_password_row['Password']) && password_verify($password, $hashed_password_row['Password'])) {

    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['user_ID'] = $ID;
    $_SESSION['name'] = $hashed_password_row['Name'];
    $_SESSION['gender'] = $hashed_password_row['Gender'];
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;

    unset($_SESSION['admin_loggedin']);

    header('Location: index.php');
    exit;
  } else {
    $errors[] = 'Invalid username or password';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    /*login*/

    .container {
      max-width: 700px;
      margin: 100px auto;
      background-color: wheat;
      padding: 20px;
      border-radius: 5px;
    }

    input[type="text"].login_type,
    input[type="password"].login_type,
    input[type="submit"].login_type {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    input[type="submit"].login_type {
      background-color: #4caf50;
      color: white;
      cursor: pointer;
      margin-left: 0%;
      font-size: 20px;
    }

    input[type="submit"].login_type:hover {
      opacity: 0.7;
    }

    a.login {
      color: red;
      font-weight: bold;
      font-size: 20px;
    }

    a.login:hover {
      color: darkorchid;
    }

    .error {
      border: 2px solid #FBC2C4;
      background-color: #FBE3E4;
      color: #8A1F11;
    }

    #tema {
      margin-bottom: 4%;
      font-size: 30px;
    }
  </style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Login Page</title>
</head>

<body>
  <div class="menu-bar">
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
  <div class="container">
    <h2 id="tema">Login</h2>
    <?php
    if (!empty($errors)) {
      echo '<ul class="error">';
      foreach ($errors as $error) {
        echo "<li>" . $error . "</li>";
      }
      echo '</ul>';
    }
    ?>
    <form action="login.php" method="post">
      <label for="id" style="font-size: 20px;">User ID :</label>
      <input class="login_type" type="text" name="id" placeholder="id" required>
      <label for="password" style="font-size: 20px;">Password :</label>
      <input class="login_type" type="password" name="password" placeholder="password" required>
      <input class="login_type" type="submit" name="login" value="Login">
      <p style="font-size: 20px;">Don't have an account?</p> <a class="login" href="register.php">Register</a></p>
    </form>
  </div>
</body>

</html>