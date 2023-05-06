<?php session_start();
error_reporting(0);
include  'include/connection.php';
if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {

//Delete Record Data

if(isset($_REQUEST['del']))
{
$uid=intval($_GET['del']);
$sql = "delete from testimonial WHERE tID=:id";
$query = $dbh->prepare($sql);
$query-> bindParam(':id',$uid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Record Deleted successfully');</script>";
echo "<script>window.location.href='manage_test.php'</script>";
}

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="description" content="Vali is a responsive">

        <title>Admin | Manage Testimonials </title>
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
                        <div class="tile-body">
                            <h3>Manage Testimonials</h3>
                            <hr />
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Title</th>                                    
                                        <th>Description</th>
                                        <th>Date Added</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <?php
                                include  'include/connection.php';
                                $sql = "SELECT * FROM testimonial";
                                $query = $dbh->prepare($sql);

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
                                                <td><?php echo htmlentities($result->description); ?></td>
                                                <td><?php echo htmlentities($result->date_added); ?></td>
                                                <?php $id = $result->tID; ?>
                                                <td>

                                                    <a href="edit_test.php?pid=<?php echo htmlentities($result->tID); ?>"><span class="btn btn-success">Edit</span>
                                                    <a href="manage_test.php?del=<?php echo htmlentities($result->tID);?>"><button class="btn btn-danger" type="button">Delete</button></a></td>
                                                </td>
                                            </tr>


                                        </tbody>

                                        <!--    // end modal popup code........ -->
                                <?php $cnt = $cnt + 1;
                                    }
                                } ?>
                            </table>
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
        <!-- The javascript plugin to display page loading on top-->
        <script src="js/plugins/pace.min.js"></script>
        <!-- Page specific javascripts-->
        <!-- Data table plugin-->
        <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $('#sampleTable').DataTable();
        </script>

    </body>

    </html>
<?php } ?>