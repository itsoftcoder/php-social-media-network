<?php
function edit_profiles(){
    global $user_id;
    if (isset($_POST['update_profile'])){
        $con = mysqli_connect("localhost","root","","social_network");
         $first_name = mysqli_real_escape_string($con,trim($_POST['first_name']));
         $last_name = mysqli_real_escape_string($con,trim($_POST['last_name']));
         $user_name = mysqli_real_escape_string($con,trim($_POST['user_name']));
         $email = mysqli_real_escape_string($con,trim($_POST['email']));
         $pass = mysqli_real_escape_string($con,trim($_POST['pass']));
         $gender = mysqli_real_escape_string($con,trim($_POST['gender']));
         $country = mysqli_real_escape_string($con,trim($_POST['country']));
         $relationship = mysqli_real_escape_string($con,trim($_POST['relationship']));
         $description = mysqli_real_escape_string($con,trim($_POST['description']));
         $dob = mysqli_real_escape_string($con,trim($_POST['dob']));

//         $check_email = "SELECT * FROM users WHERE email = '$email' AND user_name ='$user_name'";
//         $check_email_run = mysqli_query($con,$check_email);
//         $check_email_num = mysqli_num_rows($check_email_run);
//         if($check_email_num > 0){
//             echo "<script>alert('your email Or user name alreday exits');</script>";
//             exit();
//         }

         $update_account = "UPDATE users SET first_name = '$first_name' , last_name='$last_name' ,
                                              user_name = '$user_name' , email = '$email' , pass='$pass' , 
                                              country = '$country' , gender = '$gender' , dob='$dob' , 
                                              description = '$description' , relationship = '$relationship',
                                              updated_at = NOW() WHERE user_id = '$user_id'";
         $update_account_run = mysqli_query($con,$update_account);

         if($update_account_run == true){
             echo "<script>alert('account updated succesfully');</script>";
         }else{
             echo "<script>alert('account does not updated sorry');</script>";
         }
    }
}
?>
