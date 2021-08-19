
<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_GET['u_id'])){
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
    ?>
    <title><?php echo 'Profile | '.$user_name;?></title>
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


        <div class="row mb-2 mt-2">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <ul class="nav nav-tabs bg-secondary pt-2 pl-2 pr-2" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="true">Timeline</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">friends</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Photos</a>
                    </li>
                </ul>
                <div class="tab-content bg-secondary pl-2 pr-2 pb-2" id="myTabContent">
                    <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <h5 class="text-center text-white p-2">About Me</h5>
                        <div>
                            <p class="text-white">Name : <strong><?php echo $first_name.' '.$last_name?></strong></p>
                            <p class="text-white">Description : <code class="text-white font-weight-bold"><?php echo $description;?></code></p>
                            <p class="text-white">Gender : <code class="font-weight-bold text-white"><?php echo $gender;?></code></p>
                            <p class="text-white">Relationship : <code class="text-white font-weight-bold"><?php echo $relationship;?></code></p>
                            <p class="text-white">Live In : <code class="text-white font-weight-bold"><?php echo $country;?></code></p>
                            <p class="text-white">Date OF Birth : <code class="text-white font-weight-bold"><?php echo $user_dob;?></code></p>
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                        <?php
                        include("functions/profile_post.php");
                        echo get_users();
                        ?>
                    </div>

                    <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">
                        this my friend post
                    </div>

                    <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                        <?php
                        include("functions/user_all_image.php");
                        echo get_user_images();
                        ?>
                    </div>

                </div>
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
