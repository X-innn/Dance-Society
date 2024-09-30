<?php

require_once('helper.php');

// Logout functionality
if (isset($_POST['logout'])) {
    // Perform any logout actions here, such as destroying the session
    session_start();
    session_destroy();

    header("Location: index.php");
    exit;
}

if (isset($_POST['cancel'])) {
    $Cancel = isset($_POST['cancel']) ? $_POST['cancel'] : array();
    if (!empty($Cancel)) {
        $sql = "DELETE FROM contact WHERE name = ?";
        $stm = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($stm, $sql)) {
            foreach ($Cancel as $cancel) {
                mysqli_stmt_bind_param($stm, "s", $cancel);
                mysqli_stmt_execute($stm);
            }
            mysqli_stmt_close($stm);
            mysqli_close($con);
            header("Location: feedback.php");
            exit();
        } else {
            $error = "Failed to prepare the SQL statement: " . mysqli_error($con);
        }
    } else {
        $error = "Please select at least one feedback to delete.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Online Ticketing/Booking</title>
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
        <h2>Feedback</h2>

        <div class="search_container">
            <form class="search_box" onsubmit="search()">
                <label for="id">User Name : </label>
                <input type="text" class="search" id="searchInput" placeholder="Search by User Name..." style="width: 40%;">
                <button type="submit" class="search_button">Search
                </button>
                <button class="reset" onclick="resetSearch()">Reset
                </button>
            </form>
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Surname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('helper.php');

                $sql = "SELECT * FROM contact";
                $result = mysqli_query($con, $sql);

                $totalFeedback = mysqli_num_rows($result);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $totalFeedback += (int)$row['message'];

                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['surname'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['message'] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='' onsubmit='return confirmCancellation()'>";
                        echo "<input type='hidden' name='cancel[]' value='" . $row['name'] . "'>";
                        echo "<button type='submit'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<p>Total Of Feedback: $totalFeedback</p>";
                } else {
                    echo '<tr><td>No feedback yet.</tr></td>';
                }

                mysqli_close($con);
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
            var userID = row.querySelector("td:nth-child(1)").innerText.toLowerCase();
            if (userID.includes(searchInput)) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }

    function confirmCancellation() {
        return confirm("Are you sure you want to delete this feedback?");
    }
</script>

</html>