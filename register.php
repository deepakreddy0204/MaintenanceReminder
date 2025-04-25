<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>

    <link rel="stylesheet" href="style.css"/>
 
    <script>
        function validation() {
    var name =
        document.forms.register.name.value;
    var email =
        document.forms.register.email.value;
    var phone =
        document.forms.register.phonenum.value;
    var password =
        document.forms.register.password.value;

    var regEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g; //Javascript reGex for Email Validation.
    var regPhone=/^\d{10}$/;									 // Javascript reGex for Phone Number validation.
    var regName = /\d+$/g;								 // Javascript reGex for Name validation

    if (name == "" || regName.test(name)) {
        alert("Please enter your name properly.");
        return false;
        name.focus();
       
    }

    if (email == "" || !regEmail.test(email)) {
        alert("Please enter a valid e-mail address.");
        return false;
        email.focus();
       
    }
    
    if (password == "") {
        alert("Please enter your password");
        return false;
        password.focus();
    }

    if(password.length <6){
        alert("Password should be atleast 6 character long");
        return false;
        password.focus();

    }
    if (phone == "" || !regPhone.test(phone)) {
        alert("Please enter valid phone number.");
        return false;
        phone.focus();
    }
}
</script>
</head>
<body>
<?php
require('db.php');
// When form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    // removes backslashes
    $name = stripslashes($_REQUEST['name']);
    //escapes special characters in a string
    $name = mysqli_real_escape_string($con, $name);
    $phonenum = stripslashes($_REQUEST['phonenum']);
    //escapes special characters in a string
    $phonenum = mysqli_real_escape_string($con, $phonenum);
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($con, $email);
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        // Username already exists
        echo "<div class='form'>
            <h3>Username already exists. Please choose a different one.</h3><br/>
            <p class='link'>Click here to <a href='register.php'>register</a> again.</p>
        </div>";
    } else {
    $query    = "INSERT into `users` (name, phnum, email, username, password)
    VALUES ('$name', '$phonenum', '$email', '$username','$password')"; 
    $result   = mysqli_query($con, $query);
  if ($result) {
echo "<div class='form'>
 <h3>You are registered successfully.</h3><br/>
 <p class='link'>Click here to <a href='index.php'>Login</a></p>
 </div>";
} else {
echo "<div class='form'>
 <h3>Required fields are missing.</h3><br/>
 <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
 </div>";
}}
} else {
?>



<h1 style="font-size:45px;text-align:center">Home, Auto & Finance Reminder Tracker</h1>  
    <form class="form"  onsubmit="return validation()" method="post" name="register"> 
        <h1 class="login-title">Create an account</h1>
        <input type="text" class="login-input" name="name" placeholder="Name" autofocus="true" required/>
        <input type="text" class="login-input" name="email" placeholder="Email" required/>
        <input type="text" class="login-input" name="phonenum" placeholder="Mobile Number" required/>
        <input type="text" class="login-input" name="username" placeholder="Username" required/>
        <input type="password" class="login-input" name="password" placeholder="Password" required/>
        <input type="submit" value="Register" name="register" class="login-button"/>
        <p class="link"><a href="index.php">Login</a></p>
  </form>
<?php
}
?>

</body>
</html>