<!DOCTYPE html>
<?php
session_start();
include ('includes/connection.php');
if (isset($_POST['login'])){
    $email = htmlentities(mysqli_real_escape_string($conn,trim($_POST['email'])));
    $pass = htmlentities(mysqli_real_escape_string($conn,trim($_POST['pass'])));

    $check = "SELECT * FROM users WHERE email = '$email' AND pass='$pass' AND status='verified'";

    $query = mysqli_query($conn,$check);

    if (mysqli_num_rows($query) == 1){
        $_SESSION['username'] = $email;
        header('location:home.php');
    }else {
        echo "<script>alert('Your email and password is wrong please try again');</script>";
        echo "<script>window.open('login.php','_self');</script>";
    }


}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login page | social network</title>
    <link href="styles/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="styles/css/fonts.css" type="text/css" rel="stylesheet">

    <script src="styles/js/jquery.min.js" type="text/javascript"></script>
    <script src="styles/js/popper.js" type="text/javascript"></script>
    <script src="styles/js/bootstrap.min.js" type="text/javascript"></script>
    <style>
        body{
            overflow-x: hidden;
        }
        .overlap_text{
            position: relative;
        }

        .overlap_text a{
            position: absolute;
            top: 8px;
            right: 20px;
            font-size: 12px;
            text-decoration: none;
            letter-spacing: -1px;
        }
        .overlap_text a:hover{
            color: #1c7430;
            font-weight: bold;
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

    <div class="row mt-2">
        <div class="offset-sm-2 col-sm-8 offset-sm-2">
            <div class="card">
                <div class="card-header">
                    Login below
                </div>

                <div class="card-body">

                    <form action="" method="post">

                        <div class="form-group row">
                            <label class="col-sm-3">Email Address </label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Password </label>
                            <div class="input-group col-sm-9 overlap_text">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>

                                <input type="password" name="pass" class="form-control"><br>
                                    <a href="forget_password.php" style="text-decoration: none; float: right;">Forget Password</a>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <input type="submit" name="login" class="btn btn-sm btn-success w-50" value="Login"><br>
                            </div>
                        </div>

                    </form>



                </div>

                <div class="card-footer">
                    <div class="clearfix">
                        <p class="float-left">Today :
                            <?php
                             echo date('d-m-Y h:i:s');
                            ?>
                        </p>
                        <a href="registration.php" class="float-right">Create A New Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 p-4" style="background: #1c7430;">
        <div class="col-md-12 text-center text-white">
            <p>@copy right alamin hossain 2019</p>
        </div>
    </div>
</div>
</body>
</html>
