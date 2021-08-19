<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])){
    header("location:main.php");
}
?>
<html lang="en">
<head>
    <?php
    include("includes/connection.php");
    $user = $_SESSION['username'];
    $get_user = "SELECT * FROM users WHERE email = '$user'";
    $run_user = mysqli_query($conn,$get_user);
    $row = mysqli_fetch_array($run_user);

    $user_id    = $row['user_id'];
    $first_name = $row['first_name'];
    $last_name  = $row['last_name'];
    $user_name  = $row['user_name'];
    ?>
    <meta charset="UTF-8">
    <title><?php echo 'Home | '.$user_name ;?></title>
    <link href="styles/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="styles/css/fonts.css" type="text/css" rel="stylesheet">

    <script src="styles/js/jquery.min.js" type="text/javascript"></script>
    <script src="styles/js/popper.js" type="text/javascript"></script>
    <script src="styles/js/bootstrap.min.js" type="text/javascript"></script>
    <style>
        input[type='file']{
            position: absolute;
            top: 128px;
            left: auto;
        }
    </style>
</head>
<body>
<div class="container-fluid" style="background: #ccc;">
    <?php
    include("includes/header.php");
    include("functions/functions.php");
    ?>
<div class="row mt-2">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div>
            <form action="home.php?id=<?php echo $user_id;?>" method="post" enctype="multipart/form-data">
                <textarea class="form-control" id="content" rows="6" placeholder="What's Your mind ? " name="content"></textarea>
                <label id="upload_image_button">
                    <input type="file" name="upload_image" />
                </label>
                <input type="submit" name="sub" class="btn btn-sm btn-success w-50 float-right mt-2" value="Post">
            </form>
            <?php insertPost();?>
        </div>
        <hr>
    </div>
    <div class="col-md-2"></div>
</div>


        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h4 class="ml-5">News Feed</h4>
                <hr>
                <?php get_posts();?>
            </div>
            <div class="col-md-2"></div>
        </div>


    <div class="row">
        <div class="col-md-12 p-5 text-center" style="background: #1c7430;">
           @Copy Right Alamin Hossain 2019
        </div>
    </div>
</div>
</body>
</html>
