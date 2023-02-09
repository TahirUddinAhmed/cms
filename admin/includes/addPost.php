<?php

 // add post form 
 if(isset($_POST['submit'])){
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['status'];
    $post_content = $_POST['content'];

    // make sure it is an image
    $allowed_ext = array('png', 'jpg', 'jpeg', 'gif');

    
    // image
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $image_size = $_FILES['post_image']['size'];
    $target_dir = "../images/$post_image";

    
    $image_ext = explode('.', $post_image);
    $image_ext = strtolower(end($image_ext));


    $post_tags = $_POST['tags'];


    // check image
    if(in_array($image_ext, $allowed_ext)){
        if($image_size <= 5000000){
            // image upload
            move_uploaded_file($post_image_temp, $target_dir);

            // insert all the data in the database
            
            $sql = "INSERT INTO `posts` (`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`, `edit_by`)"; 
            $sql .= "VALUES ('$post_category_id', '$post_title', '$post_author', current_timestamp(), '$post_image', '$post_content', '$post_tags', '$post_status', '".$_SESSION['user_id']."')";
            $post_insert_result = mysqli_query($conn, $sql);

            if(!$post_insert_result){
                die("ERROR" . mysqli_error($conn));
            }else{
                $added = "<p>Post is Uploaded. <a href='posts.php'> View Post </a></p>";
                // header("Location: posts.php?source=addPost");
            }
        }else {
            $message = '<p class="text-danger">Image size is too large, image size should be less than 500KB.</p>';
        }
    }else{
        $message = '<p class="text-danger">Only .png, .jpg, .jpen and .gif allowed</p>';
    } 

 }

?>

<?php 
  if(isset($added)){
?>
    <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $added ?>
   </div>
<?php
  }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-select" aria-label="Default select example" name="post_category" id="">
        <?php
            $sql = "SELECT * FROM `category`";
            $category_result = mysqli_query($conn, $sql);

            if(!$category_result){
                die("QUERY FAILED" . mysqli_error($conn));
            }
               echo "<option>Choose Category</option>";
            while($row = mysqli_fetch_assoc($category_result)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<option value='$cat_id'>$cat_title</option>";
            }
        ?>
        
        </select>
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author" class="form-control">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" name="tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="status" id="">
            <option value="draft">Select Option</option>
            <option value="Published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
        <p class="text-muted"><?php echo $message ?? null; ?></p>
    </div>
    

    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="submit" name="submit" class="btn btn-lg btn-primary">
    </div>
</form>