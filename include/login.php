<?php include "DB_Conn.php" ?>
<?php session_start() ?>
<?php
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        // read user 
        $query = "SELECT * FROM `users` WHERE `username` = '{$username}' AND `users`.`user_status` = 'approved'";
        $select_user_result = mysqli_query($conn, $query);

        // check the connection
        if(!$select_user_result){
            die('QUERY FAILED' . mysqli_error($conn));
        }

        // fetch some user data from DB
        while($row=mysqli_fetch_assoc($select_user_result)){
            $DB_user_id = $row['user_id'];
            $DB_username = $row['username'];
            $DB_user_password = $row['user_password'];
            $DB_user_firstname = $row['user_firstname'];
            $DB_user_lastname = $row['user_lastname'];
            $DB_user_role = $row['user_role'];
            $DB_user_email = $row['user_email'];
            $DB_user_image = $row['user_image'];
        }

        if(password_verify($password, $DB_user_password)){
            $_SESSION['username'] = $DB_username; 
            $_SESSION['user_id'] = $DB_user_id;
            $_SESSION['firstname'] = $DB_user_firstname;
            $_SESSION['lastname'] = $DB_user_lastname;
            $_SESSION['user_role'] = $DB_user_role;
            $_SESSION['user_password'] = $DB_user_password;
            $_SESSION['user_email'] = $DB_user_email;
            $_SESSION['user_image'] = $DB_user_image;
            // redirect -> admin page
            header("Location: ../admin");
        }else {
            // redirect -> home page
            header("Location: ../index.php");
        }
        // check for login
        // if($username === $DB_username && $password === $DB_user_password){
            
        
    }

?>