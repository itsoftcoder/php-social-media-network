<?php

function get_user_images()
{
    $con = mysqli_connect("localhost","root","","social_network");
    $per_page = 4;

    // get user id and take if isset method

    if (isset($_GET['u_id'])) {
        $u_id = $_GET['u_id'];
    }
//    $u_id = base64_decode($un_id);


    //   start get page count with get veriable
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    //    end get page count with get veriable

    $start_from = ($page - 1) * $per_page;


    $get_posts = "SELECT * FROM posts WHERE user_id = '$u_id' ORDER BY post_id DESC LIMIT $start_from,$per_page";
    $run_posts = mysqli_query($con, $get_posts);
    while ($row = mysqli_fetch_array($run_posts)) {
        $post_id = $row['post_id'];
        $user_id = $row['user_id'];
        $content = substr($row['post_content'], 0, 100);
        $upload_image = $row['upload_image'];
        $created_at = $row['created_at'];

        $user = "SELECT * FROM users WHERE user_id = '$user_id' AND posts='no'";
        $get_users = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($get_users);

        $user_name = $row_user['user_name'];
        $user_image = $row_user['image'];

        if ($content == 'NO' && strlen($upload_image) >= 1) {
            ?>

            <div class="row mb-2">

                <div class="col-md-12 bg-white">

                    <div class="row">

                        <div class="col-md-2 p-3">

                            <img src="users/<?php echo $user_image; ?>" class="rounded-circle" width="100px"
                                 height="100px">

                        </div>

                        <div class="col-md-6 ml-2 p-3">
                            <h5><a href="../social_network/user_profile.php?u_id=<?php echo $user_id; ?>"><?php echo $user_name ?></a></h5>
                            <p>Uploaded date : <code><?php echo $created_at; ?></code></p>
                        </div>

                        <div class="col-md-4"></div>
                    </div>

                    <!--  ========================= end row ====================== -->

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <img src="imagepost/<?php echo $upload_image ?>" class="img-fluid w-100 mb-2"
                                 height="350px;">
                        </div>
                    </div>

                    <!--   ====================== end row mt-2 =================== -->
                    <hr>


                </div>

                <!--   ====================== end col-md-12 bg-white ============ -->

            </div>

            <!--   ====================== end of row mb-4 ============ -->

            <?php
        } elseif (strlen($content) >= 1 && strlen($upload_image) >= 1) {
            ?>
            <div class="row mb-2 p-3">

                <div class="col-md-12 bg-white">

                    <div class="row">

                        <div class="col-md-2 p-3">

                            <img src="users/<?php echo $user_image; ?>" class="rounded-circle" width="100px"
                                 height="100px">

                        </div>

                        <div class="col-md-6 ml-2 p-3">
                            <h5><a href="../social_network/user_profile.php?u_id=<?php echo $user_id; ?>"><?php echo $user_name ?></a></h5>
                            <p>Uploaded date : <code><?php echo $created_at; ?></code></p>
                        </div>

                        <div class="col-md-4"></div>
                    </div>

                    <!--   ====================== end row ============ -->

                    <div class="row mt-2">

                        <div class="col-md-12">
                            <img src="imagepost/<?php echo $upload_image ?>" class="img-fluid w-100 mb-2"
                                 height="350px;">
                        </div>

                    </div>

                    <!--   ====================== end row mt-2 ============ -->
                    <hr>


                </div>

                <!--   ====================== end col-md-12 bg-white ============ -->

            </div>

            <!--   ====================== end row mb-4 ============ -->


            <?php
        } else {
            ?>


            <?php
        } // close else when if condition is content== 'NO' And upload_image >= 1

    } // end while loop posts


    $query = "SELECT * FROM posts WHERE user_id = '$u_id'";
    $result = mysqli_query($con,$query);
    $total_posts = mysqli_num_rows($result);
    $total_page = ceil($total_posts / $per_page);

    ?>
    <div class="d-flex justify-content-center align-content-center">
        <div class="pagination pagination-sm">
            <li class="page-item"><a href="profile.php?u_id=<?php echo $u_id;?>&page=1" class="page-link">First Page</a> </li>
            <?php
            for ($i=1; $i<$total_page;$i++){
                ?>
                <li class="page-item"><a href="profile.php?u_id=<?php echo $u_id;?>&page=<?php echo $i;?>" class="page-link"><?php echo $i ;?></a> </li>
                <?php
            }
            ?>
            <li class="page-item"><a href="profile.php?u_id=<?php echo $u_id;?>&page=<?php echo $total_page;?>" class="page-link">Last Page</a></li>
        </div>

    </div>



    <?php



}

?>
