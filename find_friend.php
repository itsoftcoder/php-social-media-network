<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])){
    header("location:main.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    $country = $row['country'];
    ?>
    <title><?php echo 'Find Friend | '.$user_name;?></title>
    <link href="styles/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="styles/css/fonts.css" type="text/css" rel="stylesheet">

    <script src="styles/js/jquery.min.js" type="text/javascript"></script>
    <script src="styles/js/popper.js" type="text/javascript"></script>
    <script src="styles/js/bootstrap.min.js" type="text/javascript"></script>
    <style>
        #profile_img{
            position: absolute;
            top: 160px;
            left: 40px;
        }
        #update_profile{
            position: relative;
            top: 5px;
            cursor: pointer;
            left: 50%;
            background: rgba(0,0,0,0.1);
            border-radius: 4px;
            transform: translate(-50% , -50%);
        }
        #button_profile{
            position: absolute;
            top: 100%;
            left: 50%;
            cursor: pointer;
            transform: translate(-50%,-50%);
        }
    </style>
</head>

<body style="background: #cccccc;">


<div class="container-fluid">
    <?php
    include("includes/header.php");
    ?>
    <div class="row mt-2">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <div>
                <div><img src="cover/<?php echo $cover_pic;?>" class="img-fluid w-100" id="cover_pic" alt="cover" style="height: 400px;"></div>
                <form action="profile.php?u_id=<?php echo $user_id ;?>" method="post" enctype="multipart/form-data">
                    <ul class="nav pull-left" style="position: absolute;top: 10px;left: 40px;">
                        <li class="dropdown">
                            <button class="dropdown-toggle btn btn-light" data-toggle="dropdown">Change Cover</button>
                            <div class="dropdown-menu">
                                <p class="dropdown-item">Click<br> <strong>Select cover</strong><br>
                                    and then click the<br><strong>Update cover</strong>
                                </p>
                                <label class="dropdown-item">Select Cover
                                    <input type="file" name="u_cover" required></label>
                                <input type="submit" class="btn btn-sm btn-success ml-4" value="Update Cover" name="submit"/>
                            </div>

                            <?php
                            if (isset($_POST['submit'])){
                                $file = $_FILES['u_cover']['name'];

                                $dst = 'cover/'.$file;

                                $allow = array('image/jpg','image/jpeg','image/png','image/gift');
//       image validation file type start
                                if(in_array($_FILES['u_cover']['type'],$allow)){
                                    move_uploaded_file($_FILES['u_cover']['tmp_name'],$dst);
                                    $update = "UPDATE users SET cover_pic = '$file' WHERE user_id = '$user_id'";
                                    $run = mysqli_query($conn,$update);
                                    if (mysqli_affected_rows($conn) > 0){

                                        echo "<script>alert('your cover photo updated successfully');</script>";
                                        echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";

                                    }else{
                                        echo "cover image not update please try again";
                                    }
                                } else {
                                    echo "Your image file type must be png or jpg or jpeg or gift use";
                                }
//       image validation file type end
                                if(file_exists($_FILES['u_cover']['tmp_name']) && is_file($_FILES['u_cover']['tmp_name'])){
                                    unlink($_FILES['u_cover']['tmp_name']);
                                }
                            }
                            ?>
                        </li>

                    </ul>
                </form>
            </div>

            <div id="profile_img">
                <img src="users/<?php echo $user_image;?>" class="rounded-circle" style="width: 180px;height: 180px;">
                <form action="profile.php?u_id=<?php echo $user_id;?>" method="post" enctype="multipart/form-data">
                    <label id="update_profile">Select Profile Image
                        <input type="file" name="u_image" required>
                    </label>
                    <input type="submit" id="button_profile" class="btn btn-sm btn-success" name="update" value="Update Profile Image">
                </form>

                <?php
                if (isset($_POST['update'])){
                    $file1 = $_FILES['u_image']['name'];

                    $dst1 = 'users/'.$file1;

                    $allow1 = array('image/jpg','image/jpeg','image/png','image/gift');
//       image validation file type start
                    if(in_array($_FILES['u_image']['type'],$allow1)){
                        move_uploaded_file($_FILES['u_image']['tmp_name'],$dst1);
                        $update1 = "UPDATE users SET image = '$file1' WHERE user_id = '$user_id'";
                        $run1 = mysqli_query($conn,$update1);
                        if (mysqli_affected_rows($conn) > 0){
                            echo "<script>alert('your profile photo updated successfully');</script>";
                            echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";

                        }else{
                            echo "Profile image not update please try again";
                        }
                    } else {
                        echo "Your image file type must be png or jpg or jpeg or gift use";
                    }
//       image validation file type end
                    if(file_exists($_FILES['u_image']['tmp_name']) && is_file($_FILES['u_image']['tmp_name'])){
                        unlink($_FILES['u_image']['tmp_name']);
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row mt-2 p-3">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <h4 class="text-center text-white bg-success p-2">Find A New Friend</h4>
           <form action="" method="post">
               <div class="form-group">
                   <label>Search People</label>
                   <div class="input-group">
                       <div class="input-group-append">
                           <span class="input-group-text"><i class="fa fa-search"></i></span>
                       </div>
                       <input type="text" name="search_friend" class="form-control" placeholder="Search a New Friend"/>

                       <div class="input-group-append">
                           <input type="submit"  name="find_friend" class="btn btn-sm btn-outline-success" value="Click Here">
                       </div>
                   </div>
               </div>

           </form>

            <?php
            function find_friends(){
                global $country;
                $con = mysqli_connect("localhost","root","","social_network");
                if (isset($_POST['find_friend'])){
                    $search_friend = $_POST['search_friend'];
                    $get_friend = "SELECT * FROM users WHERE first_name LIKE '%$search_friend%'
                                                       OR last_name LIKE '%$search_friend%'
                                                       OR user_name LIKE '%$search_friend%'";
                }else{
                    $get_friend = "SELECT * FROM users WHERE country = '$country'";
                }

                $get_friend_result = mysqli_query($con,$get_friend);
                $get_friend_num = mysqli_num_rows($get_friend_result);
                ?>
                <div class="row bg-white mb-2">
                    <div class="pt-3 pl-4">
                        <?php
                        if (!empty($search_friend)){
                        ?>
                        <p>Your Search People <code><?php echo $search_friend;?></code> Results Found Of <strong class="font-weight-bold text-success"><?php echo $get_friend_num;?></strong></p>
                        <?php }else{?>
                        <p>People Available Results Found Of <strong class="font-weight-bold text-success"><?php echo $get_friend_num;?></strong></p>
                        <?php } ?>
                    </div>
                </div>
                <?php
                if ($get_friend_num > 0){
                    ?>
                    <div class="row bg-secondary p-2" id="scroll">
                        <div class="col-md-12">
                    <?php
                    if ($get_friend_num > 4){
                        ?>
                        <script>
                            $('#scroll').addClass('pre-scrollable');
                        </script>
                        <?php

                    }
                    while ($get_friend_row = mysqli_fetch_array($get_friend_result)){
                        ?>
                        <div class="row bg-white mb-2">
                            <div class="col-md-3 p-2">
                                <img src="users/<?php echo $get_friend_row['image']; ?>" class="img-fluid rounded-circle" style="width: 150px;height: 150px;">
                            </div>
                            <div class="col-md-9 p-2">
                                <h5><a href="user_profile.php?u_id=<?php echo $get_friend_row['user_id'];?>">
                                        <?php echo $get_friend_row['user_name']; ?></a>
                                </h5>
                                <p><strong>Description : </strong> <?php echo $get_friend_row['description']; ?></p>
                                <p>Country : <code><?php echo $get_friend_row['country'];?></code></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <?php
            echo find_friends();
            ?>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12 p-5 text-center" style="background: #1c7430;">
            @Copy Right Alamin Hossain 2019
        </div>
    </div>

</div>
</body>
</html>
