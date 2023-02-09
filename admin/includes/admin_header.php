<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../include/DB_Conn.php" ?>
<?php include "functions.php" ?>
<?php
 if(!isset($_SESSION['user_role'])){
    
    header('Location: ../index.php');
    
 }

 

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Tahir Uddin Ahmed">

    <title>Admin Dashboard</title>
    <!-- google chart link -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- // edit CDN link -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="./css/summernote.css">

</head>

<body>