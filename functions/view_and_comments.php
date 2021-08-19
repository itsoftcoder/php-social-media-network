<?php

function get_post_comments(){
    $con = mysqli_connect("localhost","root","","social_network");

    if (isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
    }

    $get_post = "SELECT * FROM posts WHERE post_id = '$post_id' ";
    $get_post_result = mysqli_query($con,$get_post);
    $get_post_num = mysqli_num_rows($get_post_result);
    if($get_post_num == 1){
        $get_post_row = mysqli_fetch_array($get_post_result);
        $row_post_id = $get_post_row['post_id'];
        $row_user_id = $get_post_row['user_id'];
        $row_post_content = $get_post_row['post_content'];
        $row_post_image = $get_post_row['upload_image'];
        $post_uploaded_date = $get_post_row['created_at'];
    }

    $user_id = $row_user_id;

    $get_user = "SELECT * FROM users WHERE user_id = '$user_id'";
    $get_user_result = mysqli_query($con,$get_user);
    $get_user_num = mysqli_num_rows($get_user_result);
    if ($get_user_num == 1){
        $get_user_row = mysqli_fetch_array($get_user_result);
        $row_users_id = $get_user_row['user_id'];
        $row_user_name = $get_user_row['user_name'];
        $row_user_image = $get_user_row['image'];
    }

    ?>
    <div class="row bg-white">
        <div class="col-md-2 p-3">
            <img src="users/<?php echo $row_user_image ;?>" class="img-fluid rounded-circle" style="width: 100px;height: 100px;">
        </div>
        <div class="col-md-10 p-3">
            <h4><a href="../social_network/user_profile.php?u_id=<?php echo $row_users_id;?>"><?php echo $row_user_name ;?></a></h4>

            <p><strong>Post Uploaded date : </strong><?php echo $post_uploaded_date ;?></p>
        </div>
        <div class="col-md-12 mt-2">
            <p class="text-capitalize"><?php echo $row_post_content ;?></p>
            <img src="imagepost/<?php echo $row_post_image; ?>" class="img-fluid w-100 pb-3">
        </div>
    </div>
<hr>
    <h4 class="text-center">Comments All below</h4>
    <hr>
<!--    show all comments here-->
    <div class="row mt-2 p-3 bg-secondary" id="scroll">
       <div class="col-md-12">
           <?php
           function count_comments(){
               $con = mysqli_connect("localhost","root","","social_network");
               if (isset($_GET['post_id'])) {
                   $get_post_id = $_GET['post_id'];

                   $get_comments_post = "SELECT * FROM comments WHERE post_id = '$get_post_id'";
                   $get_comments_post_result = mysqli_query($con, $get_comments_post);

                   $count_post_comments = mysqli_num_rows($get_comments_post_result);
                   return $count_post_comments;
               }

           }
           ?>
            <h5 class="text-center p-2 text-white">Your Post Comments count : <?php echo count_comments();?></h5>

           <?php
             if (count_comments() > 4){
                 ?>
                 <script>
                     $('#scroll').addClass('pre-scrollable');
                 </script>
                 <?php
             }
           ?>


    <?php
    $get_comments = "SELECT * FROM comments WHERE post_id='$post_id' AND user_id= '$row_users_id' ORDER BY com_id DESC ";
    $comments_result = mysqli_query($con,$get_comments);
    $comments_num = mysqli_num_rows($comments_result);
//    echo $comments_num;
    if ($comments_num > 0) {
        while ($comments_row = mysqli_fetch_array($comments_result)) {

         $comment_date = $comments_row['created_at'];

            ?>
            <div class="row bg-white mt-2">
                <div class="col-md-12">
                    <h5 class="text-primary text-capitalize"><?php echo $comments_row['comment_author']; ?> commented by <small><?php echo $comment_date; ?></small></h5>
                    <p><?php echo $comments_row['comment']; ?></p>
                </div>
            </div>

            <?php
        }
    }
        ?>
       </div>
    </div>

<!--    added new comments here-->
    <div class="row mt-2">
        <div class="col-md-12">
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-md-3">Comments Here :</label>
                    <div class="col-md-9">
                        <textarea name="comment" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-7"></label>
                     <div class="col-md-5">
                         <input type="submit" class="btn btn-sm btn-success w-100" name="add_comment" value="Add Comments">
                     </div>
                </div>

            </form>
        </div>
    </div>
<?php


    if (isset($_POST['add_comment'])){
        $sesion = $_SESSION['username'];
        $get_session_user = "SELECT * FROM users WHERE email = '$sesion' LIMIT 1";
        $get_session_result = mysqli_query($con,$get_session_user);
        if ($get_session_result == true){
            $get_session_row = mysqli_fetch_array($get_session_result);
            $user_name = $get_session_row['user_name'];
        }else{
            echo "user session problem try again login";
        }
        $comment = $_POST['comment'];
        if (!empty($comment)){

            $inserted_comment = "INSERT INTO comments (com_id, user_id, post_id, comment, comment_author)
                                 VALUES (NULL ,'$row_users_id','$post_id','$comment','$user_name')";
            $result_comment = mysqli_query($con,$inserted_comment);

            if (mysqli_affected_rows($con) > 0 ){
                echo "<script>alert('comment added successfully');</script>";
                echo "<script>window.open('view_post.php?post_id=$post_id','_self');</script>";
            }else{
               echo "<script>alert('somthing is problem');</script>";
            }
        }else{
            echo "<script>alert('your comment is empty please input comment then try again');</script>";
        }
    }
}
