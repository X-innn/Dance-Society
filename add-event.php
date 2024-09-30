<?php
session_start();

require_once('helper.php');


if (isset($_POST['cancel'])) {
  $selectedDances = isset($_POST['cancel']) ? $_POST['cancel'] : array();
  if (!empty($selectedDances)) {
    $sql = "DELETE FROM events WHERE name = ?";
    $stm = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($stm, $sql)) {
      foreach ($selectedDances as $cancelDance) {
        mysqli_stmt_bind_param($stm, "s", $cancelDance);
        mysqli_stmt_execute($stm);
      } 
      mysqli_stmt_close($stm);
      mysqli_close($con);
      header("Location: add-event.php");
      exit();
    } else {
      $error = "Failed to prepare the SQL statement: " . mysqli_error($con);
    }
  } else {
    $error = "Please select at least one booking to cancel.";
  }
}

if (isset($_POST['edit'])) {
  $name = $_POST['name'];
  $desc = $_POST['description'];
  $image = isset($_POST['image']);

  $sql = "SELECT * FROM events WHERE name=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("s", $name);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($name != $row['name'] || $desc != $row['description']) {

    $update_sql = "UPDATE events SET ";
    $params = array();
    if ($name != $row['name']) {
      $update_sql .= "name=?, ";
      $params[] = $name;
    }
    if ($desc != $row['description']) {
      $update_sql .= "description=?, ";
      $params[] = $desc;
    }

    $update_sql = rtrim($update_sql, ", ");

    $update_sql .= " WHERE name=?";
    $params[] = $name;

    $update_stmt = $con->prepare($update_sql);
    $types = str_repeat("s", count($params));
    $update_stmt->bind_param($types, ...$params);

    if ($update_stmt->execute()) {
      header("Location: add-event.php?success=edit");
      exit;
    } else {
      header("Location: add-event.php?error=edit");
      exit;
    }
  } else {
    header("Location: add-event.php?info=no_change");
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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

    .search_container {
            text-align: left;
        }

        .search_box {
            display: inline-block;
            margin-top: 20px;
            margin-bottom: 20px;
        }

    a.add {
      color: black;
      font-size: 15px;
      text-decoration: none;
    }

    /* Hide edit form by default */
    .edit-form {
      display: none;
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

      <h3>Event Details</h3>

      <div class="search_container">
            <form class="search_box" onsubmit="search()">
                <label for="id">Event Name : </label>
                <input type="text" class="search" id="searchInput" placeholder="Search by Event Name.." style="width: 40%;">
                <button type="submit" class="search_button">Search
                </button>
                <button class="reset" onclick="resetSearch()">Reset
                </button>
            </form>
        </div>

      <table id="eventDetails">

        <thead>
          <tr>

            <th>Event Name</th>
            <th>Event Description</th>
            <th>Event Image</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
          <?php
          require_once('helper.php');

          $sql = "SELECT * FROM events";
          $result = $con->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['description'] . "</td>";
              echo "<td><img src='" . $row['image'] . "' width='100'></td>";
              echo "<td>";
              // Edit form
              echo "<form method='post' action='' onsubmit='return confirmChange()'>";
              echo "<input type='hidden' name='name' value='" . $row['name'] . "'>";
              echo "<input type='hidden' name='description' value='" . $row['description'] . "'>";
              echo "<input type='hidden' name='image' value='" . $row['image'] . "'>";
              echo "<button type='button' id='showDiv" . $row['name'] . "' style='padding-left: 8.5%; padding-right: 7.5%'>Edit</button>";
              echo "<div class='edit-form'>";
              echo "<label for='description'>Description:</label><br>";
              echo "<input type='text' name='description' value='" . $row['description'] . "'><br><br>";
              echo "<button type='submit' name='edit'>Save Changes</button>";
              echo "</div>";
              echo "</form>";
              // Delete form
              echo "<form method='post' action='' onsubmit='return confirmCancellation()'>";
              echo "<input type='hidden' name='cancel[]' value='" . $row['name'] . "'>";
              echo "<button type='submit'>Delete</button>";
              echo "</form>";
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='3'>No events found.</td></tr>";
          }
          $con->close();
          ?>
        </tbody>
      </table>
      <button><a href="addEvent.php" class="add">Add Event</a></button>
  </main>
</body>

</html>
<footer>
  <p>&copy; Dancing Society</p>
</footer>

<script>
      function search() {
        event.preventDefault();
        var searchInput = document.getElementById("searchInput").value.toLowerCase();
        var tableRows = document.querySelectorAll("tbody tr");
        tableRows.forEach(function(row) {
            var userID = row.querySelector("td:nth-child(1)").innerText.toLowerCase();
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

  function confirmCancellation() {
    return confirm("Are you sure you want to delete this booking?");
  }

  function confirmChange() {
    return confirm("Are you sure you want to save changes?");
  }
</script>
<script>
  $(document).ready(function() {

    $('button[id^="showDiv"]').click(function() {
      $(this).siblings('.edit-form').toggle();
    });
  });
</script>

</html>