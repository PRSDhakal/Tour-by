<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 3/15/2017
 * Time: 10:05 PM
 */
session_start();
include 'header.php';

include 'navbar.php';

$_SESSION['uid'] = 1;
$_SESSION['uemail'];
if ($_SESSION['uplace'] != $_GET['pl']) {
    echo 'Your session has expired!';
    return;
}
$s = $_SESSION['sessData'];
include 'config.php';
$id;
if (isset($_GET['guideId'])) {
    $id = $_GET['guideId'];
    $qu = "select email from users where id=" . $id;
    $res = $db->query($qu);
    if (!$res) {
        die(' There was an error with query' . $db->error);

    }

    $data = $res->fetch_assoc();
    $email = $data['email'];
}
if (isset($_POST['submit'])) {
    $dateProp = $_POST['propdate'];
    date_default_timezone_set('UTC');
    $date = date('m/d/Y', time());

    if (strtotime($dateProp) <= strtotime($date)) {
        echo "<p align='center' style='font-size:200%;color:red;'>Set a valid date</p>";
    } else {
        $confirmationLink = "http://www.cs.mun.ca/~aw7464/project/confirmation.php?pl=" . $_SESSION['uplace'] . "&t=" . $s['userID']
            . "&g=" . $id . "&bD=" . $dateProp;
        $to = $email;
        $subject = "You have been booked.";
        $txt = "Hi,
    You have been booked for a tour guide. Please view the following message from the tourist who booked you:
    " . $_POST['message'] . "
         To confirm this tour, please follow the following link.
         " . $confirmationLink;;
        $headers = "From:" . $_SESSION['uemail'];;
        mail($to, $subject, $txt, $headers);
        echo "<h1 align='center'> Your response has been successfully sent</h1>";
        return;
    }

}
?>
<?php
echo '

<html>
<head>
</head>
<body>
<h1 align="center"> Contact the guide </h1>
<div class="container">
<div class="row">
<form method="post" action="">
    <p name="email">To: ' . $email . '</p>
    <br/>
    Propose a Date: <input type="date" name="propdate" ><br/>
    <label for="message">Your message:</label><br/>
    <textarea class="materialize-textarea"rows="50" cols="50" name="message"></textarea> <br/>
    <br/>
    <input  class="btn" type="submit" name="submit" value="Send">
</form>
</div>
</div>
</body>
</html>';
?>