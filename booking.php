<?php 
$page == 'booking';
session_start();
error_reporting(0);
require_once('include/connection.php');
if (strlen($_SESSION["uid"]) == 0) {
    header('location:login.php');
} else {
    $uid = $_SESSION['uid'];
?>
    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        <title><?php echo $_SESSION["name"] ?> | Bookings</title>
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
                        <h2>Service Bookings</h2>

                    </div>
                </div>
            </div>
        </section>
        <!-- Page top Section end -->

        <!-- Contact Section -->
        <section class="contact-page-section spad overflow-hidden">
            <div class="container">

                <div class="row">

                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Pricing</th>
                                    <th>Payment Type</th>
                                    <th>Date Booked</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <?php
                            $uid = $_SESSION['uid'];
                            /*$sql="select id, product_id, userid, product_title, packages, category, PackageDuratiobn, price, descripation, booking_date from tblbooking where userid=:uid";*/
                            $sql = "SELECT t1.bID, t1.paymentType as payment_type,t1.booking_date as dateB, t2.title as title,t2.type as typeS,t2.duration as duration,t2.pricing as pricing FROM booking as t1 join service as t2
                                    on t1.sID =t2.sID where t1.userID=:uid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                            ?>

                                    <tbody>
                                        <tr>
                                            <td><?php echo ($cnt); ?></td>
                                            <td><?php echo htmlentities($result->title); ?></td>
                                            <td><?php echo htmlentities($result->typeS); ?></td>
                                            <td><?php echo htmlentities($result->duration); ?></td>
                                            <td><?php echo $result->pricing; ?></td>
                                            <td><?php echo htmlentities($result->payment_type); ?></td>
                                            <td><?php echo htmlentities($result->dateB); ?></td>
                                            <td><a href="booking_details.php?bookingid=<?php echo htmlentities($result->bID); ?>"><button class="btn btn-primary" type="button">View</button></td>
                                        </tr>
                                <?php $cnt = $cnt + 1;
                                }
                            } ?>

                                    </tbody>
                        </table>
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
<?php } ?>