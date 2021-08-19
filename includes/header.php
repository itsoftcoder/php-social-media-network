<?php

include("connection.php");
?>
<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background: rgba(0,213,34,0.41);">
    <a class="navbar-brand font-weight-bold" href="../social_network/home.php">Social Network</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            <?php
             $user = $_SESSION['username'];
             $get_user = "SELECT * FROM users WHERE email = '$user'";
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

//             $u_id = base64_encode($user_id);
               $u_id = $user_id;

             $user_posts = "SELECT * FROM posts WHERE user_id = '$user_id'";
             $run_posts = mysqli_query($conn,$user_posts);
             $num_posts = mysqli_num_rows($run_posts);

             ?>


            <li class="nav-item">
                <a class="nav-link font-weight-bold text-dark profile" href="../social_network/profile.php?u_id=<?php echo $u_id;?>">Profile <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold text-dark" href="../social_network/home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold text-dark" href="../social_network/find_friend.php?u_id=<?php echo $user_id; ?>">Find Friend</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold text-dark" href="../social_network/messages.php?u_id=new">Messages</a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false"><i class="fa fa-chevron-circle-down"></i></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-item">
                        <a href="" class="dropdown-item-text">My Posts <span class="badge btn-success"><?php echo $num_posts;?></span></a>
                    </li>
                    <li class="dropdown-item">
                        <a href="../social_network/edit_profile.php?u_id=<?php echo $user_id;?>" class="dropdown-item-text">Edit Account</a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="dropdown-item">
                        <a href="../social_network/logout.php" class="dropdown-item-text">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="../social_network/search_result.php" method="post">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="search_btn" type="submit">Search</button>
        </form>
    </div>
</nav>
