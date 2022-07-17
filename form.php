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
    <form action="includes/form.inc.php" method="post">
    <?php
    for($i=0;$i<50;$i++){
    echo "<div class = 'flexx' id ='works$i'>";
        echo "<div class='input-group flex-nowrap' style='width:30%;'>
            <span class='input-group-text' id='addon-wrapping'>Goal</span>
            <input type='text' class='form-control' name = 'works$i' placeholder='Goal Name' aria-label='Username' aria-describedby='addon-wrapping'>
        </div>";
        echo "<div class='input-group flex-nowrap' style='width:30%;'>
            <span class='input-group-text' id='addon-wrapping'>Time</span>
            <input type='text' class='form-control' name = 'time$i' placeholder='Time Alloted in Hrs' aria-label='Username' aria-describedby='addon-wrapping'>
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
</body>
<script>
    var i;
    for (i = 5;i<50;i++){
        var works=document.querySelector('#works'+i);
        works.style.display= "none";
    }
    i=5;
    function add_work(){
        var works=document.querySelector('#works'+i);
        works.style.display= "flex";
        i++;
    }
</script>
</html>