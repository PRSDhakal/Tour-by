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
    <title>Tour'by Guide SignUp</title>
    <link rel="stylesheet" href="css/guideSignUp.css" type="text/css" media="all" />

</head>
<body>

<div class="header">
    <img src = "css/img/logowhite.png" />

</div>

<h3 style="color:white;text-align:center">Fill in the form below to meet tourists looking for guides like you!</h3>
<div class="regloginContainer">
    <h2>Enter your information</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
    <div class="regisFrm">
        <form action="guideAccount.php" method="post" enctype="multipart/form-data">
            <input type="text" name="first_name" placeholder="Enter First name..." required=""><br><br>
            <input type="text" name="last_name" placeholder="Enter Last name..." required=""><br><br>
            <input type="email" name="email" placeholder="Enter e-mail..." required=""><br><br>

            <input type="password" name="password" placeholder="Enter password..." required=""><br><br>
            <input type="password" name="confirm_password" placeholder="Confirm password..." required=""><br><br>
            <input type="text" name="description" placeholder="Tell us something about yourself..." required=""><br><br>
            Enter your rate <input type="number" name="rate"  step="any" required=""><br><br>
            Do you own a car? <input type = "radio" name = "car" value = "true">Yes
            <input type = "radio" name = "car" value = "false">No<br><br>
            Select the places that you are able to serve:<br> <input type="checkbox" name = "sp[]" value="signalhill">Signal Hill
            <input type="checkbox" name = "sp[]" value="capspear">Cape Spear
            <input type="checkbox" name = "sp[]" value="geo">Johnson Geo Centre<br><br>
            Enter the languages you speak <textarea name = "languages" rows = "1" cols="15"></textarea><br><br>
            Upload your profile picture. <input type = "file" name="photo" id="photo"><br><br>

            <input type="submit" name="signupSubmit" value="Submit">

        </form>
    </div>
</div>
</body>
</html>
