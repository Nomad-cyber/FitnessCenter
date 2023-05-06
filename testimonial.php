<?php
$page = 'testimonial';
session_start();
error_reporting(0);
include 'include/connection.php';
$uid = $_SESSION['uid'];

?>
<!DOCTYPE html>
<html lang="eng">

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
    <!-- Header Section end -->

    <!-- Page top Section -->
    <section class="page-top-section set-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto text-white">
                    <h2>Testimonials</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Services -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">

            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-8">
                    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                        <div class="card-body p-4">
                            <div class="form-outline mb-4">
                                <input type="text" id="addANote" class="form-control" placeholder="Type testimony..." />
                                <br>
                                <td><a href="testimonial_add.php" /><button class="btn btn-success" type="button">Add</button></td>
                            </div>
                            <?php

                            $sql = "SELECT tID, t2.username as Name, t1.title as title, t1.description as description, t1.date_added as dateA from testimonial as t1 join user as t2 on t1.userID =t2.userID";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                            ?>

                                    <div class="card mb-4 d-flex">
                                        <div class="card-body">
                                            <p>Topic: <?php echo $result->title; ?></p>
                                            <p><?php echo $result->description; ?></p>

                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <p class="small mb-0 ms-2">From: <?php echo $result->Name; ?></p>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <p class="small text-muted mb-0">Upvote?</p>
                                                    <i class="fa fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                                                    <p class="small text-muted mb-0">3</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            <?php $cnt = $cnt + 1;
                                }
                            } ?>
                        </div>
                    </div>
                </div>
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