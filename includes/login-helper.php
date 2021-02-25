<?php
session_start();
/*
function logoutTologin(){
    echo '
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" name="logout" href="../login.php">Logout</a>
                </li>
            </ul>
        </div>
        ';
    session_destroy();
}*/

function SQLInjectionCheck(){   
    header("Location: ../login.php?error=SQLInjection");
    exit();    
}

function emptyCheck($var){
    if (empty($var)){
        echo '<script>
                alert("The field is empty or it does not match with our database.");
                window.history.go(-1);
                </script>';
        exit();
    }
    else return $var;
}

function session_activition($data){
    
    
    $_SESSION['uid'] = $data['uid'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['fname'] = $data['fname'];
    $_SESSION['lname'] = $data['lname'];
    $_SESSION['uname'] = $data['uname'];

    $uname = $data['uname'];
    $email = $data['email'];
    header("Location: ../profile.php?success=login");  
    exit(); 
    //echo "<h1>Success</h1><p>$uname</p><p>$email</p>";

    //logoutTologin();
}

if(isset($_POST['Login-submit'])){
    require 'dbhandler.php';

    $uname = emptyCheck($_POST['uname']);
    $email = emptyCheck($_POST['email']);
    $passw = emptyCheck($_POST['pwd']);

    $sql = "SELECT * FROM users WHERE uname=? AND email=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        SQLInjectionCheck();
    }
    else{
        mysqli_stmt_bind_param($stmt,"ss",$uname,$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = emptyCheck(mysqli_fetch_assoc($result));

        $pass_check = password_verify($passw, $data['password']);
        if($pass_check == true){
            session_activition($data);              
        }
        else{
            header("Location: ../login.php?error=WrongPass");
            exit();
        }
        
    }
}
else{
    header("Location: ../login.php");
    exit();
}