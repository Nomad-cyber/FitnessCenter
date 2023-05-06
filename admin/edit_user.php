<?php session_start();
error_reporting(0);
include  'include/connection.php';
if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {

    $pid = $_GET['pid'];
    if (isset($_POST['Submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];        
        $city = $_POST['address'];
        $mobile = $_POST['contact'];
        $uname = $_POST['username'];
                
        $sql = "update user set fname=:fname,lname=:lname,address=:address,contact=:contact,username=:username where userID=:uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);        
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':contact', $mobile, PDO::PARAM_STR);
        $query->bindParam(':username', $uname, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();
        // Mesage after updation
        echo "<script>alert('Record Updated successfully');</script>";
        // Code for redirection
        echo "<script>window.location.href='manage_user.php'</script>";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="description" content="Vali is a">
        <title>Admin | Edit User</title>
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
                        <h3 class="tile-title">Update User</h3>
                        <?php
                        include  'include/connection.php';
                        $sql = "SELECT * FROM user where userID=:pid";
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
                                            <label class="control-label">Firstname</label>
                                            <input class="form-control" name="fname" id="fname"  value="<?php echo $result->fname; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Lastname</label>
                                            <input class="form-control" name="lname" id="lname" value="<?php echo $result->lname; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Email</label>
                                            <input class="form-control" name="email" id="email" value="<?php echo $result->email; ?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Address</label>
                                            <input class="form-control" name="address" id="address" value="<?php echo $result->address; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Contact</label>
                                            <input class="form-control" name="contact" id="contact" value="<?php echo $result->contact; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Username</label>
                                            <input class="form-control" name="username" id="username" value="<?php echo $result->username; ?>">
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