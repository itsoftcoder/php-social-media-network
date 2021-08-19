<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My social network</title>
    <link href="styles/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="styles/css/fonts.css" type="text/css" rel="stylesheet">

    <script src="styles/js/jquery.min.js" type="text/javascript"></script>
    <script src="styles/js/popper.js" type="text/javascript"></script>
    <script src="styles/js/bootstrap.min.js" type="text/javascript"></script>

    <style>
        body{
            overflow-x:hidden ;
        }
        #centered1{
            position: absolute;
            font-size: 10vw;
            top: 35%;
            left: 30%;
            transform: translate(-50%, -50%);
        }
        #centered2{
            position: absolute;
            font-size: 10vw;
            top: 60%;
            left: 40%;
            transform: translate(-50%, -50%);
        }
        #centered3{
            position: absolute;
            font-size: 10vw;
            top: 80%;
            left: 30%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
<div class="container-fluid">

    <div class="row text-center text-white" style="background: rgba(14,15,103,0.70)">
        <div class="col-sm-12">
                <h3 class="p-4">Social Network</h3>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-6">
            <img src="images/social_network.jpg" class="rounded img-fluid" style="width: 650px; height: 550px">

            <div class="centered" id="centered1"><h4 class="text-white"><i class="fa fa-search"></i>  Follow for intested you </h4></div>
            <div class="centered" id="centered2"><h4 class="text-white"><i class="fa fa-search"></i>  Hear What people are taking about </h4></div>
            <div class="centered" id="centered3"><h4 class="text-white"><i class="fa fa-search"></i>  Join The Conversions </h4></div>

        </div>

        <div class="col-sm-6 text-center mt-2">
            <img src="images/social_network.png" style="width: 80px;height:  80px;">
            <br>
            <hr>
            <h4>See what heppning in the world right now</h4>
            <br>
            <h4>Join my social network</h4>
            <hr>

            <div class="mb-5 p-3">
                <form method="post" action="">
                    <button id="login" class="btn btn-sm btn-success w-100 rounded" name="login">Login</button>
                </form>
                <?php
                if (isset($_POST['login'])){
                    echo "<script>window.open('login.php','_self');</script>";
                }
                ?>
            </div>

            <hr>

            <div class="p-3">
                <form method="post" action="">
                    <button id="signup" class="btn btn-sm btn-success w-100 rounded" name="signup">Registration</button>
                </form>
                <?php
                if (isset($_POST['signup'])){
                    echo "<script>window.open('registration.php','_self')</script>";
                }
                ?>
            </div>

        </div>
    </div>
</div>
</body>
</html>