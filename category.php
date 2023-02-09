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
                <!-- Insert post from a specific category from database -->
                <?php
                 if(isset($_GET['category'])){
                    $category_id = $_GET['category'];
                 }
                 $query = "SELECT * FROM `posts` WHERE `post_category_id` = $category_id";
                 $post_result = mysqli_query($conn, $query);

                 $data = mysqli_num_rows($post_result);

                 if($data > 0){
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
                        by <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php dateFormat($post_date) ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
     <?php }
        }else{
            echo "No Post related to this category.";
        }
     ?>

            </div>
            <!-- side bar -->
            <?php include "include/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'include/footer.php'?>