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
        body{
            margin: auto;
        }
        .qwer{
            padding-left : 15%;
            margin : auto 15%;
            width : 80%;
        }
        .q1{
            margin-bottom : 2%;
        }
        header,h1{
            padding-top: 5%;
            padding-bottom: 2%;
            text-align: center;
            border-radius: 10px;
        }
        header h1,h1{
            font-weight: bold;
            color: rgb(12, 58, 58);
            font-family: 'Permanent Marker', cursive;
        }
        .kj{
            padding-top: 2%;
            padding-left: 25%;
        }
        .flexx{
            display: flex;
            justify-content: center;
            padding-right: 4%;
        }
        .flexx1{
            display: flex;
            justify-content: center;
            padding: 0%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add Today Activities</h1>
    </header>
    <?php
    session_start();
    ?>
    <div class="qwer">
    <?php
        require_once 'includes/dbh.inc.php';
        echo "<form action='includes/add.inc.php' method='post'>";
        $sql1 = "SELECT GOAL FROM goals_info where username = ? and flag IN (SELECT MAX(flag) from goals_info where username = ?);";
        $stmt1 = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt1,$sql1)){
            header("Location: ../index.php?error=stmtfailed1");
            exit();
        }
        mysqli_stmt_bind_param($stmt1,"ss",$_SESSION["username"],$_SESSION["username"]);
        mysqli_stmt_execute($stmt1);
        $result1=mysqli_stmt_get_result($stmt1);
        $i = 0;
        if ($result1 != false) {
        while($row1 = mysqli_fetch_assoc($result1)){
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
            echo "
            <div class='q1'>
            <div class='input-group flex-nowrap' style='width:60%;'>
            <span class='input-group-text' id='addon-wrapping' name='td$i'>".$row['goal']."</span>
            <span class='input-group-text' id='addon-wrapping'>".$row['time1']." Hrs"."</span>
            <input type='text' class='form-control' name = 'tod$i' placeholder='Today Time' aria-label='Username' aria-describedby='addon-wrapping'>
            </div>
            </div>";
            $i++;
        }
    }
}
echo "<div class='kj'>";
echo "<button type='submit' class='btn btn-dark'>Submit</button>";
echo "</div>";
echo "</form>";
    ?>
    </div>
</body>
</html>