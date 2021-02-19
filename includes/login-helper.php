<?php

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
}
function SQLInjectionCheck(){   
    header("Location: ../login.php?error=SQLInjection");
    exit();    
}

if(isset($_POST['Login-submit'])){
    require 'dbhandler.php';

    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $passw = $_POST['pwd'];

    if (empty($uname) || empty($email) || empty($passw)){
        header("Location: ../login.php?error=EmptyField");
        exit();
    }

    $sql = "SELECT * FROM users WHERE uname=? AND email=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        SQLInjectionCheck();
    }
    else{
        mysqli_stmt_bind_param($stmt,"ss",$uname,$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);

        if (empty($data)){
            header("Location: ../login.php?error:User_OR_email_DNE");
            exit();
        }
        else{
            $pass_check = password_verify($passw, $data['password']);
            if($pass_check == true){
                session_start();
                $_SESSION['uid'] = $data['uid'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['fname'] = $data['fname'];
                $_SESSION['lname'] = $data['lname'];

                echo "<h1>Success</h1><p>$uname</p><p>$email</p>";
                logoutTologin();
                
            }
            else{
                header("Location: ../login.php?error=WrongPass");
                exit();
            }
        }
    }
}

else{
    header("Location: ../login.php");
    exit();
}