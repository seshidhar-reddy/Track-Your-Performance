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
        .flexx1{
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .s1{
            padding-top : 10%;
            padding-left : 10%;
            margin : auto 20%;
            width : 50%;
        }
        header,h1{
            padding: 1.5% 1% ;
            padding-bottom : 4%;
            text-align: center;
            border-radius: 10px;
        }
        header h1,h1{
            font-weight: bold;
            color: rgb(12, 58, 58);
            font-family: 'Permanent Marker', cursive;
        }
        .s2{
            text-align : center;
        }
    </style>
</head>
<body>
    <form action="includes/login.inc.php" method="post">
    <div class = "s1">
    <header>
        <h1>Login</h1>
    </header>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Username/Email</span>
        <input type="text" class="form-control" placeholder="" name="uid" aria-label="uid" aria-describedby="addon-wrapping" >
    </div>
    <br>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Password</span>
        <input type="password" class="form-control" placeholder="" name="pwd" aria-label="pwd" aria-describedby="addon-wrapping" >
    </div>
    <br>
    <div class = "s2">
        <h5>Don't Have an Account,<a href="signup.php">Sign Up</a></h5>
    </div>
    <br>
    <div class="flexx1">
        <button type="submit" class="btn btn-dark" name="submit">Login</button>
    </div>
    </div>
    </form>
</body>
</html>