<?php session_start(); ?>

<?php
    $_SESSION['username'] =null; 
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] =null;
    $_SESSION['user_role'] = null;

    // redirect to the home page
    header("Location: ../index.php");

?>