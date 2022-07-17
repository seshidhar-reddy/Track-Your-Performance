<?php
        if(isset($_POST["submit"])){
            $mail=$_POST["email"];
            $usname=$_POST["uid"];
            $password=$_POST["pwd"];
            $confirm_password=$_POST["confirm-pwd"];
            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';
            if($password !== $confirm_password){
                header("Location: ../signup.php?error=diff_passwords");
                exit();
            }
            if(invalidEmail($mail)){
                header("Location: ../signup.php?error=invalidemail");
                exit();
            }
            if(invalidusername($conn,$usname,$mail)){
                header("Location: ../signup.php?error=usernameexists");
                exit();
            }
            createuser($conn,$mail,$usname,$password);
        }
        else{
            header("Location: ../signup.php");
        }
    ?>