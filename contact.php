<?php  include "include/DB_Conn.php"; ?>
 <?php  include "include/header.php"; ?>

 <?php
   // sending email to the user
   if(isset($_POST['submit'])){
    $to = "tahir139141021@gmail.com";
    $sub = $_POST['subject'];
    $body = $_POST['body'];
    $header = $_POST['email'];

    mail($to, $sub, $body, $header);
   }

 ?>


 <!-- Navigation -->
    
 <?php  include "include/navigation.php"; ?>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Contact Us</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject..">
                        </div>
                         <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Enter Your message.."></textarea>
                        </div>
                        
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>



<?php include "include/footer.php";?>