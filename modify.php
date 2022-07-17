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
    <style>
        body{
            background-color: white;
            padding : 2%;
        }
        header,h1{
            padding: 1.25% 1% ;
            text-align: center;
            border-radius: 10px;
        }
        header h1,h1{
            font-weight: bold;
            color: rgb(12, 58, 58);
            font-family: 'Permanent Marker', cursive;
        }
        .flexx{
            padding: 0.5%;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        .flexx1{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Add Goals</h1>
    </header>
    <form action="includes/modify.inc.php" method="post">
    <?php
    for($i=0;$i<50;$i++){
    echo "<div class = 'flexx' id ='works$i'>";
        echo "<div class='input-group flex-nowrap' style='width:30%;'>
            <span class='input-group-text' id='addon-wrapping'>Goal</span>
            <input type='text' class='form-control' id = 'w$i' name = 'works$i' placeholder='Goal Name' aria-label='Username' aria-describedby='addon-wrapping'>
        </div>";
        echo "<div class='input-group flex-nowrap' style='width:30%;'>
            <span class='input-group-text' id='addon-wrapping'>Time</span>
            <input type='text' class='form-control' id = 't$i' name = 'time$i' placeholder='Time Alloted in Hrs' aria-label='Username' aria-describedby='addon-wrapping'>
        </div>";
        echo "<br>";
        echo "<br>";
    echo "</div>";
    }
    ?>
    <br>
    <br>
    <div class="flexx1">
        <button type="button" class="btn btn-dark" onclick = add_work()>Add another Goal</button>
        <button type="submit" class="btn btn-dark">Submit</button>
    </div>
    </form>
<?php
            require_once 'includes/dbh.inc.php';
            require_once 'includes/dbh.inc.php';
            $goals = array();
            $times = array();
            $sql1 = "SELECT GOAL FROM goals_info where username = ? and flag IN (select MAX(flag) from goals_info where goals_info.username = ?);";
            $stmt1 = mysqli_stmt_init($conn);                       
            if(!mysqli_stmt_prepare($stmt1,$sql1)){
                header("Location: ../index.php?error=stmtfailed1");
                exit();
            }
            mysqli_stmt_bind_param($stmt1,"ss",$_SESSION["username"],$_SESSION["username"]);
            mysqli_stmt_execute($stmt1);
            $result1 = mysqli_stmt_get_result($stmt1);
            if ($result1 != false) {
            while($row1 = mysqli_fetch_assoc($result1)){
            $sum11 = 0;
            $sql = "SELECT goals_info.time1,goals_info.goal from goals_info WHERE goals_info.username=? AND goals_info.goal = ? and flag IN (select MAX(flag) from goals_info where goals_info.username = ?);";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../index.php?error=stmtfailed1");
                exit();
            }
            mysqli_stmt_bind_param($stmt,"sss",$_SESSION["username"],$row1['GOAL'],$_SESSION["username"]);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                array_push($goals,$row['goal']);
                array_push($times,$row['time1']);
            }
        }
    }
?>
<script>
    var i;
    var gls = <?php echo json_encode($goals); ?>;
    var tms = <?php echo json_encode($times); ?>;
    for (i = 0;i<50;i++){
        var works=document.querySelector('#works'+i);
        works.style.display= "none";
    }
    var flag = 0;
    gls.forEach(element => {
        var works=document.querySelector('#works'+flag);
        works.style.display= "flex";
        document.getElementById('w'+flag).value = element;
        flag++;
    });
    flag = 0;
    tms.forEach(element => {
        var works=document.querySelector('#works'+flag);
        works.style.display= "flex";
        document.getElementById('t'+flag).value = element;
        flag++;
    });
    function add_work(){
        var works=document.querySelector('#works'+flag);
        works.style.display= "flex";
        flag++;
    }
</script>
</body>
</html>