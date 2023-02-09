<?php 
 include 'include/DB_Conn.php';
 include 'include/header.php'

?> 
<?php include 'include/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
            <?php 
                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
                }

                $query = "SELECT * FROM `posts` WHERE `post_id` = {$the_post_id}";
                $the_post_result = mysqli_query($conn, $query);

                if(!$the_post_result){
                    die("QUERY FAILED" . mysqli_error($conn));
                }

                while($row = mysqli_fetch_assoc($the_post_result)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    // change the date format
                    $date_create = date_create($post_date);
                    $date = date_format($date_create, "dS M y h:iA");
                ?>
                    <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                    <!-- Author -->
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $the_post_id; ?>"><?php echo $post_author; ?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span> <?php dateFormat($post_date) ?></p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                    <hr>

                    <!-- Post Content -->
                    <p class="lead"><?php echo $post_content; ?></p>
                    


                <?php
                }
            ?>
            

                
                <hr>

                <!-- Blog Comments -->
                <?php
                // query to get the user id
                    $query = "SELECT * FROM `users`";
                    $get_id_result = mysqli_query($conn, $query);

                    // loop through users
                    while($row = mysqli_fetch_assoc($get_id_result)){
                        $the_user_id = $row['user_id'];
                    }
                    if(isset($_POST['create_comment'])){
                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['email'];
                        $comment_content = $_POST['content'];
                        // $date = date('y-m-d');

                        // query to insert comments
                        $query = "INSERT INTO `comments` (`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_date`, `comment_status`, `author_id`) ";
                        $query .= "VALUES ('$the_post_id', '$comment_author', '$comment_email', '$comment_content', current_timestamp(), 'unapproved', '$the_user_id')";
                        $comment_result = mysqli_query($conn, $query);

                        if(!$comment_result){
                            die('QUERY FAILED' . mysqli_error($conn));
                        }else {
                            echo 'your comment is posted';
                        }


                        // comment increament
                        $query = "UPDATE `posts` SET `post_comment_count` = `post_comment_count` + 1 ";
                        $query .= "WHERE `post_id` = $the_post_id";
                        $update_comment_count = mysqli_query($conn, $query);

                    }

                ?>


                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="POST" action="">
                        <div class="form-group">
                            <label for="comment_author">Name</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="useremail">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content">Comment</label>
                            <textarea class="form-control" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                    $id = $_GET['p_id'];
                    // query to read comments
                    $query = "SELECT * FROM `comments` WHERE `comment_post_id` = $id AND `comment_status` = 'Aprroved'";
                    $select_comment_result = mysqli_query($conn, $query);

                    // check the connection
                    if(!$select_comment_result){
                        die("QUERY FAILED" . mysqli_error($conn));
                    }
                    // getting all the data from DB
                    while($row = mysqli_fetch_assoc($select_comment_result)){
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];

                    ?>
                        <!-- Parent comment-->
                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                        <div class="ms-3">
                        <div class="fw-bold"><?php echo $comment_author; ?></div>
                        <?php echo $comment_content; ?>                                        
                    </div>
                    <?php
                    }
                ?>
            </div>
                <!-- sidebar -->
                <?php include "include/sidebar.php"; ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>
<?php include "include/footer.php" ?>   