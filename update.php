<?php
	include('db.php');
	$remainder_id=$_GET['remainder_id'];
	$task=$_POST['task'];
	$due_date=$_POST['due_date'];
	mysqli_query($con,"update `maintenance_remainder` set task='$task', due_date='$due_date' where remainder_id='$remainder_id'");
	echo "<div class='form'>
    <h3>Updated succesfully</h3><br/>
    <p class='link'>Click here to see items<a href='Home.php'>Home</a></p>
    </div>";
?>