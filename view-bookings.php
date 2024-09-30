<?php
session_start();

require_once('helper.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Bookings</title>
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
      position: relative;
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

    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #333;
      color: white;
    }

    tbody tr:hover {
      background-color: #f2f2f2;
    }

    .search_container {
      text-align: left;
    }

    .search_box {
      display: inline-block;
      margin-top: 20px;
      margin-bottom: 20px;
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
    <h2>View Bookings</h2>
    <!-- Search form -->
    <div class="search_container">
      <form class="search_box" onsubmit="search()">
        <label for="id">User ID : </label>
        <input type="text" class="search" id="searchInput" placeholder="Search by User ID..." style="width: 40%;">
        <button type="submit" class="search_button">Search
        </button>
        <button class="reset" onclick="resetSearch()">Reset
        </button>
      </form>
    </div>
    <br>
    <table>
      <?php
      $sql = "SELECT * FROM bookings";

      $result = mysqli_query($con, $sql);
      ?>
      <thead>
        <tr>
          <th>Booking ID</th>
          <th>User ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Event Name</th>
          <th>Quantity</th>
          <th>Date & Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['booking_ID'] . "</td>";
            echo "<td>" . $row['user_ID'] . "</td>";
            echo "<td>" . $row['user_Name'] . "</td>";
            echo "<td>" . $row['user_Email'] . "</td>";
            echo "<td>" . $row['danceName'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['dateTime'] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4'>No bookings found.</td></tr>";
        }
        ?>
      </tbody>
    </table>

  </main>
  <footer>
    <p>&copy; Dancing Society</p>
  </footer>
</body>

<script>
  function search() {
    event.preventDefault();
    var searchInput = document.getElementById("searchInput").value.toLowerCase();
    var tableRows = document.querySelectorAll("tbody tr");
    tableRows.forEach(function(row) {
      var userID = row.querySelector("td:nth-child(2)").innerText.toLowerCase();
      if (userID.includes(searchInput)) {
        row.style.display = "table-row";
      } else {
        row.style.display = "none";
      }
    });
  }

  function resetSearch() {
    var tableRows = document.querySelectorAll("tbody tr");
    tableRows.forEach(function(row) {
      row.style.display = "table-row";
    });
  }
</script>

</html>

<?php
$con->close();
?>