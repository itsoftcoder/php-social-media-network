<?php
$query = "SELECT * FROM posts";
$result = mysqli_query($con,$query);
$total_posts = mysqli_num_rows($result);
$total_page = ceil($total_posts / $per_page);

?>
<div class="d-flex justify-content-center align-content-center">
    <div class="pagination pagination-sm">
        <li class="page-item"><a href="home.php?page=1" class="page-link">First Page</a> </li>
        <?php
        for ($i=1; $i<$total_page;$i++){
            ?>
            <li class="page-item"><a href="home.php?page=<?php echo $i;?>" class="page-link"><?php echo $i ;?></a> </li>
            <?php
        }
        ?>
        <li class="page-item"><a href="home.php?page=<?php echo $total_page;?>" class="page-link">Last Page</a></li>
    </div>

</div>

<?php


?>
