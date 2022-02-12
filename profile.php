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
                        <a class="collapse-item" href="moderate.php">Moderation</a>
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
                                            <but class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </but ton>
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
                                    class="mr-2 d-none d-lg-inline text-gray-800"> <i class="fas fa-ghost"
                                        style="color:#4e73df"></i>
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
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                    </div>





                    <!-- Card -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> BADGES </h6>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <!-- Badges -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">

                                                    <div class="text font-weight-bold text-primary text-uppercase mb-1">
                                                        first
                                                        contribution </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-shoe-prints fa-3x" style="color:#4e73df"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">

                                                    <div class="text font-weight-bold text-primary text-uppercase mb-1">
                                                        community
                                                        builder </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-hammer fa-3x" style="color:#4e73df"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">

                                                    <div class="text font-weight-bold text-primary text-uppercase mb-1">
                                                        Diamond Contributor </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-gem fa-3x" style="color:#4e73df"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">

                                                    <div class="text font-weight-bold text-primary text-uppercase mb-1">
                                                        Ambassador </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-medal fa-3x" style="color:#4e73df"></i>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- card end -->











                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">STATS</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Percentage Reports Moderated <span
                                    class="float-right">18%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 18%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold"> Impact Factor <span class="float-right">65%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Total Reports Approved <span
                                    class="float-right">57%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: 57%" aria-valuenow="60"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold"> Total Reports Denied <span
                                    class="float-right">80%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Total Reports Submitted <span
                                    class="float-right">7</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 28%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

















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