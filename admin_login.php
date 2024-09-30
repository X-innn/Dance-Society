<?php
session_start();

// Check if user is already logged in, redirect to index.php if logged in
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    header("Location: admin.php");
    exit;
}

// Define admin credentials
$admin_email = "admin@gmail.com";
$admin_password = "123";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the entered credentials match the admin credentials
    if ($email === $admin_email && $password === $admin_password) {
        // If matched, set session variable and redirect to index.php
        $_SESSION['admin_loggedin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        // If not matched, set error message
        $error = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if(isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="input-container">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>

<!-- CSS styles -->
<style>
    body {
        background: linear-gradient(120deg, #2980b9, #8e44ad);
        color: #fff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        width: 320px;
        padding: 30px 25px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .input-container {
        margin-bottom: 20px;
    }

    input[type="email"],
    input[type="password"],
    button {
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 16px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .error {
        color: red;
        margin-bottom: 15px;
    }

    a {
        color: #4CAF50;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>