<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $cat_title = $_POST['cat_title'];
    $update_query = "UPDATE `category` SET `cat_title` = '$cat_title' WHERE `category`.`cat_id` = $id";
    $update_result = mysqli_query($conn, $update_query);

    if (!$update_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        echo "Updated";
    }
}
?>

<?php
if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    $query = "SELECT * FROM `category` WHERE `category`.`cat_id` = {$cat_id}";
    $category_result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($category_result)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
?>
        <form action="categories.php" method="post">
            <div class="form-group">
                <input value="<?php if (isset($cat_id)) {
                                    echo $cat_id;
                                } ?>" type="hidden" name="id" class="form-control">
                <label for="cat-title">Edit Category</label>
                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" type="text" name="cat_title" class="form-control">
            </div>
            <input type="submit" name="update" class="btn btn-primary" value="Update">
        </form>
<?php

    }
}

?>