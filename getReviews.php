<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 3/27/2017
 * Time: 9:45 PM
 */
include 'config.php';
$requested;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['command'])) {// if 'id' is set
        $requested = $_POST['command'];//get the id

    }

    if (isset($_POST['comment']) && isset($_POST['tournum'])) {
        $tourNo = $_POST['tournum'];
        $retreivedComment = $_POST['comment'];
        $insertQuery = "UPDATE tours SET review = \"" . $retreivedComment . "\"WHERE tour_number = " . $tourNo;
        if ($db->query($insertQuery) === FALSE) {// handle errors
            echo "Error: " . $insertQuery . "<br>" . $db->error;
        }

    }
}
$sql = "SELECT tours.tourDate, tours.tour_number, users.first_name,users.last_name,tours.review\n"
    . " FROM tours\n"
    . "\n"
    . "INNER JOIN users ON tours.touristId=users.id\n"
    . " Where tours.guideId=" . $requested . " AND tours.review IS NOT NULL LIMIT 0, 30 ";
if (($result = $db->query($sql)) === FALSE) {// handle errors
    echo "Error: " . $sql . "<br>" . $db->error;
}
$allComments;


$i = 0;
//get all the comments in an array
$allComments = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['review'] != "") {
            if (!empty($row['review'])) {
                $obj = (object)array("comment" => $row['review']
                , "author" => $row['first_name'] . " " . $row['last_name']
                , "tourId" => $row['tour_number']
                , "tourDate" => $row['tourDate']);
                array_push($allComments, $obj);
            }
            $i += 1;
        }
    }
} else {
    $allComments = "No reviews yet!";
}
$encodedJson = json_encode($allComments);
echo $encodedJson;


