<?php

 define('DB', 'localhost');
 define('DB_User', 'root');
 define('DB_Pass', '');
 define('DB_Name', 'cms');

 $conn = mysqli_connect(DB, DB_User, DB_Pass, DB_Name);

 if(!$conn){
    echo 'connection failed';
 }
?>