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
    </style>
</head>
<body>
    <form action="includes/signup.inc.php" method="post">
    <div class = "s1">
    <header>
        <h1>SignUp</h1>
    </header>
    <br>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Username</span>
        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="addon-wrapping" name="uid">
    </div>
    <br>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Email</span>
        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="addon-wrapping" name="email">
    </div>
    <br>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Password</span>
        <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="addon-wrapping" name="pwd">
    </div>
    <br>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Confirm Password</span>
        <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="addon-wrapping" name="confirm-pwd">
    </div>
    <br>
    <div class="flexx1">
        <button type="submit" class="btn btn-dark" name="submit">Sign Up</button>
    </div>
    </div>
    </form>
</body>
</html>