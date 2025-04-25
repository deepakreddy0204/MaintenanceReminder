<?php
require('db.php');
include('authentication.php'); // Ensure the user is logged in

// Fetch username from session
$username = $_SESSION['username'];

// Fetch all reminders for calendar view
$calendarQuery = "SELECT * FROM `maintenance_remainder` WHERE `username` = '$username' ORDER BY `due_date`";
$calendarResult = mysqli_query($con, $calendarQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home, Auto & Finance Reminder Tracker</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

    <style>
        /* Styling for layout */
        .container {
            display: flex;
            height: 100vh;
        }

        /* Left Sidebar */
        .sidebar {
            width: 250px;
            background-color: #f4f4f4;
            padding: 20px;
            border-right: 2px solid #ddd;
            position: fixed;
            height: 100%;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            margin: 10px 0;
            font-size: 18px;
            text-decoration: none;
            color: #333;
            background-color: #e1e1e1;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #4CAF50;
            color: white;
        }

        /* Right side content */
        .main-content {
            margin-left: 270px; /* Giving space for the sidebar */
            padding: 20px;
            width: calc(100% - 270px); /* Ensuring it takes the remaining space */
        }

        #calendar {
            max-width: 90%;
            margin: 0 auto;
            height: 400px;
        }

    </style>
</head>
<body>

<header>
    <!-- Empty header since we have the sidebar and main content -->
</header>

<div class="container">
    <!-- Left Sidebar -->
    <div class="sidebar">
        <a href="autoReminder.php">Auto Reminders</a>
        <a href="homeReminder.php">Home Reminders</a>
        <a href="financeReminder.php">Finance Reminders</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content Area (Right Side) -->
    <div class="main-content">
        <h1 style="font-size: 45px; text-align: center;">Welcome to Your Reminder Tracker</h1>

        <!-- Calendar Section -->
        <div id="calendar"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                <?php
                $eventCount = 0;
                // Fetch all reminders for the calendar
                while ($row = mysqli_fetch_assoc($calendarResult)) {
                    $eventCount++;
                    $color = $row['type'] == 'auto' ? '#FF5733' : ($row['type'] == 'home' ? '#4CAF50' : '#2196F3');
                    // Handle the last event without a trailing comma
                    echo "{
                        title: '{$row['task']}',
                        start: '{$row['due_date']}',
                        description: '{$row['task']}',
                        color: '$color'
                    }";
                    // If this isn't the last event, add a comma
                    if ($eventCount < mysqli_num_rows($calendarResult)) {
                        echo ",";
                    }
                }
                ?>
            ],
            eventClick: function(event) {
                alert('Reminder: ' + event.description);
            }
        });
    });
</script>

</body>
</html>
