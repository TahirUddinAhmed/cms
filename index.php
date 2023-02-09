<?php 
 include 'include/DB_Conn.php';
 include 'include/header.php'

?>
<?php include 'include/navigation.php' ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <!-- Insert a blog post from database -->
                <?php

                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else {
                    $page = "";
                }

                if($page == "" || $page == 1){
                    $page_1 = 0;
                }else {
                    $page_1 = ($page * 5) -5;
                }

                // count the num of post
                 $post_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `posts`"));

                 // how many posts to show 
                 $post_count = ceil($post_count / 5);



                 $query = "SELECT * FROM `posts` WHERE `post_status` = 'Published' LIMIT $page_1, 5";
                 $post_result = mysqli_query($conn, $query);
                 $num_of_data = mysqli_num_rows($post_result);

                 if($num_of_data <= 0){
                    echo "No post available..";
                 }
                 

                 while($row = mysqli_fetch_assoc($post_result)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0 ,250);
                    ?>

                    <h2>
                      <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title;?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php dateFormat($post_date); ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
     <?php }?>

            </div>
            <!-- side bar -->
            <?php include "include/sidebar.php"; ?>
        </div>
        <!-- /.row -->


        <!-- // pagination design -->
        <ul class="pager"> 
          <?php
           // loop
           for($i = 1; $i <= $post_count; $i++){
            if($i == $page){
                echo "<li><a href='index.php?page={$i}' class='active_link'>$i</a></li>";
            }else {
                echo "<li><a href='index.php?page={$i}'>$i</a></li>";
            }
            
           }
          ?>
          <!-- <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li> -->
        </ul>
<?php include 'include/footer.php'?>