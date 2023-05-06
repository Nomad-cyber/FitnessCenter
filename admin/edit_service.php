<?php session_start();
error_reporting(0);
include  'include/connection.php';
if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {

    $pid = $_GET['pid'];
    if (isset($_POST['Submit'])) {
        $title = $_POST['title'];
        $type = $_POST['type'];
        $duration = $_POST['duration'];
        $price = $_POST['Price'];
        $description = $_POST['description'];

        $sql = "update service set title=:title,type=:type,duration=:duration,pricing=:pricing,description=:description where sID=:pid";

        $query = $dbh->prepare($sql);
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':duration', $duration, PDO::PARAM_STR);
        $query->bindParam(':pricing', $price, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':pid', $pid, PDO::PARAM_STR);
        $query->execute();
        // Mesage after updation
        echo "<script>alert('Record Updated successfully');</script>";
        // Code for redirection
        echo "<script>window.location.href='manage_service.php'</script>";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="description" content="Vali is a">
        <title>Admin | Edit Service</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="app sidebar-mini rtl">
        <!-- Navbar-->
        <?php include 'include/header.php'; ?>
        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <?php include 'include/sidebar.php'; ?>
        <main class="app-content">

            <div class="row">

                <div class="col-md-12">
                    <div class="tile">
                        <!---Success Message--->
                        <?php if ($msg) { ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                            </div>
                        <?php } ?>

                        <!---Error Message--->
                        <?php if ($errormsg) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($errormsg); ?>
                            </div>
                        <?php } ?>
                        <h3 class="tile-title">Update Service</h3>
                        <?php
                        include  'include/connection.php';
                        $sql = "SELECT * FROM service where sID=:pid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':pid', $pid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                        ?>
                                <div class="tile-body">
                                    <form class="row" method="post">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Title</label>
                                            <input class="form-control" name="title" id="title" type="text" value="<?php echo $result->title; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Type</label>
                                            <input class="form-control" name="type" id="type" type="text" value="<?php echo $result->type; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Duration</label>
                                            <input class="form-control" type="text" name="duration" name="duration" value="<?php echo $result->duration; ?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Price</label>
                                            <input class="form-control" type="text" name="Price" id="Price" value="<?php echo $result->pricing; ?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="5" rows="10"><?php echo $result->description; ?></textarea>
                                        </div>

                                        <div class="form-group col-md-4 align-self-end">
                                            <input type="Submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </form>
                                </div>
                        <?php $cnt = $cnt + 1;
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </main>
        <!-- Essential javascripts for application to work-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/plugins/pace.min.js"></script>
        <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(nicEditors.allTextAreas);
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </body>

    </html>

    <!-- Script -->
    <script>
        function getdistrict(val) {
            $.ajax({
                type: "POST",
                url: "ajaxfile.php",
                data: 'category=' + val,
                success: function(data) {
                    $("#package").html(data);
                }
            });
        }
    </script>
<?php } ?>