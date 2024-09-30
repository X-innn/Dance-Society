<?php
require_once('helper.php');
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Comment</title>
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

        /* contact */

        .container {
            max-width: 700px;
            margin: 100px auto;
            background-color: wheat;
            padding: 20px;
            border-radius: 5px;
        }

        h1 {
            margin-top: 20px;
            margin-bottom: 40px;
        }

        label {
            color: #333;
        }

        .btn-send {
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 20px;
        }

        .error {
            border: 2px solid #FBC2C4;
            background-color: #FBE3E4;
            color: #8A1F11;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-lg-offset-2">
                <h1>Leave A Comment</h1>


                <form id="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" role="form">

                    <?php

                    function inputError()
                    {
                        global $name, $surname, $email, $phone, $message;

                        $error = array();

                        //name
                        if ($name == null) {
                            $error['name'] = 'Please enter your <strong>name</strong>.';
                        }

                        //surname
                        if ($surname == null) {
                            $error['surname'] = 'Please enter your <strong>surname</strong>.';
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

                            //message
                            if ($message == null) {
                                $error['message'] = 'Please enter your <strong>phone no</strong>.';
                            }

                            return $error;
                        }
                    }
                    if (isset($_POST['ok'])) {
                        $name = trim($_POST['name']);
                        $surname = trim($_POST['surname']);
                        $email = trim($_POST['email']);
                        $phone = trim($_POST['phone']);
                        $message = trim($_POST['message']);

                        $error = inputError();

                        if (empty($error)) {

                            $sql = "INSERT INTO contact (name, surname, email, phone, message) VALUES (?, ?, ?, ?, ?)";
                            $stm = mysqli_stmt_init($con);

                            if (mysqli_stmt_prepare($stm, $sql)) {
                                mysqli_stmt_bind_param($stm, 'sssss', $name, $surname, $email, $phone, $message);
                                mysqli_stmt_execute($stm);

                                printf(
                                '
                                <h4>Thank you! Your message has been sent successfully.</h4>
                                <p><a href="index.php" style="font-size: 20px;">Home</a></p>
                                ',
                                );
                            } else {
                                echo '<div class="error">Oops. There are input errors. Please check and try again.</div>';
                            }
                        } else {
                            echo '
                                <div class="error">
                                Opps. Database issue. Record not updated.
                                </div>
                                ';
                        }
                    }

                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Firstname *</label>
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_lastname">Lastname *</label>
                                <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_email">Email *</label>
                                <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_phone">Phone</label>
                                <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone" required="required" data-error="Phone is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form_message">Message *</label>
                                <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                            <br>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="ok" class="btn btn-success btn-send" value="Send message">
                        </div>
                    </div>

            </div>

            </form>


        </div>

    </div> <!-- /.row-->

    </div> <!-- /.container-->

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

<footer class="text-center">
    <p>Copyright &copy; 2024 All right reserved by Well Dance Society</p>
</footer>

</html>