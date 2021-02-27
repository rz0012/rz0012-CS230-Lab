<?php

class profileTest extends \PHPUnit\Framework\TestCase
{
   
    public function testFile()
    {
        $data = array(
            'file'=>'../../app/pictures/default.jpg',
        );
        
        $file= new \App\upload_helper;
        
        $this->assertTrue($file->fileFinderCheck($data['file']));
        
    }

    public function testFileSize(){
        $data = array(
            'file'=>2097152,
        );
        
        $file= new \App\upload_helper;
        
        $this->assertTrue($file->fileSizeCheck($data['file']));
        
    }

    public function testFileType(){
        $data = array(
            'name'=>'../../app/pictures/default.jpg',
        );
        
        $file= new \App\upload_helper;
        
        $this->assertTrue($file->fileTypeCheck($data));
        
    }

}