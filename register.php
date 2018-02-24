<?php
 ob_start();
 session_start();
 if( isset($_SESSION['user'])!="" ){
  header("Location: home.php");
 }
 include_once 'localdb.php';

 $error = false;
 echo("first line");

 if ( isset($_POST['signup-btn']) ) {
echo("passsed");
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }

  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }
   else {
   // check email exist or not
   if(!$db){
     echo('error');
   }
   $query = "SELECT email FROM users WHERE email='$email'";
   $result = mysqli_query($db,$query);
   if (!$result) {
            echo ' Database Error Occured ';
        }
   $count = mysqli_num_rows($result);

   if($count!=0){

    $error = true;
    $emailError = "Provided Email is already in use.";
   }
 }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }

  // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  $user_type=$_POST['user_type'];
IF($error){
  echo("there were errors");
}
  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO users(username,email,password,type) VALUES('$name','$email','$password','$user_type')";
   $res = mysqli_query($db,$query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later...";
   }

  }


 }
?>
<!DOCTYPE html>
<html>
<head>
	<title>WeGuide SignUp</title>
	<style type="text/css">
	body{
		background-image: url(img/Signal_Hill.jpg);
		background-size: cover;

	}
	.header{

		height:auto;
		font-family:Impact, Charcoal, sans-serif;
		font-size: 200%;
		font-weight: bold;
		letter-spacing: 7px;
		word-spacing: 3px;
		text-shadow: 9px 9px 5px #333;
		text-align: center;
		color: white;

	}

	.loginContainer{
		width : 300px;
		height : 370px;
		background-color: rgba(0,0,0,0.5);
		margin:0 auto;
		margin-top:100px;
		padding-top: 10px;
		padding-left: 50px;
		border-radius: 15px;
		-webkit-border-radius:15px;
		-o-border-radius:15px;
		-moz-border-radius:15px;
		color:white;
		font-weight: bolder;
		box-shadow: inset -4px -4px rgba(0,0,0,0.5);
		font-size: 18px;
	}
	.loginContainer input[type="email"]{
		width: 200px;
		height: 35px;
		border: 0;
		border-radius: 5px;
		-webkit-border-radius:5px;
		-o-border-radius:5px;
		-moz-border-radius:5px;
		padding-left: 5px;
	}
	.loginContainer input[type="text"]{
		width: 200px;
		height: 35px;
		border: 0;
		border-radius: 5px;
		-webkit-border-radius:5px;
		-o-border-radius:5px;
		-moz-border-radius:5px;
		padding-left: 5px;
	}
	.loginContainer input[type="password"]{
		width: 200px;
		height: 35px;
		border: 0;
		border-radius: 5px;
		-webkit-border-radius:5px;
		-o-border-radius:5px;
		-moz-border-radius:5px;
		padding-left: 5px;
	}
	.loginContainer input[type="button"]{
		width: 100px;
		height: 35px;
		border: 0;
		border-radius: 5px;
		-webkit-border-radius:5px;
		-o-border-radius:5px;
		-moz-border-radius:5px;
		background-color: #4da6ff;
		font-weight: bolder;
	}
	input:valid{
		background-image: url(img/tick.png);
		background-repeat: no-repeat;
		background-position: right;
		background-size: 20%;
	}
	input:invalid{
		background-image: url(img/warning.png);
		background-repeat: no-repeat;
		background-position: right;
		background-size: 10%;
	}
	</style>
</head>
<body>
<div class="header">
<h1>We Guide</h1>
</div>
<div class="loginContainer">
<h2>Enter your information</h2>
<form name="registrationForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	<input type="text" name="name"placeholder="Enter Your Name..." required><br><br>
	<input type="email" name="email"placeholder="Enter Email..." required><br><br>
	<input type="password" name="pass"placeholder="Enter Password..." required><br><br>
	<input type="radio" name="user_type" value="tourist">I am a tourist<br>
	<input type="radio" name="user_type" value="guide">I am a guide<br><br>
	<input type="submit" name="signup-btn" value="Submit">
</form>
</div>

</body>
</html>
