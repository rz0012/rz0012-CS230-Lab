<?php
namespace App;

class gallery_helper{

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

    public function SQLInjectionCheck(){   
        header("Location: ../admin.php?error=SQLInjection");
        exit();    
    }


}

require 'dbhandler.php';
session_start();
if(isset($_POST['gallery-submit'])){
    
    $file = $_FILES['gallery-image'];
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    $title = $_POST['title'];
    $descript = $_POST['descript'];

    $serve = new gallery_helper();
    $fileSizeCheck = $serve->fileSizeCheck($file_size);
    $fileTypeCheck = $serve->fileTypeCheck($file);
    $fileErrorCheck = $serve->fileErrorCheck($file['error']);

    if ($fileSizeCheck == true && $fileTypeCheck == true && $fileErrorCheck == true){
        
        $ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $new_name = uniqid('',true).".".$ext;
        $destination = '../gallery/'.$new_name;
        $sql = "INSERT INTO gallery (title, descript, picpath) VALUES (?, ?, ?)";
        $stmt =mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            $serve->SQLInjectionCheck();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sss",$title, $descript, $destination);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            move_uploaded_file($file_tmp_name, $destination);
            header("Location: ../admin.php?success=GalleryUpload");
            exit();   
        
        }
        
        
    }
    else{
        header("Location: ../admin.php?error=UploadError_OR_SizeError_OR_TypeError");
        exit();
    }
    
       
}
else{
    header("Location: ../admin.php");
    exit();
}


