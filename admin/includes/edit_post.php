<?php
if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
}
if (isset($_POST['update_post'])) {
    $id = $_POST['id'];
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['status'];
    $post_content = $_POST['content'];

    $post_tags = $_POST['tags'];
    // $post_comment_count = 4;

    $currentTime = time();
    $post_date = date('y-m-d', $currentTime);

    // make sure it is an image
    $allowed_ext = array('png', 'jpg', 'jpeg', 'gif');

    // image
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $image_size = $_FILES['post_image']['size'];
    $target_dir = "../images/$post_image";

    $image_ext = explode('.', $post_image);
    $image_ext = strtolower(end($image_ext));

    // check for subscriber 
    $condition = '';
    if ($_SESSION['user_role'] === 'subscriber') {
        $condition = " AND `edit_by` = '" . $_SESSION['user_id'] . "'";
    }

    // check image
    if (!empty($post_image)) {
        if (in_array($image_ext, $allowed_ext)) {
            if ($image_size <= 5000000) {
                // image upload
                move_uploaded_file($post_image_temp, $target_dir);
            } else {
                $message = '<p class="text-danger">Image size is too large, image size should be less than 500KB.</p>';
            }
        } else {
            $message = '<p class="text-danger">Only .png, .jpg, .jpen and .gif allowed</p>';
        }
    } else {
        $query = "SELECT * FROM `posts` WHERE `post_id` = '$id' $condition";
        $select_img_result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($select_img_result)) {
            $post_image = $row['post_image'];
        }
    }
    // update query
    $query = "UPDATE `posts` SET `post_category_id` = '$post_category_id', `post_title` = '$post_title', ";
    $query .= "`post_author` = '$post_author', `post_date` = '$post_date', `post_image` = '$post_image', `post_content` = '$post_content', `post_tags` = '$post_tags', `post_status` = '$post_status' WHERE `posts`.`post_id` = $id";
    $update_post = mysqli_query($conn, $query);

    if (!$update_post) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        $update_msg = "<p>Posts Updated. <a href='../post.php?p_id=$post_id'>View Posts</a> or <a href='posts.php'> Edit Posts </a></p>";
    }
}



$query = "SELECT * FROM `posts` WHERE `posts`.`post_id` = {$post_id}";
$post_result = mysqli_query($conn, $query);


// fetch all the data from that post
while ($row = mysqli_fetch_assoc($post_result)) {
    $id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_category_id = $row['post_category_id'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_status = $row['post_status'];
    $post_content = $row['post_content'];
?>
    <p> <?php
        if (isset($update_msg)) {
        ?>
   <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $update_msg ?>
   </div>


<?php
        } else {
            $update_msg = '';
        }
?> <p>
<form action="" method="post" enctype="multipart/form-data">
    <h2>Edit Post</h2>


    <div class="form-group">
        <input type="hidden" value="<?php echo $id; ?>" name="id" class="form-control">
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" value="<?php echo $post_title; ?>" name="title" class="form-control">
    </div>

    <div class="form-group">
        <select class="form-select" aria-label="Default select example" name="post_category" id="">
            <!-- <option value=""><?php echo $post_category_id; ?></option> -->
            <?php
            $sql = "SELECT * FROM `category`";
            $category_result = mysqli_query($conn, $sql);

            if (!$category_result) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($category_result)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                if ($post_category_id === $cat_id) {
                    echo "<option value='$post_category_id'>$cat_title</option>";
                } else {
                    echo "<option value='$post_category_id'>$cat_title</option>";
                }
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" value="<?php echo $post_author; ?>" name="author" class="form-control">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" name="tags" class="form-control">
    </div>

    <div class="from-group">
        <label for="post_status">Post Status</label>
        <select name="status" id="">
            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php

            if ($post_status == 'Published') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='Published'>Published</option>";
            }
            ?>


        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" value="<?php echo $post_image; ?>" name="post_image">
        <p class="text-muted"><?php echo $message ?? null; ?></p>

    </div>


    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="summernote" cols="30" rows="10">
        <?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Update Post" name="update_post" class="btn btn-lg btn-primary">
    </div>
</form>
<?php
}

?>