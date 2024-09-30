<?php
session_start();

require_once('helper.php');

?>

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

    header,
    footer {
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

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #333;
      color: white;
    }
  </style>
</head>

<body>
  <header>
    <h1>Admin Dashboard</h1>

        <!-- Logout button -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <button type="submit" name="logout" class="logout-btn">Logout</button>
    </form>

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

  <?php
    if (isset($_POST['submit'])) {

      $eventName = $con->real_escape_string($_POST['eventName']);
      $eventDescription = $con->real_escape_string($_POST['eventDescription']);

      $targetDir = "uploads/";
      $targetFile = $targetDir . basename($_FILES["file"]["name"]);
      move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);

      $stmt = $con->prepare("INSERT INTO events (name, description, image) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $eventName, $eventDescription, $targetFile);

      if ($stmt->execute()) {
        echo "New event created successfully";
      } else {
        echo "Error: " . $stmt->error;
      }

      $stmt->close();
    }
    ?>

  <h2>Add New Event</h2>

    <form action="" method="POST" id="updateForm" enctype="multipart/form-data" onsubmit="return confirmAdd()">
      <label for="eventName">Event Name:</label>
      <input type="text" id="eventName" name="eventName"><br><br>
      <label for="eventDescription">Event Description:</label>
      <textarea id="eventDescription" name="eventDescription"></textarea><br><br>
      <label for="eventImage">Event Image:</label><br>
      <input type="file" id="file" name="file">
      <input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><br><br>
      <button type="submit" name="submit">Add</button>
      <br>
      <a href="add-event.php">View Event</a>
    </form>
    
  </main>
</body>

<footer>
  <p>&copy; Dancing Society</p>
</footer>

<script>

  function confirmAdd() {
    return confirm("Are you sure you want to add this event?");
  }

</script>

</html>