<?php
 function insert_category(){
    global $conn;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not empty";
        }else{
        $insert = "INSERT INTO `category` (`cat_title`) VALUES ('$cat_title')";
        $cat_query = mysqli_query($conn, $insert);


            if(!$cat_query){
                die("QUERY FAILED " . mysqli_error($conn));
            }
        }
    }
 }

 // find all categories
 function findAllCategories() {
    global $conn;

    $query = "SELECT * FROM `category`";
    $cat_result = mysqli_query($conn, $query);
                            
    $sno = 1;
        while($row = mysqli_fetch_assoc($cat_result)){
        ?>
        <tr>
            <td><?php echo $sno; ?></td>
            <td><?php echo $row['cat_title']; ?></td>
            <td>
                <?php echo "<a href='categories.php?delete={$row['cat_id']}'>Delete</a>"?>
                <?php echo "<a href='categories.php?edit={$row['cat_id']}'>Edit</a>"?>
                                
            </td>
                                    
        </tr>
    <?php
    $sno++;
        }
 }

 // delete categories
 function delete_categories(){
    global $conn;

    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM `categories` WHERE `categories`.`cat_id` = {$the_cat_id}";
        $delete_result = mysqli_query($conn, $query);
        header("Location: categories.php"); // refresh the page
        if(!$delete_result){
            die("QUERY FAILED " . mysqli_error($conn));
        }
    }
 }


 function isAdmin(){
    if($_SESSION['user_role'] === 'subscriber'){
        header("Location: posts.php");
    }
 }

 // change the date format
 function dateFormat($get_date){
    $create_date = date_create($get_date);
    $date = date_format($create_date, "dS M y h:iA");
    echo $date;
    return $date;
 }

?>