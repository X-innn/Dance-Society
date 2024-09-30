<?php
session_start();
require_once('helper.php');

function generateBookingID($danceName)
{
    $uniqueID = uniqid();
    $bookingID = "BK_" . $uniqueID;
    return $bookingID;
}

if (isset($_SESSION['user_ID'])) {
    $userID = $_SESSION['user_ID'];
} else {
    header("Location: login.php"); 
    exit();
}
 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {

    $userName = isset($_POST['name']) ? $_POST['name'] : '';
    $userEmail = isset($_POST['email']) ? $_POST['email'] : '';
    $danceName = isset($_POST['dance']) ? $_POST['dance'] : '';
    $dateTime = isset($_POST['dateTime']) ? $_POST['dateTime'] : '';
    $quantity = isset($_POST['qty']) ? $_POST['qty'] : '';

    if ($userName && $userEmail && $danceName && $dateTime && $quantity) {

        $bookingID = generateBookingID($danceName);

        $sql = "INSERT INTO bookings (booking_ID, user_ID, user_Name, user_Email, danceName, dateTime, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssi", $bookingID, $userID, $userName, $userEmail, $danceName, $dateTime, $quantity);

            if (mysqli_stmt_execute($stmt)) {

                header("Location: bookRecord.php");
                exit();
            } else {
                echo "<p class='error'>Error: " . mysqli_error($con) . "</p>";
            }
        } else {
            echo "<p class='error'>Error: " . mysqli_stmt_error($stmt) . "</p>";
        }
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
    <title>Event</title>
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

    /* booking */

    .container {
        max-width: 700px;
        margin: 100px auto;
        background-color: wheat;
        padding: 20px;
        border-radius: 5px;
    }

    #dances {
        border: 1.5px black solid;
        background-color: white;
        padding-bottom: 3%;
        padding-right: 5%;
        padding-right: 5%;
        margin-left: auto;
        margin-right: auto;
        max-width: 50%;
        position: relative;
        overflow-x: auto;
        overflow-y: auto;
    }

    img#dance {
        margin-left: 3%;
    }

    input[type="text"].booking_type,
    input[type="email"].booking_type,
    input[type="datetime-local"].booking_type,
    input[type="number"].booking_type,
    select.booking_type {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="submit"].booking_type {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
        margin-left: 85%;
        margin-top: 5%;
        padding: 10px;
    }

    input[type="submit"].booking_type:hover {
        opacity: 0.7;
    }

    .name {
        margin-top: 4%;
        margin-bottom: 4%;
        margin-left: 3%;
        font: 1.5em sans-serif;
    }

    .des {
        margin-top: 3%;
        margin-left: 3%;
        padding: 0%;
        text-align: left;
        font: 1.5em sans-serif;
    }

    #tema {
        margin-top: 4%;
        margin-bottom: 4%;
        font-size: 30px;
    }

    .error {
        border: 2px solid #FBC2C4;
        background-color: #FBE3E4;
        color: #8A1F11;
    }
</style>

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
        <h2 id="tema">Booking Event</h2>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="name" style="font-size: 20px;">Name :</label>
            <input class="booking_type" type="text" name="name" placeholder="name" required>
            <label for="email" style="font-size: 20px;">Email :</label>
            <input class="booking_type" type="email" name="email" placeholder="email" required>
            <label for="event" style="font-size: 20px;">Event Name :</label>
            <select name="dance" class="booking_type" required>
                <option value="Ballet">Ballet</option>
                <option value="Belly">Belly</option>
                <option value="Irish">Irish</option>
                <option value="Kpop">Kpop</option>
                <option value="Swing">Swing</option>
                <option value="Hip Hop">Hip Hop</option>

                <?php

                $sql = "SELECT * FROM events";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                    }
                } else {
                    echo "<option value=''>No new events available</option>";
                }
                ?>
            </select>

            <label for="datetime" style="font-size: 20px;">Date & Time :</label>
            <input class="booking_type" type="datetime-local" id="dateTime" name="dateTime">
            <label for="quantity" style="font-size: 20px;">Quantity :</label>
            <input class="booking_type" type="number" id="qty" name="qty" value="" min="0" max="100">
            <div>
                <input class="booking_type" type="submit" name="book" value="Book Now">
            </div>
        </form>
    </div>
</body>

<footer class="text-center">
    <p>Copyright &copy; 2024 All right reserved by Well Dance Society</p>
</footer>

</html>