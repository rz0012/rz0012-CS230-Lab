<?php


function rating_star($rate_num){
    if ($rate_num == 1){
        echo '<i class="fa fa-star fa-2x star-rev" data-index="1"></i>';
    }
    else if ($rate_num == 2){
        echo '<i class="fa fa-star fa-2x star-rev" data-index="2"></i>';
    }
    else if ($rate_num == 3){
        echo '<i class="fa fa-star fa-2x star-rev" data-index="3"></i>';
    }
    else if ($rate_num == 4){
        echo '<i class="fa fa-star fa-2x star-rev" data-index="4"></i>';
    }
    else if ($rate_num == 5){
        echo '<i class="fa fa-star fa-2x star-rev" data-index="5"></i>';
    }
    
}
$servename = "localhost";
$DBuname = "phpmyadmin";
$DBPass = "Hexacore1234";
$DBname = "cs230";

$conn = mysqli_connect($servename, $DBuname, $DBPass, $DBname);

if (!$conn) {
    die("Connection failed...".mysqli_connect_error());
    # code...
}
$item = $_GET['id'];
$sql = "SELECT * FROM reviews WHERE itemid='$item'";
$result = mysqli_query($conn, $sql);



if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $uname = $row['uname'];
        $propic = "SELECT profpic FROM profiles WHERE uname='$uname';";
        $res = mysqli_query($conn, $propic);
        $picpath = mysqli_fetch_assoc($res);
        
        echo '<div class="card mx-auto" style="width: 30%; padding: 5px; margin-bottom: 10px;">
                <div class="media">
                    <img class="mr-3" src="'.$picpath['profpic'].'" style="max-width: 150px; max-height: 150px; border-radius: 100%;">
                    <div class="media-body">
                        <h4 class="mt-0">'.$row['uname'].'</h4>
                        <h5 style="color: red;">Rating: '.$row['ratingnum'].' </h5>
                        <p>'.$row['revdate'].'</p>
                        <p>'.$row['reviewtext'].'</p>
                    </div>
                </div>
            </div>';
    }
}
else{
    echo '
    <link rel="stylesheet" href="css/review.css">
    <h5 class="item_font" style="text-align: center;">No reviews, yet! Be the first!!</h5>';
}

