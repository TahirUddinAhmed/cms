<?php include "includes/admin_header.php"; ?>

<?php
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        
        // query
        $query = "SELECT * FROM `users` WHERE `username` = '{$username}'";
        $select_profile_result = mysqli_query($conn, $query);

        // check the connection
        if(!$select_profile_result){
            die('QUERY FAILED' . mysqli_error($conn));
        }

        // fetch all the required user data from the database
        while($row = mysqli_fetch_assoc($select_profile_result)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $f_name = $row['user_firstname'];
            $l_name = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $user_password = $row['user_password'];
        }

    }
?>
    <div id="wrapper">

        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?></small>
                        </h1>
                       <h2>User Profile</h2>
     <form action="" method="post" enctype="multipart/form-data">

     <?php
        if(isset($_POST['update_profile'])){
             $user_id = $_POST['user_id'];
            // echo $username = $_POST['username'];
             $firstname = $_POST['firstname'];
             $lastname = $_POST['lastname'];
            //  $user_role = $_POST['user_role'];
             $user_email = $_POST['user_email'];
             $user_password = $_POST['user_password'];

             // update query 
             $query = "UPDATE `users` SET ";
             $query .= "`username` = '$username', `user_password` = '$user_password', `user_firstname` = '$firstname', ";
             $query .= "`user_lastname` = '$lastname', `user_email` = '$user_email', ";
             $query .= "WHERE `user_id` = $user_id";
             $update_user_profile = mysqli_query($conn, $query);

             // check the connection
             if(!$update_user_profile){
                die('QUERY FAILED' . mysqli_error($conn));
             }else {
                echo "User Profile Updated";
             }

        }
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
        <!-- <div class="from-group">
        <label for="user_role">User Role</label>
            <select name="user_role" id="">
                <option value="subscriber"><?php echo $user_role; ?></option>
                <?php 

                    // if($user_role == 'admin'){
                    //    echo "<option value='subscriber'>subscriber</option>";
                    // }else {
                    //     echo "<option value='admin'>admin</option>";
                    // }
                ?>

                
                
            </select>
        </div> -->
        <div class="from-group">
            
            <label for="user_image">Profile</label>
            <img src="./users/<?php echo $user_image; ?>" class="img-responsive" width="50" alt="">
            <input type="file" value="<?php echo $user_profile; ?>" name="user_image" class="form-control">
            <p class="text-muted"><?php echo $message ?? null; ?></p>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input disabled type="text" name="username" class="form-control" value="<?php echo $username; ?>" >
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
            <input type="submit" name="update_profile" value="Edit User" class="btn btn-lg btn-primary ">
        </div>   
</form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>