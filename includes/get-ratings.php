<?php 

include 'dbhandler.php';

$id = $_GET['id'];
$sqlAvg = "SELECT AVG(ratingnum) AS AVGRATE FROM reviews WHERE itemid='$id'";
$sqlCount = "SELECT count(ratingnum) AS Total FROM reviews WHERE itemid='$id'";

$query = mysqli_query($conn, $sqlAvg);
$query2 = mysqli_query($conn, $sqlCount);

$row = mysqli_fetch_array($query);
$row2 = mysqli_fetch_array($query2);

$avg = round($row['AVGRATE'],1);


#item being reviewed
$sql_item ="SELECT * FROM gallery WHERE pid='$id'";
$query_item = mysqli_query($conn,$sql_item);
$array_item = mysqli_fetch_array($query_item);

echo'<link rel="stylesheet" href="./css/review.css">
    <div class="container" style="text-align: center;">
        <h1>'.$avg.'</h1>
        <img src="./gallery/'.$array_item["picpath"].'">
        <h3 class="item_font">'.$array_item["title"].'</h3>
        <p class="item_font">'.$array_item["descript"].'</p>
        <div class="container" style="margin-bottom: 10px;">'.stars($avg).'</div>
        <p>Number of Ratings: '.round($row2['Total'],1).'</p>
    </div>';

function stars($av){
    $s = "";
    if ($av == 0) {
        for ($i=0; $i < 5; $i++) { 
            $s .= '<i class="fa fa-star fa-2x" style="color:grey"></i>';
        }  
    }
    for ($i=0; $i < floor($av); $i++) { 
        $s .= '<i class="fa fa-star fa-2x" style="color:goldenrod"></i>';
    }
    if (($av - floor($av)) > 0.4) {
        $s .= '<i class="fas fa-star-half fa-2x" style="color:goldenrod"></i>';
    }
    return $s;
}