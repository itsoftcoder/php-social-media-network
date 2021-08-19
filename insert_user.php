<?php
include ('includes/connection.php');

if (isset($_POST['signup'])) {
    $fname = htmlentities(mysqli_real_escape_string($conn, trim($_POST['fname'])));

    $lname = htmlentities(mysqli_real_escape_string($conn, trim($_POST['lname'])));

    $email = htmlentities(mysqli_real_escape_string($conn, trim($_POST['email'])));

    $pass = htmlentities(mysqli_real_escape_string($conn, trim($_POST['pass'])));

    $cpass = htmlentities(mysqli_real_escape_string($conn, trim($_POST['cpass'])));

    $country = htmlentities(mysqli_real_escape_string($conn, trim($_POST['country'])));

    $gender = htmlentities(mysqli_real_escape_string($conn, trim($_POST['gender'])));

    $dob = htmlentities(mysqli_real_escape_string($conn, trim($_POST['dob'])));

    $ststus = 'verified';
    $newgid = sprintf('%05d', rand(0, 999999));
    $username = strtolower($fname . "_" . $lname . "_" . $newgid);

    $posts = 'no';

    $check_username = "SELECT user_name FROM users WHERE email = '$email'";
    $run_username = mysqli_query($conn, $check_username);

    if (strlen($pass) < 9) {
        echo 'password created minimum 8 characters';
        exit();
    }

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $run_email = mysqli_query($conn, $check_email);
    $rows = mysqli_num_rows($run_email);

    if ($rows == 1) {
        echo "<script>alert('username and email already exits,please another email and try agian');</script>";
        echo "<script>window.open('registration.php','_self')</script>";
    }else {

        if ($pass != $cpass) {
            echo "<script>alert('password and confirm password does not match,please another email and try agian');</script>";
            echo "<script>window.open('registration.php','_self')</script>";
        } else {

            $rand = rand(1, 3);

            if ($rand == 1)
                $profile_pic = "avator.png";
            elseif ($rand == 2)
                $profile_pic = "school.png";
            elseif ($rand == 3)
                $profile_pic = "setting.png";

            $sql = "INSERT INTO users(user_id, first_name, last_name, user_name, email, pass, country, gender, dob, image, description, cover_pic, posts, status, relationship, recovery_account,created_at)
            VALUES (NULL ,'$fname','$lname','$username','$email','$pass','$country','$gender','$dob','$profile_pic','this is the defualt description','default.jpg','$posts','$ststus','...','iwanttointerstedandunivers',NOW())";
            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('Registration successfully please login here');</script>";
                echo "<script>window.open('login.php','_self')</script>";
            } else {
                echo "<script>alert('somthing is problem here please try agian ');</script>";
                echo "<script>window.open('registration.php','_self')</script>";
            }
        }
    }
}

?>
