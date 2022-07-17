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
    for ($i=0; $i <= $j; $i++) { 
        $sql="INSERT INTO goals_info(username,goal,time1,date_modified,flag) VALUES(?,?,?,NOW(),1);";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../form.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sss",$usname,$works[$i],$time[$i]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: ../index.php");
?>