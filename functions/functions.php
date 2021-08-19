<?php
$con = mysqli_connect("localhost","root","","social_network");

function insertPost(){
    global $con;
    global $user_id;
    if (isset($_POST['sub'])){

         $content = htmlentities($_POST['content']);
         $upload_image = $_FILES['upload_image']['name'];
         echo $upload_image;
         $dst2 = 'imagepost/'.$upload_image;

         $allow2 = array('image/jpg','image/jpeg','image/png','image/gift');
//       image validation file type start
        if (strlen($content) > 250){
            echo "<script>alert('your content text to be large please content create 200 characters')</script>";
        }else {

                if (!empty($upload_image) && !empty($content)) {

                    if (in_array($_FILES['upload_image']['type'], $allow2)) {

                        move_uploaded_file($_FILES['upload_image']['tmp_name'], $dst2);
                        $insert_post = "INSERT INTO posts(post_id, user_id, post_content,upload_image,created_at)
                                    VALUES(NULL ,'$user_id','$content','$upload_image',NOW())";
                        $run = mysqli_query($con, $insert_post);



                        if ($run == true) {
                            echo "<script>alert('post uploaded successfully');</script>";
                            echo "<script>window.open('home.php?u_id=$user_id','_self')</script>";

                            $update_users = "UPDATE users SET posts = 'yes' WHERE user_id = '$user_id'";
                            $run_update = mysqli_query($update_users);

                        } else {
                            echo "<script>alert('error your post is empty');</script>";
                        }



                    }else{
                        echo "<script>alert('you image must be use jpg,or jpeg,or png or gift')</script>";
                    }


                }elseif($content == ''){

                    if (in_array($_FILES['upload_image']['type'], $allow2)) {

                        move_uploaded_file($_FILES['upload_image']['tmp_name'], $dst2);
                        $insert_post = "INSERT INTO posts(post_id, user_id, post_content,upload_image,created_at)
                                            VALUES(NULL ,'$user_id','NO','$upload_image',NOW())";
                        $run = mysqli_query($con, $insert_post);



                        if ($run==true) {
                            echo "<script>alert('post uploaded successfully');</script>";
                            echo "<script>window.open('home.php?u_id=$user_id','_self')</script>";

                            $update_users = "UPDATE users SET posts = 'yes' WHERE user_id = '$user_id'";
                            $run_update = mysqli_query($update_users);

                        } else {
                            echo "<script>alert('error your post is empty');</script>";
                        }



                    }else{
                        echo "<script>alert('your image must be use jpg,or jpeg,or png,or gift');</script>";
                    }

                        }elseif($upload_image == ''){
                            $insert_post = "INSERT INTO posts(post_id, user_id, post_content,created_at)
                                            VALUES(NULL ,'$user_id','$content',NOW())";
                            $run = mysqli_query($con,$insert_post);


                            if ($run==true) {
                                echo "<script>alert('post uploaded successfully');</script>";
                                echo "<script>window.open('home.php?u_id=$user_id','_self')</script>";

                                $update_users = "UPDATE users SET posts = 'yes' WHERE user_id = '$user_id'";
                                $run_update = mysqli_query($update_users);

                            } else {
                                echo "<script>alert('post does not uploaded');</script>";
                            }



                        }else{
                               echo "<script>alert('error your post is empty');</script>";
                       }

        } // close else when if condition is if(strlen($content > 200))

//       image validation file type end
        if(file_exists($_FILES['upload_image']['tmp_name']) && is_file($_FILES['upload_image']['tmp_name'])){
            unlink($_FILES['upload_image']['tmp_name']);
        }

    }  //close if(isset($_POST['sub']))

} // close function insertPost()


function get_posts(){
    global $con;
    $per_page = 4;


//   start get page count with get veriable
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
//    end get page count with get veriable

    $start_from = ($page-1)*$per_page;

    $get_posts = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $start_from,$per_page";
    $run_posts = mysqli_query($con,$get_posts);
    while ($row = mysqli_fetch_array($run_posts)){
         $post_id = $row['post_id'];
         $user_id = $row['user_id'];
         $content = substr($row['post_content'],0,100);
         $upload_image = $row['upload_image'];
         $created_at = $row['created_at'];

        $user = "SELECT * FROM users WHERE user_id = '$user_id' AND posts='no'";
        $get_users = mysqli_query($con,$user);
        $row_user = mysqli_fetch_array($get_users);

         $user_name = $row_user['user_name'];
         $user_image = $row_user['image'];

       if ($content=='NO' && strlen($upload_image) >= 1){
?>

              <div class="row mb-4">
<!--                 <div class="col-md-1"></div>-->
                 <div class="col-md-12 bg-white">
                     <div class="row">
                         <div class="col-md-2 p-3">

                         <img src="users/<?php echo $user_image;?>" class="rounded-circle" width="100px" height="100px" >

                         </div>
                         <div class="col-md-6 ml-2 p-3">
                          <h5><a href="../social_network/user_profile.php?u_id=<?php echo $user_id;?>"><?php echo $user_name?></a></h5>
                          <p>Uploaded date : <code><?php echo $created_at;?></code></p>
                         </div>
                         <div class="col-md-4"></div>
                     </div>
                     <div class="row mt-2">
                         <div class="col-md-12">
                             <img src="imagepost/<?php echo $upload_image?>" class="img-fluid w-100 mb-2" height="350px;">
                         </div>

                     </div>
                          <div class="d-flex justify-content-between p-2">
                              <a href="" class="btn btn-sm btn-info">Like</a>
                              <a href="view_post.php?post_id=<?php echo $post_id;?>" class="btn btn-sm btn-success">Comments</a>
                          </div>
                 </div>
<!--                  <div class="col-md-1"></div>-->
              </div>

            <?php
        }elseif (strlen($content) >=1 && strlen($upload_image) >= 1){
           ?>
           <div class="row mb-4">
<!--               <div class="col-md-1"></div>-->
               <div class="col-md-12 bg-white">
                   <div class="row">
                       <div class="col-md-2 p-3">

                           <img src="users/<?php echo $user_image;?>" class="rounded-circle" width="100px" height="100px" >

                       </div>
                       <div class="col-md-6 ml-2 p-3">
                           <h5><a href="../social_network/user_profile.php?u_id=<?php echo $user_id;?>"><?php echo $user_name?></a></h5>
                           <p>Uploaded date : <code><?php echo $created_at;?></code></p>
                       </div>
                       <div class="col-md-4"></div>
                   </div>
                   <div class="row mt-2">
                       <div class="col-md-12">
                           <p class="font-italic"><?php echo $content ;

                           ?></p>
                           <img src="imagepost/<?php echo $upload_image?>" class="img-fluid w-100 mb-2" height="350px;">
                       </div>

                   </div>
                   <div class="d-flex justify-content-between p-2">
                       <a href="" class="btn btn-sm btn-info">Like</a>
                       <a href="view_post.php?post_id=<?php echo $post_id;?>" class="btn btn-sm btn-success">Comments</a>
                   </div>
               </div>
<!--               <div class="col-md-1"></div>-->
           </div>


           <?php
        }else{
           ?>
           <div class="row mb-4">
<!--               <div class="col-md-1"></div>-->
               <div class="col-md-12 bg-white">
                   <div class="row">
                       <div class="col-md-2 p-3">

                           <img src="users/<?php echo $user_image;?>" class="rounded-circle" width="100px" height="100px" >

                       </div>
                       <div class="col-md-6 ml-2 p-3">
                           <h5><a href="../social_network/user_profile.php?u_id=<?php echo $user_id;?>"><?php echo $user_name?></a></h5>
                           <p>Uploaded date : <code><?php echo $created_at;?></code></p>
                       </div>
                       <div class="col-md-4"></div>
                   </div>
                   <div class="row mt-2">
                       <div class="col-md-12">

                           <p><?php echo $content ;
                             if (substr($content,$content == 10,$content==100)){
                                 ?>
                                 <a href="more.php">More.....</a>
                                 <?php
                             }
                           ?></p>
                       </div>

                   </div>
                   <div class="d-flex justify-content-between p-2">
                       <a href="" class="btn btn-sm btn-info">Like</a>
                       <a href="view_post.php?post_id=<?php echo $post_id;?>" class="btn btn-sm btn-success">Comments</a>
                   </div>
               </div>
<!--               <div class="col-md-1"></div>-->
           </div>

          <?php
       } // close else when if condition is content== 'NO' And upload_image >= 1

    } // end while loop posts

    include("pagination.php");

}

?>
