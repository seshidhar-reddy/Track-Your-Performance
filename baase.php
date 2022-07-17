<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
                require_once 'includes/dbh.inc.php';
                $sql1 = "SELECT DISTINCT GOAL FROM goals_info;";
                $result1 = $conn->query($sql1);
                if ($result1 != false AND $result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()){
                $sum11 = 0;
                $sql = "SELECT goals_info.time1,goals_info.goal from goals_info WHERE goals_info.username=? AND goals_info.goal = ? AND goals_info.date_modified IN( SELECT MAX(goals_info.date_modified) FROM goals_info where goals_info.goal = ?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../index.php?error=stmtfailed1");
                    exit();
                }
                mysqli_stmt_bind_param($stmt,"sss",$_SESSION["username"],$row1['GOAL'],$row1['GOAL']);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    
                }
            }
        }
    ?>
</body>
</html>
