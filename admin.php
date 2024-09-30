<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <style>
    /* CSS code here */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
    }
    header, footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px 0;
    }
    nav {
      background-color: #333;
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }
    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }
    nav ul li {
      display: inline-block;
      margin-right: 20px;
    }
    nav ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 18px;
      font-weight: bold;
      transition: all 0.3s ease;
    }
    nav ul li a:hover {
      color: #ffc107;
    }
    main {
      padding: 20px;
      text-align: center;
    }
    .logout-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background-color: #333;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <header>
    <h1>Admin Dashboard</h1>
    
    <?php
    // Logout functionality
    if (isset($_POST['logout'])) {
        // Perform any logout actions here, such as destroying the session
        session_start();
        session_destroy();
        // Redirect back to admin.php after logout
        header("Location: index.php");
        exit;
    }
    ?>
    <!-- Logout button -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <button type="submit" name="logout" class="logout-btn">Logout</button>
    </form>
  </header>
  <nav>
    <ul>
      <li><a href="view-bookings.php">View Bookings</a></li>
      <li><a href="manage-bookings.php">Manage Bookings</a></li>
      <li><a href="add-event.php">Add New Event</a></li>
      <li><a href="member-list.php">Member List</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="announcement.php">Announcement</a></li>
    </ul>
  </nav>
  <main>
    <p>Welcome to the admin dashboard. Use the navigation links above to access different functionalities.</p>
  </main>
  <footer>
    <p>&copy; Dancing Society</p>
  </footer>
</body>
</html>