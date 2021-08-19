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
            <h5 class="text-white text-center p-2 bg-secondary mb-2">Forget password</h5>
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-md-3">Your Email :</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email" placeholder="Enter your email">
                    </div>
                </div>
                <label class="text-info">What is your best friend name when you turn on forgotten password :</label>

                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                    <input type="text" name="recovery_name" class="form-control" placeholder="Enter Friend name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <input type="submit" name="check" class="btn btn-sm btn-success w-50">
                    </div>
                </div>
            </form>

            <?php
            session_start();
            $con = mysqli_connect("localhost","root","","social_network");
             if (isset($_POST['check'])){
                 $email = htmlentities(mysqli_real_escape_string($con,trim($_POST['email'])));
                 $recovery_name = htmlentities(mysqli_real_escape_string($con,trim($_POST['recovery_name'])));
                 $check_user = "SELECT * FROM users WHERE email = '$email' AND recovery_account = '$recovery_name'";
                 $check_user_run = mysqli_query($con,$check_user);
                 $check_user_num = mysqli_num_rows($check_user_run);
                 if ($check_user_num == 1){
                     $_SESSION['username'] = $email;
                     echo "<script>window.open('change_password.php','_self');</script>";
                 }else{
                     echo "<script>alert('your email and friend name wrong, please try again');</script>";
                     echo "<script>window.open('forget_password.php','_self');</script>";
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