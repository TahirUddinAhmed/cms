<?php include "includes/admin_header.php"; ?>
<?php isAdmin(); ?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                    <div class="col-xs-6">
                    <?php
                        // adding categories to the datadase
                        insert_category();
                    ?>

                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                            </div>
                        </form>
                        <!-- /Add Category Form -->

                        <!-- Edit Category Form -->
                        <?php include "includes/update_categories.php" ?>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php // find all categories
                             findAllCategories();
                            ?>

                            <!-- delete categories -->
                            <?php
                                delete_categories();
                            ?>
                            </tbody>
                        </table>
                    </div>

                    
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