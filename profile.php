<?php
session_start();
error_reporting(0);
require_once('include/connection.php');
if (strlen($_SESSION["uid"]) == 0) {
    header('location:login.php');
} else {


    if (isset($_POST['submit'])) {
        $uid = $_SESSION['uid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];        
        $city = $_POST['address'];
        $mobile = $_POST['contact'];
        $uname = $_POST['username'];
                
        $sql = "update user set fname=:fname,lname=:lname,address=:address,contact=:contact,username=:username where userID=:uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);        
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':contact', $mobile, PDO::PARAM_STR);
        $query->bindParam(':username', $uname, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();
        //$msg="<script>toastr.success('Mobile info updated Successfully', {timeOut: 5000})</script>";
        echo "<script>alert('Profile has been updated.');</script>";
        echo "<script> window.location.href =profile.php;</script>";
    }


?>
    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        <title>Fitness Center | Profile</title>
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
                        <h2>Profile</h2>
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
                            <div class="row">
                                <?php
                                $uid = $_SESSION['uid'];
                                $sql = "SELECT userID, fname, lname, email, contact, password, address,username from user where userID=:uid ";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {                ?>
                                        <div class="col-md-6">
                                            <input type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off" value="<?php echo $result->fname; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="lname" id="lname" placeholder="Last Name" autocomplete="off" value="<?php echo $result->lname; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="email" id="email" placeholder="Email" autocomplete="off" value="<?php echo $result->email; ?>" readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" name="address" id="address" placeholder="Address" autocomplete="off" value="<?php echo $result->address; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="contact" id="contact" placeholder="Contact" autocomplete="off" value="<?php echo $result->contact; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" value="<?php echo $result->username; ?>">
                                        </div>
                                                                              
                                        <div class="col-md-12">
                                            <input type="submit" id="submit" name="submit" value="Update" class="site-btn sb-gradient">

                                        </div>
                                <?php }
                                } ?>
                            </div>
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