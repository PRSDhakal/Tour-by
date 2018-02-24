<?php
session_start();
include 'header.php';

include 'navbar.php';
include_once 'config.php';
if(empty($_SESSION['sessData'])){
    $redirectURL="index.php";
    header("Location:".$redirectURL);

}
$sql = "SELECT id   FROM servedplaces  ";
$_SESSION['uplace'] = $_GET['id'];

//find out which place the tourist is searching
if (isset($_GET['id'])) {
    if ($_GET['id'] == 'geo') {
        $sql = "SELECT id   FROM servedplaces where place='geo' ";
    } else if ($_GET['id'] == 'signalhill') {
        $sql = "SELECT id   FROM servedplaces where place='signalhill' ";
    } else if ($_GET['id'] == 'capespear') {
        $sql = "SELECT id   FROM servedplaces where place='capspear' ";
    }
}
//get the result from the query
$result = $db->query($sql);
//if there was no result
if (!$result) {
    die(' There was an error with query' . $db->error);
}
echo'<div class="container">
<div class="row">
 <table class="table bordered"  border=1>';
//go through all the results and display them in the html
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $newQuery = "select description, picURL,first_name, last_name from users where id=" . $id;
    $res = $db->query($newQuery);
    $data = $res->fetch_assoc();

    //get the picture url and description
    $pic = "img/" . $data['picURL'];
    $desc = $data['description'];
    $fullname = $data['first_name']." ".$data['last_name'];
$profileLink="getprofile.php?guide=".$id ."&pl=" . $_GET['id'];
    $hirename = "hireguide.php?guideId=" . $id . "&pl=" . $_GET['id'];
    echo(
        '
       
      <tr>
          <td align="center">
              <img height="100px" width="100px" src="' . $pic . '">
          </td>
          <td align="center">
              <p class="guidename"><h4><a href='.$profileLink.'>' . $fullname . '</a></h4></p>
              <p class="description_guide">' . $desc . '</p>
              <a class="button" href=' . $hirename . '>HIRE ME!</a>

          </td>
      </tr>
      '
    );
}
echo'</table>
      </div>
      </div>';
?>
