<?php
$con = mysqli_connect("localhost","root","","social_network");

if (isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
}

$query = "SELECT * FROM posts WHERE post_id = '$post_id'";
$result = mysqli_query($con,$query);
$num = mysqli_num_rows($result);
if ($num == 1){
    $row = mysqli_fetch_array($result);
    $user_id = $row['user_id'];
    $image = $row['upload_image'];
}

if (!empty($image)){
    unlink("../imagepost/$image");
}else{
    echo $image.'empty';
}

$sql = "DELETE FROM posts WHERE post_id = '$post_id' AND user_id = '$user_id'";
$delete_result = mysqli_query($con,$sql);

if ($delete_result == true){
    echo "<script>alert('Your post is deleted successfully');</script>";
    echo "<script>window.open('../profile.php?u_id=$user_id','_self')</script>";
}
?>
