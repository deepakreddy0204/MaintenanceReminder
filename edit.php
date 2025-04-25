<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Update</title>
    <h1 style="font-size:50px;text-align:center;color:#000000;background-color:white">Maintenance Reminder</h1>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
	include('db.php');
	$remainder_id=$_GET['remainder_id'];
	$query=mysqli_query($con,"select * from `maintenance_remainder` where remainder_id='$remainder_id'");
	$row=mysqli_fetch_array($query);
?>
<form class="form" method="POST" name="edit" action="update.php?remainder_id=<?php echo $remainder_id; ?>">
    <h1 class="login-title">Edit</h1>
		<label>Task Name</label><input type="text" class="login-input" value="<?php echo $row['task']; ?>" name="task">
		<label>Due Date</label><input type="date" class="login-input" 
       value="<?php echo $row['due_date']; ?>" 
       name="due_date"
       min="<?php echo date('Y-m-d', strtotime('+2 days')); ?>">

		<input type="submit" class="login-button" name="update">
		<p class="link"><a href="home.php">Home</a><p>
	</form>
</body>
</html>