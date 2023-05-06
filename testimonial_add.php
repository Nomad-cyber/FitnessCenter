<?php
session_start();
error_reporting(0);
require_once('include/connection.php');
if (strlen($_SESSION["uid"]) == 0) {
    header('location:login.php');
} else {


    if (isset($_POST['submit'])) {
        $uid = $_SESSION['uid'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        if (empty($title) || empty($description)) {
            $nameerror = "Fill all fields";
        }

        $sql = "INSERT INTO testimonial (userID,title,description) Values(:userid,:title,:description)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':userid', $uid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId > 0) {
            echo "<script>alert('Testimonial submitted successfully');</script>";
            echo "<script> window.location.href='testimonials.php';</script>";
        } else {
            $error = "Testimony not logged";
        }
    }


?>
    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        <title>Fitness Center | Testimonial</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <!-- Main Stylesheets -->
        <link rel="stylesheet" href="css/style.css" />

    </head>

    <body>
        <!-- Header Section -->
        <?php include 'include/header.php'; ?>
        <!-- Page top Section -->
        <section class="page-top-section set-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 m-auto text-white">
                        <h2>Add Testimonial</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page top Section end -->

        <!-- Contact Section -->
        <section class="contact-page-section spad overflow-hidden">
            <div class="container">

                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8">
                        <form class="singup-form contact-form" method="post">
                            <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($succmsg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($succmsg); ?> </div><?php } ?><br><br>
                            <form class="singup-form contact-form" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="title" id="title" placeholder="Title" autocomplete="off" value="" required>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea type="text" name="description" id="description" placeholder="Description" autocomplete="off" value="" rows="4" cols="50" required></textarea>
                                    </div>                                
                                    <div class="col-md-12">
                                        <input type="submit" id="submit" name="submit" value="Add" class="site-btn sb-gradient">

                                    </div>
                                </div>
                            </form>
                        </form>
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div>
            </div>
        </section>
        <!-- Trainers Section end -->
        <!-- Footer Section -->
        <?php include 'include/footer.php'; ?>
        <!-- Footer Section end -->

        <!--====== Javascripts & Jquery ======-->
        <script src="js/vendor/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>

    </html>
<?php } ?>

<style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #dd3d36;
        color: #fff;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }

    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #5cb85c;
        color: #fff;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }
</style>