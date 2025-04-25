<?php
    $remainder_id=$_GET['remainder_id'];
    include('db.php');
    mysqli_query($con,"delete from `maintenance_remainder` where remainder_id='$remainder_id'");
    echo "<div class='form'>
    <h3>Deleted succesfully</h3><br/>
    <p class='link'>Click here to see remainders<a href='home.php'>Reminders</a></p>
    </div>";
?>