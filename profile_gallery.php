
<?php
require 'includes/header.php';

echo "<main>

<h3>This contains all the images that have been uploaded to the profile by the user</h3>";
    $files = scandir('profiles/');
    foreach($files as $file) {
        if($file !== "." && $file !== "..") {
            echo "
            
            <link rel='stylesheet' href='css/gallery.css'>
            <img src='profiles/$file' />
            
            ";
        }
    }

echo "</main>";
?>