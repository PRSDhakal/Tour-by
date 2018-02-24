<?php
$dbhost = 'mysql.cs.mun.ca';
$dbuser = 'cs3715w17_aw7464';
$dbpass = '$ZRc#33b';

$db= new mysqli($dbhost,$dbuser,$dbpass,$dbuser);
if($db->connect_errno>0){
die('Unable to establish database connection :'.$db->connect_error);
}
?>

