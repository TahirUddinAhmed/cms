<?php 
    if(isset($_POST['create_user'])){
        $f_name = $_POST['firstname'];
        $l_name = $_POST['lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // clean password fields
        $user_password = mysqli_real_escape_string($conn, $user_password);

        // allowed extension
        $allowed_ext = array('png', 'jpg', 'jpeg');

        $user_profile = $_FILES['user_image']['name'];
        $profile_temp = $_FILES['user_image']['tmp_name'];
        $image_size = $_FILES['user_image']['size'];
        $dir = "./users/$user_profile";

        $image_ext = explode('.', $user_profile);
        $image_ext = strtolower(end($image_ext));

        //check it is an image
        if(in_array($image_ext, $allowed_ext)){
            // image size
            if($image_size <= 5000000){
                move_uploaded_file($profile_temp, $dir);

                $hash = password_hash($user_password, PASSWORD_DEFAULT);
                // insert query
                $insert_query = "INSERT INTO `users` (`username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `date`) ";
                $insert_query .= "VALUES ('$username', '$hash', '$f_name', '$l_name', '$user_email', '$user_profile', '$user_role', '', current_timestamp())";
                $user_insert_result = mysqli_query($conn, $insert_query);

                // check the connection
                if(!$user_insert_result){
                    die('QUERY FAILED' . mysqli_error($conn));
                }else {
                    echo 'User Account is created' . ' ' . "<a href='users.php'> View User </a>";
                }
            }else {
                $message = '<p class="text-danger">Image size should be less than 500KB</p>';
            }
        }else {
            $message = '<p class="text-danger">Only .png, .jpg, .jpeg are allowed</p>';
        }

        

        
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="from-group">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" class="form-control">
    </div>
    <div class="from-group">
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" class="form-control">
    </div>
    <div class="from-group">
    <label for="user_role">User Role</label>
     <select name="user_role" id="">
        <option value="subscriber">Select Options</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
     </select>
    </div>
    <div class="from-group">
        <label for="user_image">Profile</label>
        <input type="file" name="user_image" class="form-control">
        <p class="text-muted"><?php echo $message ?? null; ?></p>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>
    
    
    
    <div class="from-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <div class="from-group mt-5">
        <input type="submit" name="create_user" value="Add User" class="btn btn-lg btn-primary ">
    </div>
</form>