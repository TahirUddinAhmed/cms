<?php

    $condition = '';
    if($_SESSION['user_role'] === "subscriber"){
        $condition = " WHERE `posts`.`edit_by` = '".$_SESSION['user_id']."'";
    }

    // pagination

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else {
        $page = "";
    }

    if($page == '' || $page == 1){
        $page_1 = 0;
    }else {
        $page_1 = ($page * 10) - 10;
    }


    $sql = "SELECT * FROM `posts`";
    $post_query_count = mysqli_num_rows(mysqli_query($conn, $sql));

    $post_count = ceil($post_query_count / 10); // if num of post is 4 then 4 / 2 = 2


    // write the query
    $sql = "SELECT * FROM `posts` $condition LIMIT $page_1, 10";
    $show_result = mysqli_query($conn, $sql);

    // check the connection
    if(!$show_result){
        die("QUERY FAILED" . mysqli_error($conn));
    }

    // delete functionality
    if(isset($_GET['id'])){
        $btn_id = $_GET['id'];
        $condition = '';
        if($_SESSION['user_role'] === "subscriber"){
            $condition = " AND `posts`.`edit_by` = '".$_SESSION['user_id']."'";
        }

        // delete query
        $query = "DELETE FROM `posts` WHERE `posts`.`post_id` = {$btn_id} $condition";
        $del_result = mysqli_query($conn, $query);

        // check the connection and delete the perticular posts
        if(!$del_result){
            die("QUERY FAILED" . mysqli_error($conn));
        }else {
            header("Location: posts.php");
        }
    }
?>

<?php
 if(isset($_POST['checkBoxArray'])){
    // WRITE A FOREACH LOOP TO LOOP THROUGH ALL THE DATA
    foreach($_POST['checkBoxArray'] as $postValue_id){
        $bulk_options = $_POST['bulkOptions'];
        
        switch($bulk_options){
            case 1: 
                echo "please select an option";
                break;
            case 2:
                // echo "query to published this post where post id " . $checkBox;
                // published
                mysqli_query($conn, "UPDATE `posts` SET `post_status` = 'Published' WHERE `posts`.`post_id` = $postValue_id");
                header("Location: posts.php");
                break;
            case 3:
                // draft
                mysqli_query($conn, "UPDATE `posts` SET `post_status` = 'draft' WHERE `posts`.`post_id` = $postValue_id");
                header("Location: posts.php");
                break;
            case 4:
                // delete
                mysqli_query($conn, "DELETE FROM posts WHERE `posts`.`post_id` = $postValue_id");
                header("Location: posts.php");
                break;   
        }
    }
 }
?>
<form action="" method="post">
<table class="table table-bordered table-hover">
    <div id="bulkOptionContainer" class="col-xs-4">
        <select name="bulkOptions" class="form-control" id="">
            <option value="1">Select Option</option>
            <option value="2">Publish</option>
            <option value="3">Draft</option>
            <option value="4">Delete</option>
        </select>
    </div>

    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=addPost">Add New</a>
    </div>

    <thead>
        <tr>
            <th><input type="checkbox" name="" id="selectAll"></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Image</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tboody>
    <?php
        $sno = 1;
        while($row = mysqli_fetch_assoc($show_result)){
            $id = $row['post_id'];
            $author = $row['post_author'];
            $title = $row['post_title'];
            $image = $row['post_image'];
            $category_id = $row['post_category_id'];
            $tags = $row['post_tags'];

            $comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $status = $row['post_status'];

            // change date format
            // $create_date = date_create($post_date);
            // $date = date_format($create_date, "dS M Y h:iA");
    ?>
        <tr>
            <td><input class="selectItem" type="checkbox" name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
            <td><?php echo $sno; ?></td>
            <td><?php echo $author; ?></td>
            <td><?php echo $title; ?></td>
            <td><img class="img-responsive" width="100" src="../images/<?php echo $image; ?>" alt=""></td>
            <td><?php echo $category_id; ?></td>
            <td><?php echo $tags; ?></td>
            <td><?php echo $comment_count; ?></td>
            <td><?php dateFormat($post_date) ?></td>
            <td><?php echo $status; ?></td>
            <td>
                <!-- delete & edit functionality -->
                <?php echo "<a href='posts.php?delete&id=$id' class='btn btn-danger'>Delete</a>";?>
                <?php echo "<a href='posts.php?source=edit_post&p_id=$id' class='btn btn-primary'>Edit</a>"; ?>
            </td>
        </tr>
    <?php
      $sno++;
        }
    ?>
        
    </tboody>
</table>
</form>
<ul class="pager">
    <!-- // loop -->
    <?php
    // use for loop 
    for($i = 1; $i <= $post_count; $i++){
        if($i == $page){
            echo "<li><a href='?page=$i' class='active_link'>$i</a></li>";
        }else {
            echo "<li><a href='?page=$i'>$i</a></li>";
        }
        
    }
    
    ?>
</ul>