<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        *{
            padding: 0%;
            margin: 0%;
            box-sizing: border-box;
        }
        body{
            margin: 1%;
        }
        .flexx{
            padding: 0.5%;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        header,h1{
            background-color: #242424;
            padding: 1.25% 1% ;
            text-align: center;
            border-radius: 10px;
        }
        header h1,h1{
            color: rgb(237,211,130);
            font-family: 'Permanent Marker', cursive;
        }
        nav{
            background-color: #242424;
            padding: 1.5% 1%;
            margin-top: 1%;
            margin-bottom: 1%;
            border-radius: 10px;
        }
        nav a{
            color: rgb(237,211,130);
            text-decoration: none;
            padding: 3%;
            font-family: 'Fredoka One', cursive;
            font-size: 125%;
        }
        nav a:hover{
            color: burlywood;
        }
        .s1{
            padding: 2%;
            margin: 1%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Trackify</h1>
    </header>
    <nav>
        <a href="add.php">Add Today Activities</a>
        <a href="modify.php">Modify Goals</a>
        <?php
        if(isset($_SESSION["username"])){
            echo "<a href='includes/logout.inc.php'>Log Out</a>";
        }
        else{
            echo "<a href='index.php'>Log In</a>";
        }
        ?>
    </nav>
    <div style="">
        <canvas id="myChart"></canvas>
    </div>
    <br>
    <div class = "flexx">
        <?php
        require_once 'includes/dbh.inc.php';
        $sql = "SELECT goal from goals_info where username=? and flag IN (SELECT MAX(flag) from goals_info where username = ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php?error=stmtfailed187");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ss",$_SESSION["username"],$_SESSION["username"]);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $r =0;
        while($row = mysqli_fetch_assoc($result)){
            echo '<div class="s1">
            <div class="card" style="width: 18rem;">
            <div class="card-body">
            <canvas id="chart'.$r.'"></canvas>
            <h4 class="card-title">'.$row["goal"].'</h4>';
            $sum = 0;
            $sum1 = 0;
            $qw = 0;
                $sql1 = "SELECT T,date_changed FROM ".$_SESSION["username"]." WHERE GOAL = ?;";
                $stmt1 = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt1,$sql1)){
                    header("Location: ../index.php?error=stmtfailed1");
                    exit();
                }
                mysqli_stmt_bind_param($stmt1,"s",$row['goal']);
                mysqli_stmt_execute($stmt1);
                $result1=mysqli_stmt_get_result($stmt1);
                while($row1 = mysqli_fetch_assoc($result1)){
                    $sum = $sum + $row1['T'];
                    $sql12 = "SELECT goals_info.time1,goals_info.goal from goals_info WHERE goals_info.username=? AND goals_info.goal = ? AND goals_info.date_modified IN( SELECT MAX(goals_info.date_modified) FROM goals_info INNER JOIN ".$_SESSION["username"]." ON ".$_SESSION["username"].".GOAL = ? AND goals_info.goal = ? AND goals_info.date_modified < ?);";
                    $stmt12 = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt12,$sql12)){
                        header("Location: ../index.php?error=stmtfailed111");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt12,"sssss",$_SESSION["username"],$row['goal'],$row['goal'],$row['goal'],$row1['date_changed']);
                    mysqli_stmt_execute($stmt12);
                    $result12=mysqli_stmt_get_result($stmt12);
                    while($row12 = mysqli_fetch_assoc($result12)){
                        $sum1 = $sum1 + $row12['time1'];
                    }
                }
                if($sum1 != 0){
                    $qw = ($sum/$sum1)*10;
                }
                echo '<h6 class="card-subtitle mb-2 text-muted">Total Progress: '.$qw.'</h6>';
                $sql4 = "SELECT T,date_changed FROM ".$_SESSION["username"]." WHERE Goal = ? AND D = (SELECT MAX(D) FROM ".$_SESSION["username"].");";
                $stmt4 = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt4,$sql4)){
                    header("Location: ../index.php?error=stmtfailed1234");
                    exit();
                }
                mysqli_stmt_bind_param($stmt4,"s",$row["goal"]);
                mysqli_stmt_execute($stmt4);
                $result4=mysqli_stmt_get_result($stmt4);
                $su = 0;
                $su1 = 0;
                $qwer = 0;
                while($row4 = mysqli_fetch_assoc($result4)){
                    $su = $su + $row4['T'];
                    $sql5 = "SELECT goals_info.time1,goals_info.goal from goals_info WHERE goals_info.username=? AND goals_info.goal = ? AND goals_info.date_modified IN( SELECT MAX(goals_info.date_modified) FROM goals_info INNER JOIN ".$_SESSION["username"]." ON ".$_SESSION["username"].".GOAL = ? AND ".$_SESSION["username"].".D = (SELECT MAX(D) FROM ".$_SESSION["username"].") AND goals_info.goal = ? AND goals_info.date_modified < ?);";
                    $stmt5 = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt5,$sql5)){
                        header("Location: ../index.php?error=stmtfailed1");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt5,"sssss",$_SESSION["username"],$row['goal'],$row['goal'],$row['goal'],$row4['date_changed']);
                    mysqli_stmt_execute($stmt5);
                    $result5=mysqli_stmt_get_result($stmt5);
                    while($row5 = mysqli_fetch_assoc($result5)){
                        $su1 = $su1 + $row5['time1'];
                    }
                }
                if($su1 != 0){
                    $qwer = ($su/$su1)*10;
                }
                echo '<h6 class="card-subtitle mb-2 text-muted">Today Progress: '.$qwer.'</h6>';
            echo '</div>
            </div>
            </div>';
            $r++;
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
                $ar = array();
                $qregh = array();
                $sql11 = "SELECT DISTINCT D FROM ".$_SESSION["username"]." ORDER BY D ASC;";
                $result11 = $conn->query($sql11);
                while($row11 = $result11->fetch_assoc()){
                $sum = 0;
                $sum1 = 0;
                $sql1 = "SELECT DISTINCT D,GOAL FROM ".$_SESSION["username"]." WHERE D = ? ORDER BY D ASC;";
                $stmt1 = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt1,$sql1)){
                    header("Location: ../index.php?error=stmtfailed1");
                    exit();
                }
                mysqli_stmt_bind_param($stmt1,"s",$row11['D']);
                mysqli_stmt_execute($stmt1);
                $result1=mysqli_stmt_get_result($stmt1);
                while($row1 = $result1->fetch_assoc()){
                $sql = "SELECT goals_info.time1,goals_info.goal from goals_info WHERE goals_info.username=? AND goals_info.goal = ? AND goals_info.date_modified IN( SELECT MAX(goals_info.date_modified) FROM goals_info INNER JOIN ".$_SESSION["username"]." ON ".$_SESSION["username"].".D = ? AND ".$_SESSION["username"].".GOAL = ? AND goals_info.goal = ? AND goals_info.date_modified < ".$_SESSION["username"].".date_changed);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../index.php?error=stmtfailed1");
                    exit();
                }
                mysqli_stmt_bind_param($stmt,"sssss",$_SESSION["username"],$row1['GOAL'],$row1['D'],$row1['GOAL'],$row1['GOAL']);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    $sum1 = $sum1 + $row['time1'];
                }
                $sql2 = "SELECT T FROM ".$_SESSION["username"]." WHERE D = ? AND GOAL = ?;";
                $stmt2 = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt2,$sql2)){
                    header("Location: ../index.php?error=stmtfailed1");
                    exit();
                }
                mysqli_stmt_bind_param($stmt2,"ss",$row1['D'],$row1['GOAL']);
                mysqli_stmt_execute($stmt2);
                $result2=mysqli_stmt_get_result($stmt2);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $sum = $sum + $row2['T'];
                }
            }
                    $qw = ($sum/$sum1)*10;
                    array_push($ar,$qw);
                    array_push($qregh,$row11['D']);
                }
                    $res12 = array();
                    $sql100 = "SELECT GOAL,TIME1 FROM goals_info WHERE username = ? and flag IN (SELECT MAX(flag) from goals_info where username = ?);";
                    $stmt100 = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt100,$sql100)){
                        header("Location: ../index.php?error=stmtfailed123");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt100,"ss",$_SESSION["username"],$_SESSION["username"]);
                    mysqli_stmt_execute($stmt100);
                    $result100=mysqli_stmt_get_result($stmt100);
                    while($row100 = mysqli_fetch_assoc($result100)){
                        $ar1 = array();
                        $sql = "SELECT DISTINCT D from ".$_SESSION['username']." WHERE GOAL = ?;";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql)){
                            header("Location: ../index.php?error=stmtfailed12");
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt,"s",$row100['GOAL']);
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                        while($row = mysqli_fetch_assoc($result)){
                            $sum = 0;
                            $sum1 = 0;
                            $sql1 = "SELECT T FROM ".$_SESSION["username"]." WHERE D = ? AND GOAL = ?;";
                            $stmt1 = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt1,$sql1)){
                                header("Location: ../index.php?error=stmtfailed12");
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt1,"ss",$row["D"],$row100["GOAL"]);
                            mysqli_stmt_execute($stmt1);
                            $result1=mysqli_stmt_get_result($stmt1);
                            while($row1 = mysqli_fetch_assoc($result1)){
                                $sum = $sum + $row1['T'];
                            }
                            $sql123 = "SELECT date_changed from ".$_SESSION["username"]." where d = ? AND goal = ?";
                            $stmt123 = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt123,$sql123)){
                                header("Location: ../index.php?error=stmtfailed2");
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt123,"ss",$row['D'],$row100['GOAL']);
                            mysqli_stmt_execute($stmt123);
                            $result123=mysqli_stmt_get_result($stmt123);
                            while($row123 = mysqli_fetch_assoc($result123)){
                            $sql4 = "SELECT goals_info.time1,goals_info.goal from goals_info WHERE goals_info.username=? AND goals_info.goal = ? AND goals_info.date_modified IN( SELECT MAX(goals_info.date_modified) FROM goals_info INNER JOIN ".$_SESSION["username"]." ON ".$_SESSION["username"].".D = ? AND ".$_SESSION["username"].".GOAL = ? AND goals_info.goal = ? AND goals_info.date_modified < ?);";
                            $stmt4 = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt4,$sql4)){
                                header("Location: ../index.php?error=stmtfailed12");
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt4,"ssssss",$_SESSION["username"],$row100['GOAL'],$row['D'],$row100['GOAL'],$row100['GOAL'],$row123['date_changed']);
                            mysqli_stmt_execute($stmt4);
                            $result4=mysqli_stmt_get_result($stmt4);
                            while($row4 = mysqli_fetch_assoc($result4)){
                            $sum1 = $sum1 + $row4['time1'];
                            }
                    }
                            $qw = ($sum/$sum1)*10;
                            array_push($ar1,$qw);
                    }
                    array_push($res12,$ar1);
                    }
    ?>
    <script>
        var passedArray = <?php echo json_encode($ar); ?>;
        var dates = <?php echo json_encode($qregh); ?>;
const CHART = document.getElementById("myChart");
let linechart = new Chart(CHART, {
    type: 'line',
    data: {
        labels: dates,
        datasets: [
          {
            lineTension: 0.1,
            fill:true,
            label: 'Your Progress',
            backgroundColor: 'rgb(222,184,135,0.4)',
            borderColor: 'rgb(222,184,135,2)',
            pointBorderColor: 'rgb(222,184,135,100)',
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            data: passedArray,
          }
        ]
      },
      options: {
      scales: {
          y: {  
             min: 0
             }
          },
  }
});
var passedArray1 = <?php echo json_encode($res12); ?>;
var CHART1 = new Array(passedArray1.length);
for(var i=0;i<passedArray1.length;i++){
    CHART1[i] = document.getElementById("chart"+i);
    let linechart1 = new Chart(CHART1[i], {
    type: 'line',
    data: {
        labels: dates,
        datasets: [
          {
            lineTension: 0.1,
            fill:true,
            label: 'Your Progress',
            backgroundColor: 'rgb(237,211,130,0.2)',
            borderColor: 'rgb(237,211,130)',
            pointBorderColor: 'rgb(237,211,130)',
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            data: passedArray1[i],
          }
        ]
      },
      options: {
      scales: {
          y: {  
             min: 0
             }
          },
  }
});
}
    </script>
</body>
</html>