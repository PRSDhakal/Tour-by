<?php
session_start();
$_SESSION['viewValue']=$_GET['guide'];
$id=$_GET['guide'];
$place=$_GET['pl'];
include_once 'navbar.php';
include 'config.php';
$sql="select first_name, owns_car, last_name,rate,description,languages,picURL from users where id=".$_GET['guide'];
$res=$db->query($sql);
if ( $res=== FALSE) {// handle errors
    echo "Error: " . $sql . "<br>" . $db->error;
}
$data = $res->fetch_assoc();
$pic = "img/" . $data['picURL'];
$desc = $data['description'];
$lang=$data['languages'];
$rate=$data['rate'];
$own=$data['owns_car'];
$fullname = $data['first_name']." ".$data['last_name'];
$hirename = "hireguide.php?guideId=" . $id . "&pl=" . $place;

?>

<title>Profile</title>

<div class="container center">
    <div class="row teal lighten-2 z-depth-2">
    <figure class="card-profile-image">
        <img src="<?php echo $pic?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
    </figure>
        <h4 class="white-text" align="center"> <?php echo $fullname?></h4>
    </div>
<a href="<?php echo $hirename?>" class="btn" align="center"> HIRE ME</a>
<div id="profile-page-content" class="row">

    <div id="profile-page-sidebar" class="col s12 m12">
        <div class="card light-blue">
            <div class="card-content white-text">
                <span class="card-title">About Me!</span>
                <p><?php echo $desc;?></p></div>
        </div>

        <ul id="profile-page-about-details" class="collection z-depth-1">
            <li class="collection-item">
                <div class="row">
                    <div class="col s5 grey-text darken-1"><i class= "material-icons ">language</i>Language</div>
                    <div class="col s7 grey-text text-darken-4 right-align"><?php echo $lang;?></div>
                </div>
            </li>

            <li class="collection-item">
                <div class="row">
                    <div class="col s5 grey-text darken-1"><i class="material-icons">directions_car</i> Own vehicle</div>
                    <div class="col s7 grey-text text-darken-4 right-align"><?php echo $own;?></div>
                </div>
            </li>

            <li class="collection-item">
                <div class="row">
                    <div class="col s5 grey-text darken-1"><i class="material-icons">monetization_on</i> Rate</div>
                    <div class="col s7 grey-text text-darken-4 right-align"><?php echo "$ ".$rate ." per trip";?></div>
                </div>
            </li>
        </ul>

    </div>

    <?php
include 'review.php';?>