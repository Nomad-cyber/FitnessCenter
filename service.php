<?php
$page = 'service';
session_start();
error_reporting(0);
include 'include/connection.php';
$uid = $_SESSION['uid'];

?>
<!DOCTYPE html>
<html lang="eng">

<head>
    <title>Fitness Center | Services</title>
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
                    <h2>Services</h2>                    
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
                                <a href="service_details.php?serviceid=<?php echo htmlentities($result->sID); ?>"><button class="site-btn sb-line-gradient" type="button">View</button></a>                               
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