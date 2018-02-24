<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 3/19/2017
 * Time: 6:31 PM
 */
include 'config.php';
include 'header.php';

//retreive all the items from the post method
$guideID = $_GET["g"];
$touristID = $_GET['t'];
$bookDate = $_GET['bD'];
$sqlguide = "select first_name, last_name from users where (id=" . $guideID . ")";
$sqltourist = "select first_name, last_name from users where (id=" . $touristID . ")";
$tguide = $db->query($sqlguide);
$ttourist = $db->query($sqltourist);
if (!$tguide||!$ttourist) {

    die(' There was an error with query' . $db->error);

}


$guide = ($tguide->fetch_assoc());
$tourist = ($ttourist->fetch_assoc());
date_default_timezone_set('UTC');
if (isset($_GET['t'])) {
    $id = $_GET['t'];
    $qu = "select email from users where id=" . $id;
    $res = $db->query($qu);
    if (!$res) {

        die(' There was an error with query' . $db->error);

    }
    $data = $res->fetch_assoc();
    $email = $data['email'];
}
if (isset($_GET['g'])) {
    $id = $_GET['g'];
    $qu = "select email from users where id=" . $id;
    $res = $db->query($qu);
    if (!$res) {

        die(' There was an error with query' . $db->error);

    }
    $data = $res->fetch_assoc();
    $gemail = $data['email'];
}

if (isset($_POST['submit'])) {
if($_POST['offer']=='accept'){
    $date_field         = date('Y-m-d',strtotime($_GET['bD']));
    $qu = "insert into tours (touristId,guideId,tourDate,place) values(".$touristID.",".$guideID.","."'".$date_field."'".","."'".$_GET['pl']."' )" ;
    $res = $db->query($qu);
    if (!$res) {

        die(' There was an error with query' . $db->error);

    }
}
    $to = $email;
    $subject = "Tourby: Response from your guide";
    $txt = "Hi,
Your potential tour guide has sent you a message.Please view the following message from the tourist who booked you:
" . $_POST['message'];
    $headers = "From: ".$gemail;

    mail($to, $subject, $txt, $headers);
echo"<h1> Your response has been successfully sent</h1>";
return;
}


echo '

<html>
<head>
    <title> Confirmation</title>
</head>
<body>
<h1 align="center">Tour Confirmation </h1>
<div class="container">
 <div class="row">
 Tourist\'s name: ' . $tourist['first_name']." ".$tourist['last_name'] . '
 
 <br/>Proposed Date: '.$_GET['bD'].'
 
<form method="post" action="">
    <p name="email">Tourist\'s email: ' . $email . '</p>
    <label for="message">Your response:</label><br/>
    <textarea class="materialize-textarea"  name="message"></textarea> <br/><br/><br/>
    <input name="offer" type="radio" id="ac" value="accept"/>
      <label for="ac">Accept Offer</label>
<input name="offer" type="radio" id="rj" value="reject"/>
      <label for="rj">Reject Offer</label>
    <br/>
    
    <input class="btn"type="submit" name="submit" value="Send">
</form>
</div>
</div>
</body>
</html>'
?>
