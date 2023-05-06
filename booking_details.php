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

    <!-- Page top Section -->
    <section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 m-auto text-white">
            <h2>Booking Details</h2>

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
            <table class="table table-hover table-bordered">
              <thead>
                <?php $bookindid = $_GET['bookingid'];
                $sql = "SELECT t1.bID as bookingid,t3.fname as Name, t3.email as email,t1.booking_date as bookingdate,t2.title as title,t2.duration as duration,
                        t2.pricing as price,t2.description as description,paymentType,payment FROM booking as t1 join service as t2 on t1.sID =t2.sID
                        join user as t3 on t1.userID=t3.userID where t1.bID=:bookindid";

                $query = $dbh->prepare($sql);
                $query->bindParam(':bookindid', $bookindid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {
                ?>
                    <tr>
                      <th>Name</th>
                      <td><?php echo $result->Name; ?></td>
                      <th>Email</th>
                      <td><?php echo $result->email; ?></td>
                    </tr>
                    <tr>                      
                      <th>Title</th>
                      <td><?php echo $result->title; ?></td>
                      <th>Booking Date</th>
                      <td><?php echo $result->bookingdate; ?></td>
                    </tr>
                    <tr>
                      <th>Service Duration</th>
                      <td><?php echo $result->duration; ?></td>
                      <th>Pricing</th>
                      <td><?php echo $result->price; ?></td>

                    </tr>
                    <tr>
                      <th>Description</th>
                      <td colspan="3"><?php echo $result->Description; ?></td>
                    </tr>
                    <tr>
                      <th>PaymentType</th>
                      <td colspan="3"><?php $ptype = $result->paymentType;

                                      if ($ptype == '') :
                                        echo "Payment not made yet";
                                      else :
                                        echo $ptype;
                                      endif;
                                      ?></td>

                    </tr>
                <?php $cnt = $cnt + 1;
                  }
                } ?>
              </thead>
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