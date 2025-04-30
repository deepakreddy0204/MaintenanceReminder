<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Add Home Maintenance Reminder</title>
 <style>
        /* Global Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
        }

        header nav ul li {
            display: inline;
            margin-right: 15px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
        }

        /* Table Styling */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table td {
            background-color: #f9f9f9;
        }

        table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        table tr:hover td {
            background-color: #ddd;
        }

        table a {
            color: #2196F3;
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }
            table th, table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
            <li><a href="autoRemainder.php">Auto Reminders</a>&nbsp;&nbsp;</li>
            <li><a href="financeRemainder.php">Finance Reminders</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
        </ul>
    </nav>
</header>


<?php
require('db.php');
include('authentication.php');

if (isset($_POST['submit'])) {
    // Fetch form data
    $task = stripslashes($_REQUEST['task']);
    $task = mysqli_real_escape_string($con, $task);
    $dueDate = stripslashes($_REQUEST['dueDate']);
    $dueDate = mysqli_real_escape_string($con, $dueDate);
    $username = $_SESSION['username'];

    // Insert reminder into database
    $query = "INSERT INTO `maintenance_remainder` (type, task, username, due_date)
              VALUES ('home','$task', '$username', '$dueDate')";
    $result = mysqli_query($con, $query);

    // Check if reminder was added successfully
    if ($result) {
        echo "<div class='form'>
              <h3>You have added a maintenance reminder successfully!</h3><br/>
              <p class='link'>Click here to <a href='home.php'>view your reminders</a>.</p>
              </div>";
    } else {
        echo "<div class='form'>
              <h3>Error: Fields Missing or Invalid Data</h3><br/>
              <p class='link'>Click here to <a href='addReminder.php'>Add Reminder</a> again.</p>
              </div>";
    }
} else {
?>

<h1 style="font-size:45px;text-align:center">Home, Auto & Finance Reminder Tracker</h1>  
<form class="form" action="" method="post" name="addReminder">
    <h3 class="login-title">Add a New Home Maintenance Reminder</h3>
    <input type="text" class="login-input" name="task" placeholder="Maintenance Task (e.g., Change AC Filter)" required />
    <input type="date" class="login-input"  
       value="<?php echo $row['due_date']; ?>" 
       name="dueDate"
       min="<?php echo date('Y-m-d', strtotime('+2 days')); ?>" required>
    <input type="submit" value="Add Reminder" name="submit" class="login-button" />
</form>

<?php
}
?>

</body>
</html>
