<?php
    // fetch all the users from the database
    $query = "SELECT * FROM `users`";
    $read_user_result = mysqli_query($conn, $query);

    // check the connection
    if(!$read_user_result){
        die('QUERT FAILED' . mysqli_error($conn));
    }


    // change to admin
    if(isset($_GET['change_to_admin'])){
        $the_user_id = $_GET['change_to_admin'];

        $query = "UPDATE `users` SET `user_role` = 'admin' WHERE `user_id` = {$the_user_id}";
        $change_to_admin_result = mysqli_query($conn, $query);

        // check the connection
        if(!$change_to_admin_result){
            die('QUERY FAILED' . mysqli_error($conn));
        }else {
            header("Location: users.php");
        }
    }

    // change to subscriber
    if(isset($_GET['change_to_sub'])){
        $the_user_id = $_GET['change_to_sub'];

        $query = "UPDATE `users` SET `user_role` = 'subscriber' WHERE `user_id` = {$the_user_id}";
        $change_to_sub_result = mysqli_query($conn, $query);

        // check the connection
        if(!$change_to_sub_result){
            die('QUERY FAILED' . mysqli_error($conn));
        }else {
            header("Location: users.php");
        }
    }


    // delete query 
    if(isset($_GET['delete'])){

        
        $the_user_id = $_GET['delete'];

        // query 
        $query = "DELETE FROM `users` WHERE `users`.`user_id` = {$the_user_id}";
        $delete_result = mysqli_query($conn, $query);

        // check the connection
        if(!$delete_result){
            die('QUERY FAILED' . mysqli_error($conn));
        }else {
            header("Location: users.php");
        }
    }

?>
<table class="table table-bordered table-hover">
    
    <thead>
        <tr>
            <th>ID</th>
            <th>User Image</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>date</th>
            <th colspan="2" class="text-center">Change User Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        // check the number of rows
        if(mysqli_num_rows($read_user_result) > 0){
            while($row=mysqli_fetch_assoc($read_user_result)){
                $user_id = $row['user_id'];
                $user_image = $row['user_image'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
                $date = $row['date'];
                
        ?>
            <tr>
                <td><?php echo $user_id; ?></td>
                <td><img class="img-responsive" width="100" src="./users/<?php echo $user_image; ?>" alt=""></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $user_firstname; ?></td>
                <td><?php echo $user_lastname; ?></td>
                <td><?php echo $user_email; ?></td>
                <td><?php echo $user_role; ?></td>
                <td><?php dateFormat($date) ?></td>
                <td>
                    <!-- Change to admin -->
                    <a href="users.php?change_to_admin=<?php echo $user_id; ?>">Admin</a>
                </td>
                <td>
                    <!-- change to subscriber -->
                    <a href="users.php?change_to_sub=<?php echo $user_id; ?>">Subscriber</a>
                </td>
                <td>
                    <!-- delete -->
                    <a class="delBtn" href="users.php?delete=<?php echo $user_id; ?>">delete</a>
                    <a href="users.php?source=edit_user&u_id=<?php echo $user_id; ?>">Edit</a>
                </td>
            </tr>


        <?php
            
            }
        }else {
            echo '<p class="text-center">There is no user</p>';
        }
    ?>
        
    </tbody>
</table>

<script>
    // get the button
    const delBtn = document.querySelectorAll(".delBtn");

    // add event listener
    
    delBtn.forEach(btn => {
      btn.addEventListener("click", function(){
       confirm("Press a button!");
      });

    })
    

    
    
        

</script>