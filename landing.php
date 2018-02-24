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
  <title>Profile</title>
  <link rel="stylesheet" href="css/login.css" type="text/css" media="all" />

</head>
<body>
  <div class="header">
    <img src = "css/img/logowhite.png" />

  </div>
  <div class="loginContainer"><?php
  include 'user.php';
  $user = new User();
  $conditions['where'] = array(
    'id' => $sessData['userID'],
  );
  $conditions['return_type'] = 'single';
  $userData = $user->getRows($conditions);
  ?>
  <h2>Welcome <?php echo $userData['first_name']; ?>!</h2>

  <div class="regisFrm">
    <p><b>Name: </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
    <p><b>Email: </b><?php echo $userData['email']; ?></p>
    <p><b>Type: </b><?php echo $userData['type']; ?></p>
  </div>
  <a href="touristAccount.php?logoutSubmit=1" class="logout">Logout</a>
</div>
</body>
</html>
