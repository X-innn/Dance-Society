<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
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

        /* edit */
        .container {
            max-width: 700px;
            margin: 100px auto;
            background-color: wheat;
            padding: 20px;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"].edit_type,
        input[type="password"].edit_type,
        input[type="email"].edit_type,
        input[type="tel"].edit_type,
        input[type="submit"].edit_type {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"].edit_type {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            margin-left: 0%;
            font-size: 20px;
        }

        input[type="submit"].edit_type:hover {
            opacity: 0.7;
        }

        .success {
            border: 2px solid green;
            background-color: green;
            color: #fff;
            margin-bottom: 15px;
        }

        .error {
            border: 2px solid #FBC2C4;
            background-color: #FBE3E4;
            color: #8A1F11;
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
    <title>Edit Profile</title>
    </head>

    <body>

        <div class="container">
            <h2>Edit Profile</h2>

            <?php
            require_once('helper.php');

            $id = $_SESSION['user_ID'];
            $name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $phone = $_SESSION['phone'];
            isset($_POST['birthday']) ? $_POST['birthday'] : '';
            $success_message = "Profile updated successfully!";
            $error_message = "Error updating profile: ";

            $stmt = $con->prepare("SELECT birthday FROM user WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $birthday = $row['birthday'];

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $birthday = $_POST['birthday'];

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error_message = "Invalid email format!";
                } else {
                    $update_sql = "UPDATE user SET ";
                    $params = array();

                    if ($email != $_SESSION['email']) {
                        $update_sql .= "email=?, ";
                        $params[] = $email;
                    }
                    if ($phone != $_SESSION['phone']) {
                        $update_sql .= "phone=?, ";
                        $params[] = $phone;
                    }

                    $update_sql = rtrim($update_sql, ", ");

                    $update_sql .= " WHERE id=?";
                    $params[] = $id;

                    $stmt = $con->prepare($update_sql);

                    $types = str_repeat("s", count($params));
                    $stmt->bind_param($types, ...$params);

                    if ($stmt->execute()) {
                        echo '<div class="success">' . $success_message . '</div>';
                        echo '<p><a href="index.php" style="font-size: 20px;">Home</a></p>';
                        $_SESSION['email'] = $email;
                        $_SESSION['phone'] = $phone;
                    } else {
                        echo '<div class="error">' . $error_message . '</div>';
                    }

                    $stmt->close();
                }
                $con->close();
            }

            ?>

            <form action="edit_profile.php" method="post">
                <div class="form-group">
                    <label for="id">User ID : </label>
                    <input type="text" id="id" name="id" class="edit_type" value="<?php echo htmlspecialchars($id); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="name">Name : </label>
                    <input type="text" id="name" name="name" class="edit_type" value="<?php echo htmlspecialchars($name); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email : </label>
                    <input type="email" id="email" name="email" class="edit_type" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone no : </label>
                    <input type="tel" id="phone" name="phone" class="edit_type" value="<?php echo htmlspecialchars($phone); ?>" required>
                </div>

                <div class="form-group">
                    <label for="birthday">Birthday : </label>
                    <input type="text" id="birthday" name="birthday" class="edit_type" value="<?php echo htmlspecialchars($birthday); ?>" readonly>
                </div>

                <input type="submit" name="edit" class="edit_type" value="Update Profile">
            </form>
        </div>

    </body>

    <footer class="text-center">
        <p>Copyright &copy; 2024 All right reserved by Well Dance Society</p>
    </footer>

</html>