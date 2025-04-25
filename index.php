<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
require('db.php');
session_start();
if(isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $_SESSION['username'] = $username;
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);;
    $query    = "SELECT * FROM `users` WHERE username='$username'
    AND password='$password'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 1 ) {
        header("Location: home.php");}
    else {
        echo "<div class='form'>
              <h3>Incorrect Username/password.</h3><br/>
              <p class='link'>Click here to <a href='index.php'>Login</a> again.</p>
              </div>";
    }
} else{

?>
<h1 style="font-size:45px;text-align:center">Home, Auto & Finance Reminder Tracker</h1>  
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="login" class="login-button"/>
        <p class="link"><a href="register.php">Create an account</a></p>
  </form>
  <?php
}
?>
</body>
</html>