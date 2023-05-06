<?php 
session_start();
error_reporting(0);
require_once('include/connection.php');
?>
  <!DOCTYPE html>
  <html lang="eng">

  <head>
    <title>Services | Details</title>
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
            <h2>Service Details</h2>

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
                <?php $serviceid = $_GET['serviceid'];
                $sql = "SELECT sID, title, type, duration, pricing, description, date_added FROM service where sID=:serviceid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':serviceid', $serviceid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {
                ?>
                    <tr>
                      <th>Title</th>
                      <td><?php echo $result->title; ?></td>
                      <th>Type</th>
                      <td><?php echo $result->type; ?></td>
                    </tr>
                    <tr>
                      <th>Duration</th>
                      <td><?php echo $result->duration; ?></td>
                      <th>Pricing</th>
                      <td><?php echo $result->pricing; ?></td>
                    </tr>
                    <tr>                      
                      <th>Date Added</th>
                      <td><?php echo $result->date_added; ?></td>                      
                    </tr>
                    
                    <tr>
                      <th>Description</th>
                      <td colspan="3"><?php echo $result->description; ?></td>
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