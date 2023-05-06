<?php
session_start();
error_reporting(0);
require_once('include/connection.php');
$msg = "";
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = md5(($_POST['password']));
    if ($email != "" && $password != "") {
        try {
            $query = "select userID, fname, lname, email, address, contact, username, password from user where email=:email and password=:password";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count == 1 && !empty($row)) {
                /******************** Your code ***********************/
                $_SESSION['uid']   = $row['userID'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['username'];
                header("location: index.php");
            } else {
                $msg = "Invalid username and password!";
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    } else {
        $msg = "Both fields are required!";
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

    <!-- Header Section -->
    <?php include 'include/header.php'; ?>

    <!-- Page top Section -->
    <section class="page-top-section set-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto text-white">
                    <h2>Login</h2>

                </div>
            </div>
        </div>
    </section>

    <!-- Login Section -->
    <section class="pricing-section spad">
        <div class="container">

            <div class="row">
                <div class="col-lg-3 col-sm-6">

                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="pricing-item entermediate">
                        <div class="pi-top">

                        </div>
                        <div class="pi-price">
                            <h3>User</h3>
                            <p>Login</p>
                        </div>
                        <?php if ($error) { ?><div class="errorWrap" style="color:red;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" style="color:red;"><strong>Error</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

                        <form class="singup-form contact-form" method="post">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10">
                                    <input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" required>
                                </div>
                                <div class="col-md-10">
                                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10">
                                    <input type="submit" id="submit" name="submit" value="Login" class="site-btn sb-gradient">
                                </div>
                                <div class="col-md-5">

                                    
                                </div>
                            </div>
                            <a href="Registration.php" >Join Now</a>

                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">

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