<?php
$dbhost = 'mysql.cs.mun.ca';
$dbuser = '';
$dbpass = '';

$db= new mysqli($dbhost,$dbuser,$dbpass,$dbuser);
if($db->connect_errno>0){
die('Unable to establish database connection :'.$db->connect_error);
}
?>

