<html>
<title>My tours</title>

<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 3/27/2017
 * Time: 11:32 PM
 */
session_start();
include 'header.php';
include 'config.php';
include 'navbar.php';

function loadTable($arr)
{
    if ($arr == 'geo') {
        return "Johnson Geo Center";
    } else if ($arr == 'signalhill') {
        return "Signal Hill";

    } else if ($arr == 'capespear') {
        return "Cape Spear";
    }
}

$s = $_SESSION['sessData'];

$requested = $s['userID'];
$sql = "SELECT tours.tourDate,tours.acceptedOn,tours.guideId, tours.place,tours.tour_number, users.first_name,users.last_name\n"
    . " FROM tours\n"
    . "\n"
    . "INNER JOIN users ON tours.guideId=users.id\n"
    . " Where tours.touristId=" . $requested;

if (($result = $db->query($sql)) === FALSE) {// handle errors
    echo "Error: " . $sql . "<br>" . $db->error;
}
if($result->num_rows==0){

    echo '<h4 align="center">You do not have any tours booked.</h4><br>
<h6 align="center"> Redirecting you to the home page......</h6>';
    header('Refresh: 3; URL=getplaces.php');
    return;
}
?>

<body>
<h1 align="center">My Tours</h1>
<div class="container">
    <table class="bordered">
        <thead>
        <tr>
            <th>Tour Number</th>
            <th>Place Name</th>
            <th>Guide Name</th>
            <th> Tour Date</th>
            <th>Tour Confirmed Time</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

            $link= "review.php?guide=".$row['guideId']."&tour=".$row['tour_number'];
                echo "<tr><td>" . $row['tour_number'] . "</td><td>" . loadTable($row['place']) . " </td><td>" . $row['first_name'] . " " . $row['last_name'] . "<br/><a href=".$link. " class=' button button5' >Write Review</button> </td><td>" . $row['tourDate'] . " </td><td>" . $row['acceptedOn'] . " </td></tr>";
            }
        }
        ?>

        </tbody>
    </table>
</div>
</body>
</html>
