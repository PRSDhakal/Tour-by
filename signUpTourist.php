<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tour'by Tourist SignUp</title>
    <link rel="stylesheet" href="css/touristSignUp.css" type="text/css" media="all" />

</head>
<body>
  <div class="header">
    <img src = "css/img/logowhite.png" />

  </div>
<h3 style="color:white;text-align:center">Fill in the form below to meet the best guides in St. John's!</h3>
	<div class="regloginContainer">
		<h2>Enter your information</h2>
		<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
		<div class="regisFrm">
			<form action="touristAccount.php" method="post">
				<input type="text" name="first_name" placeholder="Enter First name..." required=""><br><br>
				<input type="text" name="last_name" placeholder="Enter Last name..." required=""><br><br>
				<input type="email" name="email" placeholder="Enter e-mail..." required=""><br><br>

				<input type="password" name="password" placeholder="Enter password..." required=""><br><br>
				<input type="password" name="confirm_password" placeholder="Confirm password..." required=""><br><br>

					<input type="submit" name="signupSubmit" value="Submit">

			</form>
		</div>
	</div>
</body>
</html>
