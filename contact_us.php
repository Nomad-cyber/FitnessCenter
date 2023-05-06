<?php
$page = 'contact';
session_start();
error_reporting(0);
include 'include/connection.php';
$uid = $_SESSION['uid'];

if (isset($_POST['submit'])) {
    $pid = $_POST['pid'];


    $sql = "INSERT INTO booking (sID,userID) Values(:pid,:uid)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Package has been booked.');</script>";
    echo "<script>window.location.href='booking-history.php'</script>";
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
                    <h2>Contact US</h2>
                </div>
            </div>
        </div>
    </section>



    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="container">

            <div class="row">

                <div class="col-lg-12 col-sm-6">
                    <p><strong>Email:</strong> info@yourdomain.com</p>
                    <p><strong>Contact No:</strong> 1234567890, 1122334455</p>
                    <p><strong>Address:</strong> Test Address</p>
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