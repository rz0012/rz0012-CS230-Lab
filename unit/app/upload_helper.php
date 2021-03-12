<?php
namespace App;

class upload_helper{

    public function fileFinderCheck($file){
       return file_exists($file);
    }

    public function fileSizeCheck($file_size){
        
        $KB = 1024;
        $MB = 1048576;
        //fidene('KB',1024);
        //define('MB',1048576);

        if($file_size > 10*$MB){
            return false;
        }
        else return true;
        
    }

    public function fileTypeCheck($file){

        $ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));

        $allowed = array('jpg','jpeg','png','svg','tif','tiff', 'gif');

        if(!in_array($ext,$allowed)){
            return false;
        }
        return true;
    }

    public function fileErrorCheck($file_error){
        if ($file_error != 0){
            
            return false;
        }
        else return true;
    }


}

require 'dbhandler.php';
session_start();
if(isset($_POST['prof-submit'])){
    
    $uname = $_SESSION['uname'];
    $file = $_FILES['prof-image'];
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    $serve = new upload_helper();
    $fileSizeCheck = $serve->fileSizeCheck($file_size);
    $fileTypeCheck = $serve->fileTypeCheck($file);
    $fileErrorCheck = $serve->fileErrorCheck($file['error']);

    if ($fileSizeCheck == true && $fileTypeCheck == true && $fileErrorCheck == true){
        $ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $new_name = uniqid('',true).".".$ext;
        $destination = '../profiles/'.$new_name;
        $sql = "UPDATE profiles SET profpic='$destination' WHERE uname='$uname'";
        mysqli_query($conn, $sql);
        move_uploaded_file($file_tmp_name, $destination);
        header("Location: ../profile.php?success=UploadedWin");
        exit();   
        
    }
    else{
        header("Location: ../profile.php?error=UploadErrorORSizeErrorORTypeError");
        exit();
    }
    
       
}
else{
    header("Location: ../profile.php");
    exit();
}


