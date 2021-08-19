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
    $country = $row['country'];
    ?>
    <title><?php echo 'Messages | '.$user_name;?></title>
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
        <div class="col-md-2"></div>
        <div class="col-md-8 bg-white">
            <?php
             function messages_member(){
                $con = mysqli_connect("localhost","root","","social_network");

                if (isset($_GET['u_id'])){
                    $get_id = $_GET['u_id'];
                    $get_user = "SELECT * FROM users WHERE user_id = '$get_id'";
                    $run_user = mysqli_query($con,$get_user);
                    $row_user = mysqli_fetch_array($run_user);
                    $user_to_msg = $row_user['user_id'];
                    $user_to_name = $row_user['user_name'];
                    $user_to_gender = $row_user['gender'];
                    $user_to_country = $row_user['country'];
                    $user_to_relation = $row_user['relationship'];
                    $user_to_descrip = $row_user['description'];
                    $user_to_fname = $row_user['first_name'];
                    $user_to_lname = $row_user['last_name'];
                    $user_to_image = $row_user['image'];
                }

               // get session user

                $session_user = $_SESSION['username'];
                $get_user = "SELECT * FROM users WHERE email='$session_user'";
                $run_user = mysqli_query($con,$get_user);
                $row = mysqli_fetch_array($run_user);
                $user_from_msg = $row['user_id'];
                $user_from_name = $row['user_name'];

                // get all user or all friend

                 $users = "SELECT * FROM users";
                 $run_user = mysqli_query($con,$users);
                     ?>
                 <div class="row">

<!--                 ======= this the right side all user or all friend show here ========= -->

                     <div class="col-md-3 p-1 pre-scrollable">
                      <?php
                      while ($row_users = mysqli_fetch_array($run_user)){
                         $user_id = $row_users['user_id'];
                         $first_name = $row_users['first_name'];
                         $last_name = $row_users['last_name'];
                         $user_image = $row_users['image'];
                         ?>
                          <div class="row mb-2">
                              <div class="col-md-6">
                                  <a href="messages.php?u_id=<?php echo $user_id;?>">
                                      <img src="users/<?php echo $user_image ;?>" class="rounded-circle img-fluid" style="height: 100px;width: 100px;">
                                  </a>
                              </div>
                              <div class="col-md-6">
                                  <a href="messages.php?u_id=<?php echo $user_id;?>"><?php echo $first_name.' '.$last_name ;?></a>
                              </div>
                          </div>
                         <?php
                        }
                        ?>
                     </div>

<!--                 ======== this is center message show and message show content here ======== -->

                     <div class="col-md-7 pre-scrollable" id="roll">
                         <?php
                           $get_messages = "SELECT * FROM user_messages WHERE
                                            (user_to='$user_to_msg' AND user_from='$user_from_msg') OR 
                                            (user_to='$user_from_msg' AND user_from='$user_to_msg') ORDER BY id ASC";
                           $run_messages = mysqli_query($con,$get_messages);
                           while ($row_messages = mysqli_fetch_array($run_messages)){
                               $user_to = $row_messages['user_to'];
                               $user_from = $row_messages['user_from'];
                               $msg_body = $row_messages['msg_body'];
                               $send_date = $row_messages['send_date'];
                               ?>
                               <div class="mb-2 mt-2 p-2">
                                   <?php
                                   if ($user_to == $user_to_msg AND $user_from == $user_from_msg){
                                       ?>
                                       <div class="p-2 float-right bg-primary text-white mb-3"><span><?php echo $msg_body;?></span></div>
                                       <?php
                                   }elseif($user_to == $user_from_msg AND $user_from == $user_to_msg){
                                       ?>
                                       <div class="p-2 float-left bg-success text-white mb-3"><span><?php echo $msg_body;?></span></div>
                                       <?php
                                   }
                                   ?>
                               </div>
                               <?php
                           }
                         ?>

<!--                         message send design and create message form-->

                         <?php
                          if ($get_id == 'new'){
                              echo "select friend then send or show message";
                          }else{
                              ?>
                              <div class="mt-2 p-2">
                                  <form action="" method="post" class="mt-2">
                                      <div class="form-group">
                                          <textarea rows="5" class="form-control" name="message"></textarea>
                                      </div>
                                      <div class="form-group">
                                          <input type="submit" name="send" class="btn btn-sm btn-success w-50" value="Send" />
                                          <input type="button" class="btn btn-sm btn-primary w-25" onclick="return window.open('messages.php?u_id=<?php echo $user_to_msg;?>')" value="Refresh">
                                      </div>
                                  </form>
                              </div>
                              <?php
                          }
                         ?>

<!--                          message insert query and input new message      -->

                         <?php

                         if (isset($_POST['send'])){
                             $message = htmlentities($_POST['message']);
                             if (empty($message)){
                                 echo "<script>alert('message is empty please try agian');</script>";
                             }elseif (strlen($message) > 200){
                                 echo "<script>alert('message create less then 200 charecters');</script>";
                             }else{
                                 $insert_message = "INSERT INTO user_messages (id, user_to, user_from, msg_body, msg_seen, send_date)
                                                    VALUES (NULL ,'$user_to_msg','$user_from_msg','$message','no',NOW())";
                                 $run_message_query = mysqli_query($con,$insert_message);
                                 if ($run_message_query == true){
//                                     echo "<script>alert('message send successfully')</script>";
                                     echo "<script>open('messages.php?u_id=$user_to_msg','_self');</script>";
                                 }else{
                                     echo "<script>alert('something is error')</script>";
                                 }
                             }
                         }
                         ?>

                     </div>

<!--                 ======= this is left side user information ======== -->

                     <?php
                     if ($get_id != 'new'){
                         ?>
                         <div class="col-md-2 p-1">
                             <img src="users/<?php echo $user_to_image;?>" class="rounded-circle img-fluid" style="width: 140px;height: 120px;">
                             <ul class="nav mt-2">
                                 <li class="nav-item bg-secondary mb-1">
                                     <a class="nav-link text-white"><?php echo $user_to_fname.' '.$user_to_lname;?></a>
                                 </li>
                                 <li class="nav-item bg-secondary mb-1">
                                     <a class="nav-link text-white"><?php echo $user_to_country;?></a>
                                 </li>
                                 <li class="nav-item bg-secondary mb-1">
                                     <a class="nav-link text-white"><?php echo $user_to_gender;?></a>
                                 </li>
                                 <li class="nav-item bg-secondary mb-1">
                                     <a class="nav-link text-white"><?php echo $user_to_relation;?></a>
                                 </li>
                                 <li class="nav-item bg-secondary mb-1">
                                     <a class="nav-link text-white"><?php echo $user_to_descrip;?></a>
                                 </li>
                             </ul>

                                 <?php
                             }else{
                                 echo "<p>select friend the show or send message</p>";
                             }
                             ?>
                         </div>
                 </div>
                 <?php
             }

            ?>

            <?php
            echo messages_member();
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
<script>
    var sc = document.getElementById('roll');
    sc.scrollTop = sc.scrollHeight;
</script>
</body>
</html>

