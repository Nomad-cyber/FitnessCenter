<?php
$page = 'home';
session_start();
error_reporting(0);
include 'include/connection.php';
$uid = $_SESSION['uid'];

if (isset($_POST['submit'])) {
    $pid = $_POST['sid'];


    $sql = "INSERT INTO booking (sID,userID) Values(:sid,:uid)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':sid', $pid, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Service has been booked.');</script>";
    echo "<script>window.location.href='booking.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="eng">

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
    <!-- Header Section end -->

    <!-- Page top Section -->
    <section class="page-top-section set-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto text-white">
                    <h2>Home</h2>
                    <p>Physical Activity Or You Can Improve Your Health</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>Features</h2>
                <p>Checkout our features and special offers!</p>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="images/1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Healthy Diet</h5>
                            <p class="card-text">Maintain healthy eating habits with the help of our world class experts. Get tips on leaving a healthy life style.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="images/2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Outdoor</h5>
                            <p class="card-text">Become part of the exercise team and enjoy the outdoors with the help of a qualified trainer.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="images/3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Yoga</h5>
                            <p class="card-text">Enjoy yoga with friends at special discounts offered to groups of four. Become one with the spirit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Top Services -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>Pricing offers</h2>
                <p>Practice Yoga to perfect physical beauty, take care of your soul and enjoy life more fully!</p>
            </div>
            <div class="row">
                <?php

                $sql = "SELECT sID, title, type, duration, pricing, description, date_added from service";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="pricing-item begginer">
                                <div class="pi-top">
                                    <h4><?php echo $result->title; ?></h4>
                                </div>
                                <div class="pi-price">
                                    <h3><?php echo htmlentities($result->pricing); ?></h3>
                                    <p> <?php echo $result->duration; ?></p>
                                </div>
                                <ul>
                                    <?php echo $result->description; ?>

                                </ul>
                                <?php if (strlen($_SESSION['uid']) == 0) : ?>
                                    <br>
                                    <a href="login.php" class="site-btn sb-line-gradient">Book Now</a>
                                <?php else : ?>
                                    <form method='post'>
                                        <input type='hidden' name='sid' value='<?php echo htmlentities($result->sID); ?>'>


                                        <input class='site-btn sb-line-gradient' type='submit' name='submit' value='Book Now' onclick="return confirm('Do you really want to book this service?');">
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php $cnt = $cnt + 1;
                    }
                } ?>
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