<?php
    if(isset($_POST['update_user'])){
        $user_id = $_POST['user_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['user_email'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];

        // clean the password
        $user_password = mysqli_real_escape_string($conn, $user_password);

        $allowed_ext = array('png', 'jpg', 'jpeg');

        $user_profile = $_FILES['user_image']['name'];
        $profile_temp = $_FILES['user_image']['tmp_name'];
        $image_size = $_FILES['user_image']['size'];
        $dir = "./users/$user_profile";

        $image_ext = explode('.', $user_profile);
        $image_ext = strtolower(end($image_ext));

        if(!empty($user_profile)){

        //check it is an image
        if(in_array($image_ext, $allowed_ext)){
            // image size
            if($image_size <= 5000000){
                move_uploaded_file($profile_temp, $dir);
            }else {
                $message = '<p class="text-danger">Image size should be less than 500KB</p>';
            }
        }else {
            $message = '<p class="text-danger">Only .png, .jpg, .jpeg are allowed</p>';
        }
    }else {
        $query = "SELECT * FROM `users`WHERE `users`.`user_id` = {$user_id}";
        $profile_result = mysqli_query($conn, $query);

        while($row=mysqli_fetch_assoc($profile_result)){
            $user_profile = $row['user_image'];
        }
    }

    // password encryption
    $hash = password_hash($user_password, PASSWORD_DEFAULT);
    $query = "UPDATE `users` SET ";
    $query .= "`username` = '$username', `user_password` = '$hash', `user_firstname` = '$firstname', ";
    $query .= "`user_lastname` = '$lastname', `user_email` = '$user_email', ";
    $query .= "`user_image` = '$user_profile', `user_role` = '$user_role' WHERE `users`.`user_id` = $user_id";
    $update_user_result = mysqli_query($conn, $query);

    // check the connection
    if(!$update_user_result){
        die('QUERY FAILED' . mysqli_error($conn));
    }
    }


    if(isset($_GET['u_id'])){
        $the_user_id = $_GET['u_id'];
        $query = "SELECT * FROM `users`WHERE `users`.`user_id` = {$the_user_id}";
        $get_user_result = mysqli_query($conn, $query);

        // check the connection
        if(!$get_user_result){
            die('QUERY FAILED'. mysqli_error($conn));
        }
    }
    

?>
<form action="" method="post" enctype="multipart/form-data">
<h2 class="text-center">Edit User</h2>

<?php

    // fetch all the data from DB
    while($row = mysqli_fetch_assoc($get_user_result)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $f_name = $row['user_firstname'];
        $l_name = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
    ?>
        <div class="from-group">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        </div>
        <div class="from-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $f_name; ?>">
        </div>
        <div class="from-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $l_name; ?>">
        </div>
        <div class="from-group">
        <label for="user_role">User Role</label>
            <select name="user_role" id="">
                <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                <?php 

                    if($user_role == 'admin'){
                       echo "<option value='subscriber'>subscriber</option>";
                    }else {
                        echo "<option value='admin'>admin</option>";
                    }
                ?>    
            </select>
        </div>
        <div class="from-group">
            
            <label for="user_image">Profile</label>
            <img src="./users/<?php echo $user_image; ?>" class="img-responsive" width="50" alt="">
            <input type="file" value="<?php echo $user_profile; ?>" name="user_image" class="form-control">
            <p class="text-muted"><?php echo $message ?? null; ?></p>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" >
        </div>
        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
        </div>



        <div class="from-group">
            <label for="user_password">Password</label>
            <input type="password" name="user_password" class="form-control" value="<?php echo $user_password; ?>">
        </div>
        <div class="from-group mt-5">
            <input type="submit" name="update_user" value="Edit User" class="btn btn-lg btn-primary ">
        </div>


<?php

    }

?>   
</form>
