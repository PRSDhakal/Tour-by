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
  <title>Tour'by </title>
  <link rel="stylesheet" href="css/login.css" type="text/css" media="all" />

</head>
<body>
  <div class="header">
    <img src = "css/img/logowhite.png" />

  </div>
  <div class="loginContainer">
    <?php
    if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
      header('Location: getplaces.php'); ?>
      <?php }else{ ?>
        <h2>Login</h2>
        <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
        <div class="regisFrm">
          <form action="touristAccount.php" method="post">
            <input type="email" name="email" placeholder="Enter e-mail..." required=""><br><br>
            <input type="password" name="password" placeholder="Enter password..." required=""><br><br>

            <input type="submit" name="loginSubmit" value="Login">
            <p>New to Tour'by?</p>
            <input type="button" value="Sign up as tourist" onclick="location.href='signUpTourist.php';">
            <input type="button" value="Sign up as guide" onclick="location.href='signUpGuide.php';">
          </form>
        </div>

        <?php } ?>
      </div>
      <footer id="footer">
        <p>Developed by Prasanga, Anuj and Ray</p>
      </footer>
    </body>
    </html>
