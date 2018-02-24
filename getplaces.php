<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 3/17/2017
 * Time: 5:22 PM
 */
include 'header.php';
session_start();
if(empty($_SESSION['sessData'])){
    $redirectURL="index.php";
    header("Location:".$redirectURL);
   }
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
include 'user.php';
$user = new User();
$conditions['where'] = array(
    'id' => $sessData['userID'],
);
$conditions['return_type'] = 'single';
$userData = $user->getRows($conditions);

?>
<!--custom css to override materialize css-->
<style>
    .parallax-container {
        height: 600px;
    }

    html {
        font-family: GillSans, Calibri, Trebuchet, sans-serif;
    }

    .brand-logo {
        margin-top: auto;
        padding-top: 30px;
    }
</style>

<!--navbar-->

<?php
include'navbar.php'
;?>
<title>Tour'by, get your guide</title>

<!--the parallax stuff for nice feel-->
<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br><br>
            <h1 class="header center brown-text darken-3">Welcome, <?php echo $userData['first_name'].' '.$userData['last_name'];?></h1>
            <div class="row center">
                <h5 class="header col s12 light">Choose your destination from the list of destinations our guides
                    serve.</h5>
            </div>
            <div class="row center">
                <a href="#list" id="download-button"
                   class="btn-large waves-effect waves-light teal lighten-1">Get Started</a>
            </div>
            <br><br>

        </div>
    </div>
    <div class="parallax"><img style="-webkit-filter: blur(10px);" src="img/OI4JY30.jpg"
                               alt="Unsplashed background img 1"></div>
    <script>$(document).ready(function () {
            $('.button-collapse').sideNav();
            $('.parallax').parallax();
        });</script>
</div>


<a name="list"></a>
<div class="section">
    <!--   Icon Section   -->
    <div class="row">
        <div class="col s12 m4">
            <div class="card large">
                <div class="card-image activator waves-effect waves-block waves-light">
                    <img class="activator" src="img/Signal_Hill.jpg">
                    <span class="card-title">Signal Hill</span>
                </div>
                <div class="card-content">
                    <p>Signal Hill is a hill which overlooks the city of St. John's, Newfoundland and Labrador,
                        Canada.Due to its strategic placement overlooking the harbour, fortifications have been built on
                        the hill since the mid 17th century</p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Signal Hill<i class="material-icons right">close</i></span>
                    <p>
                        Signal Hill
                        Signal Hill is a hill which overlooks the city of St. John's, Newfoundland and Labrador, Canada.Due to its strategic placement overlooking the harbour, fortifications have been built on the hill since the mid 17th century.
                        The final battle of the Seven Years' War in North America was fought in 1762 at the Battle of Signal Hill, in which the French surrendered St. John's to a British force under the command of Lt. Colonel William Amherst. Lt. Colonel Amherst renamed what was then known as "The Lookout" as "Signal Hill," because of the signalling that took place upon its summit from its flagmast. Flag communication between land and sea would take place there from the 17th century until 1960.During Signal Hill's first construction period in the late 18th century, Signal Hill was designated as the citadel for St. John's.

                    </p>
                </div>
                <div class="card-action">
                    <a href="getguide.php?id=signalhill">Book a tour</a>
                </div>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="card large">
                <div class="card-image activator waves-effect waves-block waves-light">
                    <img class="activator" src="img/capespear_full.jpg">
                    <span class="card-title">Cape Spear</span>
                </div>
                <div class="card-content">
                    <p>Cape Spear, located on the Avalon Peninsula near St. John's, Newfoundland, is the easternmost
                        point
                        in Canada[1] (52�37'W), and North America, excluding Danish-controlled Greenland.</p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Cape Spear<i class="material-icons right">close</i></span>
                    <p>Cape Spear, located on the Avalon Peninsula near St. John's, Newfoundland, is the easternmost
                        point
                        in Canada[1] (52�37'W), and North America, excluding Danish-controlled Greenland.Cape Spear
                        is
                        within the municipal boundaries of the city of St. John's, located about 2 miles (3.2 km)
                        from
                        Blackhead, an amalgamated area of St. John's</p>
                </div>
                <div class="card-action">
                    <a href="getguide.php?id=capespear">Book a tour</a>
                </div>
            </div>
        </div>


        <div class="col s12 m4">
            <div class="card large">
                <div class="card-image activator waves-effect waves-block waves-light">
                    <img class="activator" src="img/Johnson_Geo_Centre.jpg">
                    <span class="card-title">Johnson Geo Center</span>
                </div>
                <div class="card-content">
                    <p>The Johnson Geo Centre is a geological interpretation centre located on Signal Hill in St.
                        John's,
                        Newfoundland and Labrador, Canada.
                    </p></div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Johnson Geo Center<i class="material-icons right">close</i></span>
                    <p>The Johnson Geo Centre is a geological interpretation centre located on Signal Hill in St.
                        John's,
                        Newfoundland and Labrador, Canada. Most of the centre is located underground, in an excavated
                        glacial formation that shows the exposed bedrock of the hill. The museum is named for
                        philanthropist
                        Paul Johnson and opened in 2002.</p>
                </div>
                <div class="card-action">
                    <a href="getguide.php?id=geo">Book a tour</a>
                </div>
            </div>
        </div>
    </div>


</div>



