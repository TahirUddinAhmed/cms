<?php  include "include/DB_Conn.php"; ?>
 <?php  include "include/header.php"; ?>

 <?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $con_password = $_POST['con_password'];

        

        // validate the registration form
        if(!empty($username) && !empty($email) && !empty($password)){
            // clean all the fields
            $username = mysqli_real_escape_string($conn, $username);
            $email = mysqli_real_escape_string($conn, $email);
            $password = mysqli_real_escape_string($conn, $password);
            $con_password = mysqli_real_escape_string($conn, $con_password);

            // // password encription
            // $query = "SELECT `randSalt` FROM `users`";
            // $select_pass_result = mysqli_query($conn, $query);

            // check the connection
            // if(!$select_pass_result){
            //     die('QUERY FAILED' . mysqli_error($conn));
            // }

            // $row = mysqli_fetch_assoc($select_pass_result);
            // $salt = $row['randSalt'];
            // password encryption
            

            // check for password matches
            if($password === $con_password){
                $password = password_hash($password, PASSWORD_DEFAULT);
                // insert data into db
                $query = "INSERT INTO `users` (`username`, `user_password`, `user_email`, `user_role`, `date`) ";
                $query .= "VALUES ('$username', '$password', '$email', 'subscriber', current_timestamp())";
                $insert_user_result = mysqli_query($conn, $query);

                if(!$insert_user_result){
                    die('QUERY FAILED' . mysqli_error($conn));
                }else {
                $message = "<p class='text-success'>Your Acoount has been created successfully</p>";
                }

            }

            
        }else {
            $message = "<p class='text-danger'>Fields cannot be empty</p>";
        }

        
    }else {
        $message = "";
    }

 ?>


    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message ?? null; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" maxlength="15" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Confirm Password</label>
                            <input type="password" name="con_password" id="key" class="form-control" placeholder="Confirm Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
