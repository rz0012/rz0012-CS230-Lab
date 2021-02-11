<?php

function SQLInjectionCheck(){   
    header("Location: ../signup.php?error=SQLInjection");
    exit();    
}

function duplicityCheck($stmt, $name){

    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    return mysqli_stmt_num_rows($stmt);
}

function pass_complexity($passw,$passw_rep){

    if(strlen($passw) < 8){
        echo '<script>
                alert("Please rewrite your password with length 8 or more.");
                window.history.go(-1);
                </script>';
        exit();
    }
    if(!preg_match("#[0-9]+#",$passw)){
        echo '<script>
                alert("Password must contain at least one integer number.");
                window.history.go(-1);
                </script>';
        exit();
    }

    if(!preg_match("#[a-z]+#",$passw)){
        echo '<script>
                alert("Password must contain at least one small case english alphabet.");
                window.history.go(-1);
                </script>';
        exit();
    }
    if(!preg_match("#[A-Z]+#",$passw)){
        echo '<script>
                alert("Password must contain at least one capital english alphabet.");
                window.history.go(-1);
                </script>';
        exit();
    }
    if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $passw)){
        echo '<script>
                alert("Password must contain at least one special case.");
                window.history.go(-1);
                </script>';
        exit();
    }

}

if(isset($_POST['signup-submit'])){
    require 'dbhandler.php';
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $passw = $_POST['pwd'];
    $passw_rep = $_POST['con-pwd'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    pass_complexity($passw,$passw_rep);

    if($passw !== $passw_rep){
        header("Location: ../signup.php?error=diffPasswords");
        exit();
    }

    else{
        
        

        $sql = "SELECT uname FROM users WHERE uname=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            SQLInjectionCheck();
        }

        else{
            /*mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $check = mysqli_stmt_num_rows($stmt);
                */
            $check_un = duplicityCheck($stmt, $username);
            
            if($check_un > 0){
                header("Location: ../signup.php?error=UsernameTaken");
                exit();
            }
            else{

                $sql = "SELECT email FROM users WHERE email=?";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql)){
                    SQLInjectionCheck();
                }
                else{
                    $check_email = duplicityCheck($stmt, $email);
                
                    if($check_email > 0){
                        header("Location: ../signup.php?error=EmailTaken");
                        exit();
                    }
                    else{
                        $sql = "INSERT INTO users (lname,fname,email,uname,password) VALUES (?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        
                        if(!mysqli_stmt_prepare($stmt,$sql)){
                            SQLInjectionCheck();
                        }

                        else{
                            $hashed = password_hash($passw,PASSWORD_BCRYPT);
                            mysqli_stmt_bind_param($stmt, "sssss", $lname,$fname,$email,$username,$hashed);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);

                            $sqlImg = "INSERT INTO profiles (uname, fname) VALUES ('$username','$fname')";
                            mysqli_query($conn, $sqlImg);

                            header("Location: ../signup.php?signup=success");
                            exit();

                        }
            }
        }
        } 
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }
}

else{
    header("Location: ../signup.php");
    exit();
}

?>