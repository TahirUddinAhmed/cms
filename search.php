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
                 if(isset($_POST['submit'])){
                    $search = $_POST['search'];
                
                    $query = "SELECT * FROM `posts` WHERE `post_tags` LIKE '%$search%'";
                    $search_result = mysqli_query($conn, $query);
                
                    if(!$search_result){
                        die("failed to search because " . mysqli_error($conn));
                    }
                
                    $count = mysqli_num_rows($search_result);
                
                    if($count === 0){
                        echo "<h1>No Result Found</h1>";
                    }else {       
                        while($row = mysqli_fetch_assoc($search_result)){
                           $post_title = $row['post_title'];
                           $post_author = $row['post_author'];
                           $post_date = $row['post_date'];
                           $post_image = $row['post_image'];
                           $post_content = $row['post_content'];
                           ?>
                           <h2>
                             <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title;?></a>
                           </h2>
                           <p class="lead">
                               by <a href="index.php"><?php echo $post_author; ?></a>
                           </p>
                           <p><span class="glyphicon glyphicon-time"></span> Posted on <?php dateFormat($post_date) ?></p>
                           <hr>
                           <a href="post.php?p_id=<?php echo $post_id; ?>">
                           <img class="img-responsive" src="images/<?php echo "header-img.jpg"; ?>" alt="">
                           </a>
                           <hr>
                           <p><?php echo $post_content; ?></p>
                           <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
       
                           <hr>
            <?php }
                    }
                 }
                 ?>



                 

            </div>
            <!-- side bar -->
            <?php include "include/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'include/footer.php'?>