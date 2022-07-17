<?php
    if(isset($_POST["submit"])){
        $username=$_POST["uid"];
        $password=$_POST["pwd"];
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';
        if(!invalidusername($conn,$username,$username)){
            header("Location: ../login.php?error=invalid username");
            exit();
        }
        else{
            $row = invalidusername($conn,$username,$username);
            $pwd = $row["PWD"];
            $checkpad = false;
            if($pwd == $password){
                $checkpad = true;
            }
            if($checkpad === false){
                header("Location: ../login.php?error=invalid password$password $pwd");
                exit();
            }
            else if($checkpad === true){
                session_start();
                $_SESSION["username"] = $username;
                header("Location: ../index.php");
            }
        }
    }
    else{
        header("Location: ../login.php");
        exit();
    }
?>