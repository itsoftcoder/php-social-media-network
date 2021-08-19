<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgotten password</title>
    <link href="styles/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="styles/css/fonts.css" type="text/css" rel="stylesheet">

    <script src="styles/js/jquery.min.js" type="text/javascript"></script>
    <script src="styles/js/popper.js" type="text/javascript"></script>
    <script src="styles/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 text-white text-center bg-success p-4">
            <h4>Social Network</h4>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h5 class="text-white text-center p-2 bg-secondary mb-2">Change password</h5>
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-md-3">Your New Password :</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="pass" placeholder="Enter your new Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Re-write Your password : </label>
                    <div class="col-md-9">
                        <input type="text" name="c_pass" class="form-control" placeholder="Enter Confirm password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <input type="submit" name="change" class="btn btn-sm btn-success w-50">
                    </div>
                </div>
            </form>

            <?php
            session_start();
            if (isset($_SESSION['username'])){
                $email = $_SESSION['username'];
            }
            $con = mysqli_connect("localhost","root","","social_network");
            if (isset($_POST['change'])){
                $pass = htmlentities(mysqli_real_escape_string($con,trim($_POST['pass'])));
                $cpass = htmlentities(mysqli_real_escape_string($con,trim($_POST['c_pass'])));
                if($pass == $cpass){
                    $insert_pass = "UPDATE users SET pass = '$pass' WHERE email = '$email'";
                    $check_user_run = mysqli_query($con,$insert_pass);
                    if ($check_user_run == true){
                        echo "<script>alert('your new password created successfully,you want to login now')</script>";
                        echo "<script>window.open('login.php','_self');</script>";
                    }else{
                        echo "<script>alert('something is problem');</script>";
                        echo "<script>window.open('change_password.php','_self');</script>";
                    }
                }else{
                    echo "<script>alert('your password and confirm password does not match. please try again');</script>";
                }
            }
            ?>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12 text-center text-white bg-success p-4">
            <p>@copy right almin hossain 2019</p>
        </div>
    </div>
</div>
</body>
</html>
