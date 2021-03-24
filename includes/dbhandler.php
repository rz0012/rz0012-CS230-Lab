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

