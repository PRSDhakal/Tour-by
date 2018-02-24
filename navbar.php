<?php
include_once 'header.php'?>

<nav class="teal darken-3" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="getplaces.php" class="brand-logo"><img class="responsive-img " style="padding-top: 5px;"
         height="100px" width="100px" src="img/logowhite.png"
    </a>
        <ul class="right hide-on-med-and-down">
            <li><a href="myTours.php">Manage Tours</a></li>
            <li> <a href="touristAccount.php?logoutSubmit=1" class="logout">Logout</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="myTours.php">Manage Tours</a></li>
            <li> <a href="touristAccount.php?logoutSubmit=1" class="logout">Logout</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>

    </div>
</nav>