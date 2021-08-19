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
    <title>Edit profile Acount Setting</title>
    <link href="styles/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="styles/css/fonts.css" type="text/css" rel="stylesheet">

    <script src="styles/js/jquery.min.js" type="text/javascript"></script>
    <script src="styles/js/popper.js" type="text/javascript"></script>
    <script src="styles/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body style="background: #cccccc;">
<div class="container-fluid">
    <?php
    include("includes/header.php");
    ?>
    <div class="row mt-2">
        <div class="col-sm-12">
            <?php
            function get_user(){
                if (isset($_GET['u_id'])){
                    $get_id = $_GET['u_id'];
                }
                $conn = mysqli_connect("localhost","root","","social_network");
                $user = $_SESSION['username'];
                $get_user = "SELECT * FROM users WHERE email = '$user' AND user_id='$get_id'";
                $run_user = mysqli_query($conn,$get_user);
                $row = mysqli_fetch_array($run_user);

                $user_id    = $row['user_id'];
                $first_name = $row['first_name'];
                $last_name  = $row['last_name'];
                $user_name  = $row['user_name'];
                $user_email = $row['email'];
                $user_pass  = $row['pass'];
                $country    = $row['country'];
                $gender     = $row['gender'];
                $user_dob   = $row['dob'];
                $user_image = $row['image'];
                $description= $row['description'];
                $cover_pic  = $row['cover_pic'];
                $relationship = $row['relationship'];
                $recover_account = $row['recovery_account'];
                $created_at = $row['created_at'];

                ?>

                <div class="card">
                    <div class="card-header text-center font-weight-bold">Edit your Acounting here</div>
                    <div class="card-body">
                        <form action="" method="post">


                            <div class="form-group row">
                                <label class="col-md-3">Change your First Name </label>

                                <div class="col-md-9">
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $first_name;?>">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change Your last Name </label>

                                <div class="col-md-9">
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $last_name;?>">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change Your User Name </label>

                                <div class="col-md-9">
                                    <input type="text" name="user_name" class="form-control" value="<?php echo $user_name;?>">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change your Email</label>

                                <div class="col-md-9">
                                    <input type="email" name="email" class="form-control" value="<?php echo $user_email;?>">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change Your Password</label>

                                <div class="col-md-9">
                                    <input type="text" name="pass" class="form-control" value="<?php echo $user_pass;?>">

                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change Your Country</label>

                                <div class="col-md-9">
                                   <select name="country" class="form-control">
                                       <option><?php echo $country ;?></option>
                                       <option>Pakistan</option>
                                       <option>India</option>
                                       <option>England</option>
                                       <option>South Africa</option>
                                       <option>Australia</option>
                                       <option>America</option>
                                       <option>Srilanka</option>
                                       <option>NewZeland</option>
                                       <option>Arob</option>
                                       <option>USA</option>
                                   </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change Your Relationship</label>

                                <div class="col-md-9">
                                    <select name="relationship" class="form-control">
                                        <option><?php echo $relationship ;?></option>
                                        <option>Engaged</option>
                                        <option>Married</option>
                                        <option>Single</option>
                                        <option>In a Relationship</option>
                                        <option>it's comlicated</option>
                                        <option>Separated</option>
                                        <option>Divorced</option>
                                        <option>Wedowed</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change Your Gender</label>

                                <div class="col-md-9">
                                    <select name="gender" class="form-control">
                                        <option><?php echo $gender ;?></option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Othors</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change Your Description</label>

                                <div class="col-md-9">
                                    <input type="text" name="description" class="form-control" value="<?php echo $description;?>">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3">Change Your Date of Birth</label>

                                <div class="col-md-9">
                                    <input type="date" name="dob" class="form-control" value="<?php echo $user_dob; ?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3"></label>
                                <div class="col-md-9">
                                    <input type="submit" name="update_profile" class="btn btn-success" value="Change Your Profile Account">
                                </div>
                            </div>

                        </form>
                        <?php
                        include("functions/update_profile.php");
                        echo edit_profiles();
                        ?>
                    </div>


                    <div class="card-footer text-center">
                        <div class="form-group row">
                            <label class="col-md-6">Forgotten Your Password</label>

                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                                    Turn On
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label>What is you best friend name : </label>
                                                        <textarea class="form-control" rows="3" name="content" required></textarea>
                                                        <input type="submit" name="sub" class="btn btn-primary">
                                                    </div>
                                                </form>
                                                <?php

                                                if (isset($_POST['sub'])){
                                                    $content = htmlentities($_POST['content']);
                                                    $update_recovery = "UPDATE users SET recovery_account= '$content' WHERE user_id='$user_id'";
                                                    $update_recovery_run = mysqli_query($conn,$update_recovery);
                                                    if ($update_recovery_run == true){
                                                        echo "<script>alert('forgotten password turn on successful');</script>";
                                                    }else{
                                                        echo "<script>alert('something is error')</script>";
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

            }
            ?>

            <?php
            echo get_user();
            ?>
        </div>
    </div>
</div>
</body>
</html>
