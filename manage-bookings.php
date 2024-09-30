<?php
require_once('helper.php');

if (isset($_POST['cancel'])) {
    $selectedDances = isset($_POST['cancel']) ? $_POST['cancel'] : array();
    if (!empty($selectedDances)) {
        $sql = "DELETE FROM bookings WHERE dateTime = ?";
        $stm = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($stm, $sql)) {
            foreach ($selectedDances as $cancelDance) {
                mysqli_stmt_bind_param($stm, "s", $cancelDance);
                mysqli_stmt_execute($stm);
            }
            mysqli_stmt_close($stm);
            mysqli_close($con);
            header("Location: manage-bookings.php");
            exit();
        } else {
            $error = "Failed to prepare the SQL statement: " . mysqli_error($con);
        } 
    } else {
        $error = "Please select at least one booking to cancel.";
    }
}

if (isset($_POST['edit'])) {
    $bookingID = $_POST['booking_ID'];
    $id = $_POST['user_ID'];
    $name = $_POST['user_Name'];
    $danceName = $_POST['danceName'];
    $quantity = $_POST['quantity'];
    $dateTime = $_POST['dateTime'];

    $sql = "SELECT * FROM bookings WHERE booking_ID=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $bookingID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($bookingID != $row['booking_ID'] || $id != $row['user_Name'] 
    || $danceName != $row['danceName'] || $quantity != $row['quantity'] 
    || $dateTime != $row['dateTime']) {

        $update_sql = "UPDATE bookings SET ";
        $params = array();
        if ($bookingID != $row['booking_ID']) {
            $update_sql .= "booking_ID=?, ";
            $params[] = $bookingID;
        }
        if ($name != $row['user_Name']) {
            $update_sql .= "user_Name=?, ";
            $params[] = $name;
        }
        if ($danceName != $row['danceName']) {
            $update_sql .= "danceName=?, ";
            $params[] = $danceName;
        }
        if ($quantity != $row['quantity']) {
            $update_sql .= "quantity=?, ";
            $params[] = $quantity;
        }
        if ($dateTime != $row['dateTime']) {
            $update_sql .= "dateTime=?, ";
            $params[] = $dateTime;
        }

        $update_sql = rtrim($update_sql, ", ");

        $update_sql .= " WHERE booking_ID=?";
        $params[] = $bookingID;

        $update_stmt = $con->prepare($update_sql);
        $types = str_repeat("s", count($params)); 
        $update_stmt->bind_param($types, ...$params);
        
        if ($update_stmt->execute()) {
            header("Location: manage-bookings.php?success=edit");
            exit;
        } else {
            header("Location: manage-bookings.php?error=edit");
            exit;
        }
    } else {
        header("Location: manage-bookings.php?info=no_change");
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
    <title>Manage Bookings</title>
    <style>
        /* CSS code here */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            position: relative;
            /* Ensure relative positioning for absolute positioning */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        .search_container {
            text-align: left;
        }

        .search_box {
            display: inline-block;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Positioning for logout button */
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

        /* Hide edit form by default */
        .edit-form {
            display: none;
        }
    </style>
</head>

<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
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
        <div class="cancelled-bookings" id="cancelledBookings">
            <h2>Manage Bookings</h2>
            <!-- Form to cancel a booking -->
            <div class="search_container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="search_box" onsubmit="search()">
                    <label for="id">User ID to Cancel : </label><br><br>
                    <input type="text" class="search" id="searchInput" placeholder="Search by User ID..." style="width: 50%;">
                    <button type="submit" class="search_button">Search</button>
                    <button class="reset" onclick="resetSearch()">Reset</button>
                </form>
                <br><br>
                <!-- Display canceled bookings -->

                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Event Name</th>
                            <th>Quantity</th>
                            <th>Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        require_once('helper.php');

                        $sql = "SELECT * FROM bookings";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['booking_ID'] . "</td>";
                                echo "<td>" . $row['user_ID'] . "</td>";
                                echo "<td>" . $row['user_Name'] . "</td>";
                                echo "<td>" . $row['danceName'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['dateTime'] . "</td>";
                                echo "<td>";
                                // Edit form
                                echo "<form method='post' action='' onsubmit='return confirmChange()'>";
                                echo "<input type='hidden' name='booking_ID' value='" . $row['booking_ID'] . "'>";
                                echo "<input type='hidden' name='user_ID' value='" . $row['user_ID'] . "'>";
                                echo "<input type='hidden' name='user_Name' value='" . $row['user_Name'] . "'>";
                                echo "<input type='hidden' name='danceName' value='" . $row['danceName'] . "'>";
                                echo "<input type='hidden' name='quantity' value='" . $row['quantity'] . "'>";
                                echo "<input type='hidden' name='dateTime' value='" . $row['dateTime'] . "'>";
                                echo "<button type='button' id='showDiv" . $row['booking_ID'] . "' style='padding-left: 8.5%; padding-right: 7.5%'>Edit</button>";
                                echo "<div class='edit-form'>";
                                echo "<label for='user_Name'>User Name:</label><br>";
                                echo "<input type='text' id='user_Name' name='user_Name' value='" . $row['user_Name'] . "'><br><br>";
                                echo "<label for='danceName'>Dance Name:</label><br>";
                                echo "<input type='text' id='danceName' name='danceName' value='" . $row['danceName'] . "'><br><br>";
                                echo "<label for='quantity'>Quantity:</label><br>";
                                echo "<input type='number' id='quantity' name='quantity' value='" . $row['quantity'] . "'><br><br>";
                                echo "<label for='dateTime'>Date & Time:</label><br>";
                                echo "<input type='datetime-local' id='dateTime' name='dateTime' value='" . date('Y-m-d\TH:i', strtotime($row['dateTime'])) . "'><br><br>";
                                echo "<button type='submit' name='edit'>Save Changes</button>";
                                echo "</div>";
                                echo "</form>";     
                                // Delete form                         
                                echo "<form method='post' action='' onsubmit='return confirmCancellation()'>";
                                echo "<input type='hidden' name='cancel[]' value='" . $row['dateTime'] . "'>";
                                echo "<button type='submit'>Delete</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No bookings found</td></tr>";
                        }
                        $con->close();
                        ?>
                    </tbody>

                </table>
            </div>
            </form>
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

    function confirmCancellation() {
        return confirm("Are you sure you want to delete this booking?");
    }


    function confirmChange() {
        return confirm("Are you sure you want to save change?");
    }



</script>
<script>
$(document).ready(function(){

$('button[id^="showDiv"]').click(function()
{
    $(this).siblings('.edit-form').toggle();
});
});
</script> 

</html>
