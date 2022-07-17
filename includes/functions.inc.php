<?php
session_start();
function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}
function invalidusername($conn,$username,$mail){
    $sql = "SELECT * FROM user_info WHERE USERNAME=? OR EMAIL=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$username,$mail);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)){
        return $row;
    }
    else{
        return false;
    }
}
function createuser($conn,$mail,$username,$password){
    $sql="INSERT INTO user_info(USERNAME,EMAIL,PWD) VALUES(?,?,?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sss",$username,$mail,$password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $sql1="CREATE TABLE $username(ID INT AUTO_INCREMENT PRIMARY KEY,GOAL VARCHAR(40) NOT NULL,D DATE NOT NULL,T INT NOT NULL,date_changed datetime NOT NULL);";
    if ($conn->query($sql1) === TRUE) {}
    else {
        header("Location: ../signup.php?error=stmtfailed");
      }
    $_SESSION["username"] = $username;
    header("Location: ../form.php");
    exit();
}