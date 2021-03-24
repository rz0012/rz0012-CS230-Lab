<?php

$servename = "localhost";
$DBuname = "phpmyadmin";
#password for aws
$DBPass = "cs230lab";  #$DBPass = "Hexacore1234";
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

