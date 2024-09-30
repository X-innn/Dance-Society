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
        $sql = "DELETE FROM user WHERE ID = ?";
        $stm = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($stm, $sql)) {
            foreach ($Cancel as $cancel) {
                mysqli_stmt_bind_param($stm, "s", $cancel);
                mysqli_stmt_execute($stm);
            }
            mysqli_stmt_close($stm);
            mysqli_close($con);
            header("Location: member-list.php");
            exit();
        } else {
            $error = "Failed to prepare the SQL statement: " . mysqli_error($con);
        }
    } else {
        $error = "Please select at least one user to delete.";
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['ID'];
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "SELECT * FROM user WHERE ID=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($name != $row['Name'] || $email != $row['Email'] || $phone != $row['Phone']) {

        $update_sql = "UPDATE user SET ";
        $params = array();
        if ($name != $row['Name']) {
            $update_sql .= "Name=?, ";
            $params[] = $name;
        }
        if ($email != $row['Email']) {
            $update_sql .= "Email=?, ";
            $params[] = $email;
        }
        if ($phone != $row['Phone']) {
            $update_sql .= "Phone=?, ";
            $params[] = $phone;
        }

        $update_sql = rtrim($update_sql, ", ");

        $update_sql .= " WHERE ID=?";
        $params[] = $id;

        $update_stmt = $con->prepare($update_sql);
        $types = str_repeat("s", count($params)); 
        $update_stmt->bind_param($types, ...$params);
        
        if ($update_stmt->execute()) {
            header("Location: member-list.php?success=edit");
            exit;
        } else {
            header("Location: member-list.php?error=edit");
            exit;
        }
    } else {
        header("Location: member-list.php?info=no_change");
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
        <h2>Member List</h2>

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
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM user";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Gender'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Phone'] . "</td>";
                        echo "<td>" . $row['Birthday'] . "</td>";
                        echo "<td>";
                        // Edit form
                        echo "<form method='post' action='' onsubmit='return confirmChange()'>";
                        echo "<input type='hidden' name='ID' value='" . $row['ID'] . "'>";
                        echo "<input type='hidden' name='Name' value='" . $row['Name'] . "'>";
                        echo "<input type='hidden' name='email' value='" . $row['Email'] . "'>";
                        echo "<input type='hidden' name='phone' value='" . $row['Phone'] . "'>";
                        echo "<button type='button' id='showDiv" . $row['ID'] . "' style='padding-left: 8.5%; padding-right: 7.5%'>Edit</button>";
                        echo "<div class='edit-form'>";
                        echo "<label for='Name'>Name:</label><br>";
                        echo "<input type='text' name='Name' value='" . $row['Name'] . "'><br><br>";
                        echo "<label for='email'>Email:</label><br>";
                        echo "<input type='text' name='email' value='" . $row['Email'] . "'><br><br>";
                        echo "<label for='phone'>Phone:</label><br>";
                        echo "<input type='text' name='phone' value='" . $row['Phone'] . "'><br><br>";
                        echo "<button type='submit' name='edit'>Save Changes</button>";
                        echo "</form>";
                        echo "</div>";
                        // Delete form
                        echo "<form method='post' action='' onsubmit='return confirmCancellation()'>";
                        echo "<input type='hidden' name='cancel[]' value='" . $row['ID'] . "'>";
                        echo "<button type='submit'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="7">No user registered.</td></tr>';
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
        return confirm("Are you sure you want to delete this user?");
    }

    function confirmChange() {
        return confirm("Are you sure you want to save change?");
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