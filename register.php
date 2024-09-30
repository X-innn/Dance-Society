<?php
session_start();
require_once('helper.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Register</title>
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
      background-color: #e6e6fa;
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

    .menu-bar ul li a {
      text-decoration: none;
      color: rgba(54, 82, 239, 0.866);
    }

    li:hover {
      background: rgb(213, 243, 95);
      border-radius: 3px;
    }

    .active,
    .menu-bar ul li a:hover {
      background: rgb(213, 243, 95);
      border-radius: 3px;
    }

    .menu-bar .fa {
      margin-right: 8px;
    }

    .sub-menu-1 {
      display: none;
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

    /*register*/

    .container {
      max-width: 700px;
      margin: 100px auto;
      background-color: wheat;
      padding: 20px;
      border-radius: 5px;
    }

    input[type="text"].register_type,
    input[type="password"].register_type,
    input[type="email"].register_type,
    input[type="tel"].register_type,
    input[type="submit"].register_type {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    input[type="radio"].register_type {
      margin-left: 15%;
      height: 20px;
      width: 30px;
    }


    input[type="submit"].register_type {
      background-color: #4caf50;
      color: white;
      cursor: pointer;
      margin-left: 0%;
      font-size: 20px;
    }

    input[type="submit"].register_type:hover {
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

    #tema {
      margin-bottom: 4%;
      font-size: 30px;
    }

    .error {
      border: 2px solid #FBC2C4;
      background-color: #FBE3E4;
      color: #8A1F11;
    }
  </style>
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
    <h2 id="tema">Register</h2>
    <?php

    require_once('helper.php');

    function inputError()
    {
      global $name, $email, $phone, $birthday, $password, $repassword;

      $error = array();

      //name
      if ($name == null) {
        $error['name'] = 'Please enter your <strong>name</strong>.';
      } else if (strlen($name) > 20) {
        $error['name'] = 'Your <strong>name</strong> is too long. It must be less than 20 characters.';
      } else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $name)) {
        $error['name'] = 'There are invalid characters in your <strong>name</strong>.';
      }

      //email
      if ($email == null) {
        $error['email'] = 'Please enter your <strong>email</strong>.';
      } else if (!preg_match('/^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/', $email)) {
        $error['email'] = 'Your <strong>email</strong> in invalid. Format: example@gmail.com';
      }

      //phone no
      if ($phone == null) {
        $error['phone'] = 'Please enter your <strong>phone no</strong>.';
      } else if (!preg_match('/^01\d-\d{7}$/', $phone)) {
        $error['phone'] = 'Your <strong>phone no</strong> is invalid. Format: 999-9999999 and starts with 01.';
      }

      //gender
      if ($phone == null) {
        $error['phone'] = 'Please enter your <strong>phone no</strong>.';
      }

      //birthday
      if ($birthday == null) {
        $error['birthday'] = 'Please enter your <strong>birthday</strong>.';
      } else if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $birthday)) {
        $error['birthday'] = "Invalid date format! Format: dd/mm/yyyy.";
      }

      //password
      if ($password == null) {
        $error['password'] = 'Please enter your <strong>password</strong>.';
      } else if (!preg_match('/^[A-Za-z0-9@,\_\.\-\/\#\&\*]+$/', $password)) {
        $error['password'] = 'There are invalid characters in your <strong>password</strong>.';
      } else if ($password != $repassword) {
        $error['repassword'] = 'Please enter the password same as the 1st password.';
      }

      return $error;
    }

    if (isset($_POST['submit'])) {
      $name = trim($_POST['name']);
      $email = trim($_POST['email']);
      $phone = trim($_POST['phone']);
      $birthday = trim($_POST['birthday']);
      $gender = trim($_POST['gender']);
      $password = trim($_POST['password']);
      $repassword = trim($_POST['re-password']);

      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $error = inputError();

      if (empty($error)) {

        $sql = "SELECT * from user WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
          $error[] = "This Email has already been used!";
        } else {
          if ($password === $repassword) {

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $user_ID = "USR_" . $name;
            $sql = "INSERT INTO user (ID, name, email, gender, password, birthday, phone) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stm = mysqli_stmt_init($con);
            if (mysqli_stmt_prepare($stm, $sql)) {
              mysqli_stmt_bind_param($stm, 'sssssss', $user_ID, $name, $email, $gender, $passwordHash, $birthday, $phone);
              mysqli_stmt_execute($stm);

              printf(
                '
                <h1>Register Successful!</h1>
                <p style="font-size: 20px;">
                    Welcome <strong>%s. %s</strong>
                    <p style="font-size: 20px;">User ID <strong>%s</strong></p>
                </p>
                <p><a href="login.php" style="font-size: 20px;">Login</a></p>',
                $gender == 'Male' ? 'Mr' : 'Ms',
                $name,
                $user_ID
              );
            }
          }
        }
      }

      if (!empty($error)) {
        printf(
          '
          <h1 style="font-size: 20px">OOPS... There are input errors</h1>
          <ul style="color: red" class="error"><li>%s</li></ul>
          <p><a href="javascript:history.back()">Back</a></p>',
          implode('</li><li>', $error)
        );
      }
    }


    ?>
    <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <label for="name" style="font-size: 20px;">Name :</label>
      <input class="register_type" type="text" name="name" placeholder="name" required>
      <label for="email" style="font-size: 20px;">Email :</label>
      <input class="register_type" type="email" name="email" placeholder="email" required>
      <label for="phone" style="font-size: 20px;">Phone no :</label>
      <input class="register_type" type="tel" name="phone" placeholder="phone no" required>
      <label for="gender" style="font-size: 20px;">Gender :</label>
      <label for="Male" style="font-size: 20px;">Male</label>
      <input class="register_type" type="radio" name="gender" value="Male">
      <label for="Female" style="font-size: 20px;">Female</label>
      <input class="register_type" type="radio" name="gender" value="Female">
      <br><br>
      <label for="birthday" style="font-size: 20px;">Birthday :</label>
      <input class="register_type" type="text" name="birthday" placeholder="dd/mm/yyyy">
      <label for="password" style="font-size: 20px;">Password :</label>
      <input class="register_type" type="password" name="password" placeholder="password" required>
      <label for="password" style="font-size: 20px;">Re-password :</label>
      <input class="register_type" type="password" name="re-password" placeholder="re-password" required>
      <input class="register_type" type="submit" name="submit" value="Register">
      <p style="font-size: 20px;">Already have an account?</p> <a class="login" href="login.php">Login</a></p>
    </form>
  </div>
</body>


</html>