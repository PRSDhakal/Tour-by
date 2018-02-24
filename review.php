<?php
include_once 'navbar.php';
error_reporting(0);
$tourno;
$value;
if (isset($_GET['tour']) && isset($_GET['guide'])) {
    $value = $_GET['guide'];
    $tourno = $_GET['tour'];
}
else{
    $value=$_SESSION['viewValue'];
}
setcookie("guideIdForReview", $value);

?>
<html>
<head>
    <?php //include 'header.php';?>

    <script src="js/getReviews.js">
    </script>

</head>
<body>
<div class="container">
    <h5>Reviews</h5>

    <div id="commentSection">
    </div>
<?php if(isset($_GET['tour'])){
echo'
    <div class="styled-input wide">
          <textarea id="comment"></textarea>

          <label>Write a review</label>

          <span></span></div>
    <button class="button button5" onclick="loadAll(3,'. $tourno.' ); return false;">POST</button>';}?>
</div>
<script>
    loadAll(0, 0);

</script>
</body>
</html>
