<?php
    
    $condition = '';
    $condition1 = '';
    if($_SESSION['user_role'] === 'subscriber'){
        $condition = " WHERE `comments`.`author_id` = '".$_SESSION['user_id']."'";
        $condition1 = " AND `author_id` = '".$_SESSION['user_id']."'";
    }
    // write the query
    $sql = "SELECT * FROM `comments` $condition";
    $show_result = mysqli_query($conn, $sql);

    // check the connection
    if(!$show_result){
        die("QUERY FAILED" . mysqli_error($conn));
    }

    // unapprove
    if(isset($_GET['approve'])){
        $the_comment_id = $_GET['approve'];
        $query = "UPDATE `comments` SET `comment_status` = 'Aprroved' WHERE `comment_id` = '$the_comment_id' $condition1 ";
        $approve_result = mysqli_query($conn, $query);

        if(!$approve_result){
            die("QUERY FAILED" . mysqli_error($conn));
        }else {
            header("Location: comments.php");
        }
        
    }

    // unapprove
    if(isset($_GET['unapprove'])){
        $the_comment_id = $_GET['unapprove'];
        $query = "UPDATE `comments` SET `comment_status` = 'Unaprroved' WHERE `comment_id` = '$the_comment_id' $condition1";
        $unapprove_result = mysqli_query($conn, $query);

        if(!$unapprove_result){
            die("QUERY FAILED" . mysqli_error($conn));
        }else {
            header("Location: comments.php");
        }
        
    }

    // delete functionality
    if(isset($_GET['id'])){
        $comment_id = $_GET['id'];

        // delete query
        $query = "DELETE FROM `comments` WHERE `comments`.`comment_id` = '{$comment_id}' $condition1";
        $del_result = mysqli_query($conn, $query);

        // check the connection and delete the perticular posts
        if(!$del_result){
            die("QUERY FAILED" . mysqli_error($conn));
        }else {
            header("Location: comments.php");
        }
    }
?>
<table class="table table-bordered table-hover">
    <h1 class="text-center">Comments</h1>
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comments Content</th>
            <th>In Respose to</th>
            <th>Status</th>
            <th>Date</th>
            <th>Approved</th>
            <th>Unapproved</th>
            <th>Action</th>
        </tr>
    </thead>
    <tboody>
    <?php
        while($row = mysqli_fetch_assoc($show_result)){
            $id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $email = $row['comment_email'];
            $comment_date = $row['comment_date'];
            $status = $row['comment_status'];

            $create_format = date_create($comment_date);

            $date = date_format($create_format, "dS M y h:iA");
    ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $author; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $comment_content; ?></td>
            <?php
                $query = "SELECT * FROM `posts` WHERE `post_id` =$comment_post_id";
                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];

                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }
            ?>

            
            <td><?php echo $date; ?></td>
            <td><?php echo $status; ?></td>
            <td>
                <!-- Approve -->
                <?php echo "<a href='comments.php?approve=$id' class='btn btn-success'>Approve</a>";?>
                
            </td>
            <td>
                <!-- Unapprove -->
                <?php echo "<a href='comments.php?unapprove=$id' class='btn btn-danger'>Unapprove</a>";?>
                
            </td>
            <td>
                <!-- delete & edit functionality -->
                <?php echo "<a href='comments.php?delete&id=$id' class='btn btn-danger'>Delete</a>";?>
                

            </td>
        </tr>
    <?php

        }
    ?>
        
    </tboody>
</table>