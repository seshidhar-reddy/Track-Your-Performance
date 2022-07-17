<?php
    session_start(); 
    $tods = array();
    require_once 'dbh.inc.php';
    $sql1234 = "SELECT * FROM ".$_SESSION["username"]." WHERE D = CURDATE();";
    $stmt1234 = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt1234,$sql1234)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt1234);
    $result1234=mysqli_stmt_get_result($stmt1234);
    if($row1234 = mysqli_fetch_assoc($result1234)){
        header("Location: ../index.php?error=Today_Details_Already_Entered");
        exit();
    }
    $sql = "SELECT goal FROM goals_info WHERE username = ? AND flag IN (SELECT MAX(flag) from goals_info where username = ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$_SESSION["username"],$_SESSION["username"]);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        array_push($tods,$_POST['tod'.$i]);
        $sql1="INSERT INTO ".$_SESSION['username']."(GOAL,D,T,date_changed) VALUES(?,NOW(),?,NOW());";
        $stmt1 = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt1,$sql1)){
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt1,"ss",$row['goal'],$tods[$i]);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);
        $i++;
    }
    $sql2 = "SELECT DISTINCT D FROM ".$_SESSION['username'].";";
    $result2 = $conn->query($sql2);
    $sum = 0;
    while($row2 = mysqli_fetch_assoc($result2)){
        $sum++;
    }
    if($sum>30){
        $sql2 = "DELETE FROM ".$_SESSION['username']." WHERE D IN (SELECT MIN(D) FROM ".$_SESSION['username'].");";
        $result2 = $conn->query($sql2);
    }
    header("Location: ../index.php")
?>