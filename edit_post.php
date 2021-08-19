<?php
$con = mysqli_connect("localhost","root","","social_network");

if (isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
}

$query = "SELECT * FROM posts WHERE post_id = '$post_id'";
$result = mysqli_query($con,$query);
$num = mysqli_num_rows($result);
if ($num == 1){
    $post_row = mysqli_fetch_array($result);
    $update_user_id = $post_row['user_id'];
    $image = $post_row['upload_image'];
    $post_content = $post_row['post_content'];
}

//if (!empty($image)){
//    unlink("../imagepost/$image");
//}else{
//    echo $image.'empty';
//}

?>

<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_GET['post_id'])){
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

    <div class="row mt-2">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <h5 class="p-2 btn-success text-center mb-1">About me</h5>
            <p>Name : <strong><?php echo $first_name.' '.$last_name?></strong></p>
            <p class="">Description : <code class="text-nowrap"><?php echo $description;?></code></p>
            <p>Gender : <code><?php echo $gender;?></code></p>
            <p>Relationship : <code><?php echo $relationship;?></code></p>
            <p>Live In : <code><?php echo $country;?></code></p>
            <p>Date OF Birth : <code><?php echo $user_dob;?></code></p>
        </div>
        <div class="col-md-6 pl-5">
            <h5 class="p-2 bg-success text-center text-white">Edit post</h5>
          <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <label>Content Here: </label>
                  <textarea class="form-control" rows="5" name="content"><?php echo $post_content;?></textarea>
              </div>
              <div class="form-group">
                  <label>Image Change : </label>
                  <input type="file" class="form-control" name="update_image">
              </div>
              <div class="form-group">
                  <input type="submit" name="change" class="btn btn-sm btn-success" value="Update Post">
              </div>
          </form>


            <?php
              if (isset($_POST['change'])){
                  $update_content = $_POST['content'];
                  $update_image = $_FILES['update_image']['name'];
                  if (!empty($update_image) && !empty($update_content)){
                      unlink("imagepost/$image");
                      move_uploaded_file($_FILES['update_image']['tmp_name'],"imagepost/$update_image");
                      $update_post = "UPDATE posts SET post_content = '$update_content', upload_image = '$update_image', updated_at = NOW() WHERE post_id = '$post_id' AND user_id = '$update_user_id'";
                      $update_post_result = mysqli_query($con,$update_post);
                      if ($update_post_result == true){
                          echo "<script>alert('updated successfully');</script>";
                          echo "<script>window.open('profile.php?u_id=$update_user_id','_self');</script>";
                      }
                  }elseif (!empty($update_image) && empty($update_content)){
                      unlink("imagepost/$image");
                      move_uploaded_file($_FILES['update_image']['tmp_name'],"imagepost/$update_image");
                      $update_post = "UPDATE posts SET post_content = 'NO', upload_image = '$update_image',updated_at = NOW() WHERE post_id = '$post_id' AND user_id = '$update_user_id'";
                      $update_post_result = mysqli_query($con,$update_post);
                      if ($update_post_result == true){
                          echo "<script>alert('updated successfully');</script>";
                          echo "<script>window.open('profile.php?u_id=$update_user_id','_self');</script>";
                      }
                  }elseif (empty($update_image) && !empty($update_content)){

                      $update_post = "UPDATE posts SET post_content = '$update_content', updated_at = NOW() WHERE post_id = '$post_id' AND user_id = '$update_user_id'";
                      $update_post_result = mysqli_query($con,$update_post);
                      if ($update_post_result == true){
                          echo "<script>alert('updated successfully');</script>";
                          echo "<script>window.open('profile.php?u_id=$update_user_id','_self');</script>";
                      }
                  }else{
                      echo "<script>confirm('are you do not update this post ? ');</script>";
                  }


              }
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


