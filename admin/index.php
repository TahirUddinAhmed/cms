<?php include "includes/admin_header.php"; ?>


    <div id="wrapper">

        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            
                            <small><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></small>
                        </h1>




                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->
                
                       
                <!-- /.row -->
    <?php
        $condition = '';
        $condition1 = '';
        if($_SESSION['user_role'] === 'subscriber'){
            $condition = " WHERE `posts`.`edit_by` = '".$_SESSION['user_id']."'";
            $condition1 = " WHERE `comments`.`author_id` = '".$_SESSION['user_id']."'";
        }
    ?>
                
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                    <?php
                        // get the number of posts from DB
                        $query = "SELECT * FROM `posts` $condition";
                        $post_num_result = mysqli_query($conn, $query);
                        $posts_count = mysqli_num_rows($post_num_result);
                        
                    ?>
                    
                    
                        <div class='huge'><?php echo $posts_count; ?></div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                        <?php
                            // get number of comment
                            $query = "SELECT * FROM `comments` $condition1";
                            $comment_num_result = mysqli_query($conn, $query);
                            $comments_count = mysqli_num_rows($comment_num_result);
                        ?>

                        
                            <div class='huge'><?php echo $comments_count; ?></div>
                            <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <?php if($_SESSION['user_role'] !== 'subscriber') { ?>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                        <?php 
                         // get num of users
                         $query = "SELECT * FROM `users`";
                         $user_num_result = mysqli_query($conn, $query);
                         $users_count = mysqli_num_rows($user_num_result);

                        ?>
                        

                            <div class='huge'><?php echo $users_count; ?></div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                        <?php
                         // get number of categories
                         $query = "SELECT * FROM `category`";
                         $category_num_result = mysqli_query($conn, $query);
                         $categories_count = mysqli_num_rows($category_num_result);

                        ?>
                                <div class='huge'><?php echo $categories_count; ?></div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
         <?php } ?>
        </div>
        <!-- /.row -->

        <?php 
            // published post
            $query = "SELECT * FROM `posts` WHERE `post_status` = 'Published'";
            $active_post_count = mysqli_num_rows(mysqli_query($conn, $query));

            // show the draft posts
            $query = "SELECT * FROM `posts` WHERE `post_status` = 'draft'";
            $select_daft_result = mysqli_query($conn, $query);
            $draft_post_count = mysqli_num_rows($select_daft_result);

            // show the unapprove comments
            $query = "SELECT * FROM `comments` WHERE `comment_status` = 'Unaprroved'";
            $select_comment_unapprove = mysqli_query($conn, $query);
            $comment_unapprove_count = mysqli_num_rows($select_comment_unapprove);

            // show user subscriber
            $query = "SELECT * FROM `users` WHERE `user_role` = 'subscriber'";
            $user_subscriber_result = mysqli_query($conn, $query);
            $subscriber_count = mysqli_num_rows($user_subscriber_result);

       
        ?>

        <div class="row">
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Data', 'Count'],
                

                <?php
                 // create two arrays for hold the chart data
                 $elements_text = ['All Posts', 'Active Posts', 'Draft Posts', 'comments', 'Pending Comments', 'users', 'Subscribers', 'Categories'];
                 $elements_count = [$posts_count, $active_post_count, $draft_post_count, $comments_count,$comment_unapprove_count, $users_count, $subscriber_count , $categories_count];

                 // loop
                 for($i = 0; $i < 8; $i++){
                    echo "['{$elements_text[$i]}'" . "," . "{$elements_count[$i]}],";
                 }
                ?>
                
                
                ]);

                var options = {
                chart: {
                    title: '',
                    subtitle: '',
                }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
            </script>

            <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
        </div>






            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>