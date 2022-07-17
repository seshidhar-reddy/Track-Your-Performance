<?php
    include_once 'dbh.inc.php';
    session_start();
    $usname = $_SESSION["username"];
    $works = array();
    for($i = 0;$i<50;$i++){
        array_push($works,$_POST['works'.$i]);
    }
    $j = 0;
    foreach ($works as $w) {
        if ($w == "") {
            break;
        }
        $j++;
    }
    $time = array();
    for($i = 0;$i<50;$i++){
        array_push($time,$_POST['time'.$i]);
    }
    array_splice($time,$j,50-$j);
    array_splice($works,$j,50-$j);
    $sql3 = "SELECT MAX(flag) as f_max from goals_info where username = ?;";
    $stmt3 = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt3,$sql3)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt3,"s",$_SESSION["username"]);
    mysqli_stmt_execute($stmt3);
    $result3=mysqli_stmt_get_result($stmt3);
    $row3 = mysqli_fetch_assoc($result3);
    $wer = $row3['f_max']+1;
    for ($i=0; $i <= $j; $i++) { 
        $sql="INSERT INTO goals_info(username,goal,time1,date_modified,flag) VALUES(?,?,?,NOW(),$wer);";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../modify.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sss",$usname,$works[$i],$time[$i]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: ../index.php");
?>