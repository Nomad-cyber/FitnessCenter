<?php
error_reporting(0);
require_once('include/connection.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $uname = $_POST['username'];
    $Password = $_POST['password'];
    $pass = md5($Password);
    $RepeatPassword = $_POST['RepeatPassword'];

    // Email id Already Exit

    $usermatch = $dbh->prepare("SELECT email, username FROM user WHERE (email=:usreml || username=:usrname)");
    $usermatch->execute(array(':usreml' => $email, ':usrname' => $uname));
    while ($row = $usermatch->fetch(PDO::FETCH_ASSOC)) {
        $usrdbeml = $row['email'];
        $usrdbmble = $row['username'];
    }


    if (empty($fname)) {
        $nameerror = "Please Enter First Name";
    } else if (empty($mobile)) {
        $mobileerror = "Please Enter Contact No";
    } else if (empty($email)) {
        $emailerror = "Please Enter Email";
    } else if ($email == $usrdbeml || $uname == $usrdbmble) {
        $error = "Email Id or Username Already Exists!";
    } else if ($Password == "" || $RepeatPassword == "") {

        $error = "Password And Confirm Password Not Empty!";
    } else if ($_POST['password'] != $_POST['RepeatPassword']) {

        $error = "Password And Confirm Password Not Matched";
    } else {
        $sql = "INSERT INTO user (fname,lname,email,address,contact,username,password) Values(:fname,:lname,:email,:address,:contact,:username,:Password)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);        
        $query->bindParam(':address', $address, PDO::PARAM_STR);        
        $query->bindParam(':contact', $mobile, PDO::PARAM_STR);
        $query->bindParam(':username', $uname, PDO::PARAM_STR);
        $query->bindParam(':Password', $pass, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId > 0) {
            echo "<script>alert('Registration successfull. Please login');</script>";
            echo "<script> window.location.href='login.php';</script>";
        } else {
            $error = "Registration Not successfully";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Fitness Center</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <!-- Page Preloder -->


    <!-- Header Section -->
    <?php include 'include/header.php'; ?>
    <!-- Header Section end -->

    <!-- Page top Section -->
    <section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto text-white">
                    <h2>Registration</h2>
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
                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($succmsg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($succmsg); ?> </div><?php } ?><br><br>
                    <form class="singup-form contact-form" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off" value="<?php echo $fname; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="lname" id="lname" placeholder="Last Name" autocomplete="off" value="<?php echo $lname; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" value="<?php echo $email; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="mobile" id="mobile" maxlength="10" placeholder="Contact" autocomplete="off" value="<?php echo $mobile; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="address" id="address" placeholder="Address" autocomplete="off" value="<?php echo $address; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" value="<?php echo $uname; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="RepeatPassword" id="RepeatPassword" placeholder="Confirm Password" autocomplete="off" required>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" id="submit" name="submit" value="Join Now" class="site-btn sb-gradient">

                            </div>
                        </div>
                        <a class="row d-flex justify-content-center" href="login.php">Already a member?login</a>
                    </form>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>
    <!-- Footer Section end -->

    <!--====== Javascripts & Jquery ======-->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
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