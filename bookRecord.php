<?php
session_start();

require_once('helper.php');

if (isset($_SESSION['user_ID'])) {
    $userID = $_SESSION['user_ID'];
} else {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
    $bookingID = isset($_POST['bookingID']) ? key($_POST['bookingID']) : '';
    $danceName = isset($_POST['qty']) ? key($_POST['qty']) : '';
    $dateTime = isset($_POST['dateTime'][$danceName]) ? $_POST['dateTime'][$danceName] : '';
    $quantity = isset($_POST['qty'][$danceName]) ? $_POST['qty'][$danceName] : '';

    if ($danceName && $dateTime && $quantity) {

        $sql = "INSERT INTO bookings (booking_ID, danceName, dateTime, quantity) VALUES (?, ?, ?, ?)";

        $stm = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stm, $sql)) {
            mysqli_stmt_bind_param($stm, "ssss", $bookingID, $danceName, $dateTime, $quantity);

            if (mysqli_stmt_execute($stm)) {

                header("Location: bookRecord.php");
                exit();
            } else {
                echo "<p class='error'>Error: " . mysqli_error($con) . "</p>";
            }
        } else {
            echo "<p class='error'>Error: " . mysqli_stmt_error($stm) . "</p>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel'])) {

    $selectedDances = isset($_POST['cancelDance']) ? $_POST['cancelDance'] : array();
    if (!empty($selectedDances)) {

        require_once('helper.php');

        $sql = "DELETE FROM bookings WHERE danceName = ?";
        $stm = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stm, $sql)) {

            foreach ($selectedDances as $cancelDance) {

                mysqli_stmt_bind_param($stm, "s", $cancelDance);
                mysqli_stmt_execute($stm);
            }

            mysqli_stmt_close($stm);
            mysqli_close($con);

            header("Location: bookRecord.php");
            exit();
        } else {
            $error = "Failed to prepare the SQL statement: " . mysqli_error($con);
        }
    } else {
        $error = "Please select at least one booking to cancel.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Booking Record</title>
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

        /*record*/
        #tema {
            margin-top: 4%;
            margin-bottom: 4%;
            font-size: 30px;
        }

        .container {
            max-width: 700px;
            margin: 100px auto;
            background-color: wheat;
            padding: 20px;
            border-radius: 5px;
        }

        .error {
            border: 2px solid #FBC2C4;
            background-color: #FBE3E4;
            color: #8A1F11;
        }

        input[type="submit"].cancel {
            width: 20%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"].cancel {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            margin-left: 0%;
            font-size: 20px;
        }

        input[type="submit"].cancel:hover {
            opacity: 0.7;
        }

        a.more {
            color: blue;
            font-size: 15px;
        }

        a.more:hover {
            color: red;
        }

        a.contact {
            color: while;
            font-size: 15px;
            text-decoration: none;
            font-size: 20px;
        }

        a.more:hover {
            color: red;
        }

        .contact {
            width: 50%;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            margin-left: 0%;
            padding-top: 2.1%;
            padding-bottom: 2.2%;
            padding-left: 4%;
            padding-right: 4%;
        }

        .contact:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 id="tema">Booking Record</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit='return confirmCancellation()'>
            <?php
            require_once('helper.php');

            $userID = $_SESSION['user_ID'];

            $sql = "SELECT DISTINCT danceName, dateTime, quantity FROM bookings WHERE user_ID = '$userID'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <input type="checkbox" name="cancelDance[]" value="<?php echo $row['danceName']; ?>">
                    <ul>
                        Dance Name: <?php echo $row['danceName']; ?><br>
                        Date and Time: <?php echo $row['dateTime']; ?><br>
                        Quantity: <?php echo $row['quantity']; ?><br>
                    </ul>
            <?php
                }
            } else {
                echo "<p style='font-size: 20px;'>No bookings yet!</p>";
            }
            ?> 
            <br>
            <?php if (!empty($error)) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <input class="cancel" type="submit" name="cancel" value="Cancel">
            <a class="contact" href="contact.php">Comment</a>
            <br>
            <a class="more" href="booking.php">Book More</a>

        </form>
    </div>
</body>

<footer class="text-center">
    <p>Copyright &copy; 2024 All right reserved by Well Dance Society</p>
</footer>

<script>
     function confirmCancellation() {
        return confirm("Are you sure you want to cancel this booking?");
    }
    </script>
</html>