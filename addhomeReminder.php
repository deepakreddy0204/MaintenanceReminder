<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Add Home Maintenance Reminder</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
            <li><a href="reminders.php">My Reminders</a>&nbsp;&nbsp;</li>
            <li><a href="profile.php">Profile</a>&nbsp;&nbsp;</li>
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
