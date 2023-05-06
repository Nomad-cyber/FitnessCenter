<?php session_start();
error_reporting(0);
include  'include/connnection.php';
if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {
    include  'include/connection.php';
    if (isset($_POST['Submit'])) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $uname = $_POST['username'];
        $Password = $_POST['password'];
        $pass = md5($Password);

        // Email id Already Exit

        $usermatch = $dbh->prepare("SELECT email, username FROM user WHERE (email=:usreml || username=:usrname)");
        $usermatch->execute(array(':usreml' => $email, ':usrname' => $uname));
        while ($row = $usermatch->fetch(PDO::FETCH_ASSOC)) {
            $usrdbeml = $row['email'];
            $usrdbmble = $row['username'];
        }

        $sql = "INSERT INTO user (fname,lname,email,address,contact,username,password) Values(:fname,:lname,:email,:address,:contact,:username,:Password)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':contact', $mobile, PDO::PARAM_STR);
        $query->bindParam(':username', $uname, PDO::PARAM_STR);
        $query->bindParam(':Password', $pass, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId > 0) {
            echo "<script>alert('User added successfull');</script>";
            echo "<script> window.location.href='manage_user.php';</script>";
        } else {
            $error = "User Not added";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="description" content="Vali is a">
        <title>Admin | Add User</title>
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
            <h3> Add User </h3>
            <hr />
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
                        <div class="tile-body">
                            <form class="row" method="post">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Firstname</label>
                                    <input class="form-control" name="fname" id="fname" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Lastname</label>
                                    <input class="form-control" name="lname" id="lname" placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Email</label>
                                    <input class="form-control" name="email" id="email" placeholder="Your Email">
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Contact</label>
                                    <input class="form-control" name="mobile" id="mobile" maxlength="10" placeholder="Contact">
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Address</label>
                                    <input class="form-control"  name="address" id="address" placeholder="Address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Username</label>
                                    <input class="form-control" name="username" id="username" placeholder="Username">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Password</label>
                                    <input class="form-control" name="password" id="password" placeholder="Password"">
                                </div>

                                <div class="form-group col-md-4 align-self-end">
                                    <input type="Submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
                                </div>
                            </form>
                        </div>
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
<?php } ?>