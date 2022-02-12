<?php
session_start();

include("dbconnect.php");
include("function.php");

$user_data = check_login($con);
$user_name = $user_data['name'];

$message = 'nothing';


$query = "select * from report";
$result = mysqli_query($con, $query);

$num_row = mysqli_num_rows($result);


$text = array();
$name = array();

$i = 0;
while ($row = mysqli_fetch_array($result)) {

    $text[] = $row["report_post"];
    $name[] = $row["reporter_name"];
    $i = $i + 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Alert Notifications -->
    <!-- JS dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- bootbox code -->
    <script src="bootstrap.min.js"></script>
    <script src="bootbox.min.js"></script>
    <script src="bootbox.locales.min.js"></script>
    <script src="popper.min.js"></script>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stop Islamophobia</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <script>
    function alert_approve() {
        var dialog = bootbox.dialog({
            title: 'Thank you for the feedback!',
            centerVertical: true,

            message: '<i class="fas fa-server"></i> The report was<oo class="m-0 font-weight text-success"> approved</oo> and added to the database!',
            backdrop: true,
            closeButton: false
        });
    }

    function alert_deny() {
        var dialog = bootbox.dialog({
            title: 'Thank you for the feedback!',
            centerVertical: true,

            message: '<i class="fas fa-server"></i> The report was<oo class="m-0 font-weight text-danger"> denied</oo> and removed to the database!',
            backdrop: true,
            closeButton: false
        });
    }
    </script>

    <?php
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $id = $_GET['id'];

        if ($action == "approve") {
            $query = "UPDATE report SET approve='1' WHERE report_id='$id'";
            mysqli_query($con, $query);
            echo "<script> alert_approve(); </script>";
        } else {
            $query = "UPDATE report SET approve='-1' WHERE report_id='$id'";
            mysqli_query($con, $query);
            echo "<script> alert_deny(); </script>";
        }
    }
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_admin.php">
                <div class="sidebar-brand-text mx-3">Stop Islamophobia</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index_admin.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Nav Item - Report History -->
            <li class="nav-item">
                <a class="nav-link" href="report_history.php">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Report History</span></a>
            </li>


            <!-- Nav Item - Contact -->
            <li class="nav-item">
                <a class="nav-link" href="Contact.php">
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>Contact</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    <i class="fas fa-fw fa-flag"></i>
                    <span>Reporting</span>
                </a>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="report.php">Report New</a>
                        <a class="collapse-item active" href="moderate.php">Moderation</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-code" aria-hidden="true"></i>
                    <span>Model</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="report.php">Stats</a>
                        <a class="collapse-item" href="cards.html">Data</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message
            <div class="sidebar-card d-none d-lg-flex">
                <a class="btn btn-success btn-sm" href="report.php">Moderate Reports</a>
            </div>

            <div class="sidebar-card d-none d-lg-flex">
                <a class="btn btn-success btn-sm" href="report.php">Submit A Report!</a>
            </div> -->



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span onclick="location.href = 'profile.php';"
                                    class="mr-2 d-none d-lg-inline text-gray-800"> <i class="fas fa-ghost"></i>
                                    &nbsp; Hello,
                                    <?php echo $user_data['name']; ?> </span>

                            </a>

                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i onclick="location.href = 'login.php';" class="fas fa-sign-out-alt"
                                    style="color:#5a5c69"></i>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Moderate Reports</h1>
                    </div>



                    <!-- Illustration -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">How to moderate?</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/mod.svg"
                                    alt="...">
                            </div>

                            <p>Your purpose as a moderator is to accuratetly distinguish Islamophobic content from
                                non-Islamophobic content.
                                What constitutes Islamophobia is a vast topic that rests on the several important
                                factors like context, who posted or shared that context, meta data (date, time,
                                geolocation), etc.
                            <p>Explicitly, Islamophobic hate speech can be defined as “any content which is produced or
                                shared which expresses indiscriminate negativity against Islam or Muslims”.</p>
                            <p>Online anti-Muslim abuse occurring on social networking sites, such as Twitter, can be
                                categorized as being “cyber harassment,” “cyber bullying,” “cyber abuse,” etc.
                                This has become a growing concern nowadays.</p>

                            </p>
                            <br>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Taking Actions</h6>
                                </div>
                                <div class="card-body">
                                    If a report is valid and involves Islamophobic content, <a
                                        class="m-0 font-weight text-success">Approve</a> the report. <br>
                                    Otherwise if it does not contain Islamophobic hate speech, <a
                                        class="m-0 font-weight text-danger">Deny</a> the request.
                                </div>
                            </div>


                            <a target="_blank" rel="nofollow" href="https://en.wikipedia.org/wiki/Moderator">Read more
                                about our moderation
                                guidlines &rarr;</a>
                        </div>
                    </div>



                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Reports </h6>
                        </div> -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Report ID</th>
                                            <th>Time</th>
                                            <th>Username</th>
                                            <th>Content Link</th>
                                            <th>Content</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <th>Report ID</th>
                                        <th>Time</th>
                                        <th>Username</th>
                                        <th>Content Link</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tfoot> -->

                                    <tbody>

                                        <?php $con = mysqli_connect("localhost", "root", "", "stop_islamophobia") or die("Connection Error: " . mysqli_error($conn));
                                        $result = mysqli_query($con, "select * from report ORDER BY time");
                                        $i = 0;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $report_id = $row["report_id"];
                                            $approval = $row["approve"];
                                            $content = $row["report_post"];
                                        ?>

                                        <tr>
                                            <td><?= $report_id ?></td>
                                            <td><?= $row["time"] ?></td>
                                            <td><?= $row["reporter_name"] ?></td>
                                            <td><?= $row["report_link"] ?></td>
                                            <td><?= $row["report_post"] ?></td>

                                            <td>
                                                <?php
                                                    if ($approval == 1) {
                                                    ?>
                                                <p class="m-0 font-weight-bold text-success">APPROVED</p>
                                                <?php } elseif ($approval == -1) {
                                                    ?>
                                                <p class="m-0 font-weight-bold text-danger">DENIED</p>
                                                <?php
                                                    } else {

                                                    ?>
                                                <a class="btn btn-success btn-icon-split btn-sm"
                                                    href="moderate.php?action=approve&id=<?php echo $report_id ?>">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <span class="text">Approve</span>
                                                </a>

                                                <div class="my-2"></div>

                                                <a class="btn btn-danger btn-icon-split btn-sm"
                                                    href="moderate.php?action=deny&id=<?php echo $report_id ?>">

                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                    <span class="text"> Deny </span>
                                                </a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <?php
                                            $i++;
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Notification Modal-->
        <div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Approve this Report?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body"> This action will mark the report as Islamophobic
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="moderate.php?action=approve">Approve</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

</body>


</html>