<?php
require 'header.php';

echo "<main";
    $files = scandir('../profiles/');
    foreach($files as $file) {
        if($file !== "." && $file !== "..") {
            echo "
            
            <link rel='stylesheet' href='../css/gallery.css'>
            <img src='../profiles/$file' />
            
            ";
        }
    }

echo "</main>";
?>