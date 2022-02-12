<!-- <script type="text/javascript">
Storage.prototype.setObj = function(key, obj) {
    return this.setItem(key, JSON.stringify(obj))
}
Storage.prototype.getObj = function(key) {
    return JSON.parse(this.getItem(key))
}

function storeData() {
    localStorage.setObj("messages", <?= $messages['content'] ?>);
    console.log(localStorage.getObj("messages"));
    // localStorage.setItem("array", JSON.stringify(<?php $messages ?>));
    // array = JSON.parse(localStorage.getItem("array"))
    // console.log(array);
}
</script> -->

<?php

// echo '<script>';
// echo 'console.log(' . json_encode($ , JSON_HEX_TAG) . ')';
// echo '</script>';

session_start();
$_SESSION['start_time'] = time();

include("dbconnect.php");
include("function.php");

$user_data = check_login($con);
$user_name = $user_data['name'];
// $message = 'nothing';
$result = mysqli_query($con, "select * from report");
$num_row = mysqli_num_rows($result);
$text = array();
$name = array();
//$hash_freq = array();
$q_ht = mysqli_query(
    $con,
    "SELECT freq FROM hashtag_frequency LIMIT 20"
);

$rows = array();
while ($row = mysqli_fetch_array($q_ht, MYSQLI_NUM)) {
    array_push($rows, strval($row[0]));
}
// echo json_encode($rows);
$rows_implode = implode(("."), $rows);


setcookie(
    "hashtag_data",
    $rows_implode
);


/////////////////////////////////


$q_nm = mysqli_query(
    $con,
    "SELECT tags FROM hashtag_frequency LIMIT 10"
);

$rows_nm = array();
while ($row = mysqli_fetch_array($q_nm, MYSQLI_BOTH)) {
    array_push($rows_nm, strval($row[0]));
}
// echo json_encode($rows);
$rows_implode_nm = implode(("."), $rows_nm);

setcookie(
    "hashtag_name",
    $rows_implode_nm
);


/////////////////////////////////

$i = 0;
while ($row = mysqli_fetch_array($result)) {

    $text[] = $row["report_post"];
    $name[] = $row["reporter_name"];
    $i = $i + 1;
}

/////////////////////////////////
// $new_message = "";
// $message_count = 0;
// $messages = array(
//     'icon' => array(),
//     'time' => array(),
//     'content' => array(),
// );

// function newMessage($icon_name, $content_string)
// {
//     global $messages;
//     global $new_message;

//     array_push($messages["icon"], $icon_name);
//     array_push($messages["time"], date('Y-m-d H:i:s'));
//     array_push($messages["content"], $content_string);

//     $new_message = "show";
// }

// if (isset($_GET['notification'])) {
//     $notification = $_GET['notification'];

//     if ($notification == "report_submitted") {
//         newMessage("check", "Thank you! Your report has been submitted for a review");
//         //echo "<script> storeData(); </script>";
//     }
// }

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
    <script src="https://kit.fontawesome.com/7b0591ce58.js" crossorigin="anonymous"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">


    <!-- Alert Notifications -->
    <!-- JS dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- bootbox code -->
    <script src="bootstrap.min.js"></script>
    <script src="bootbox.min.js"></script>
    <script src="bootbox.locales.min.js"></script>
    <script src="popper.min.js"></script>

    <script>
    function alert_submitSuccessful() {
        var dialog = bootbox.dialog({
            centerVertical: true,
            title: "Thank you!",
            message: "Your report has been submitted and pending a review",
            backdrop: true,
            closeButton: false
        });
    }

    function alert_options() {
        bootbox.confirm({
            message: "This is a confirm with custom button text and color! Do you like it?",
            backdrop: true,
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                console.log('This was logged in the callback: ' + result);
            }
        });
    }
    </script>

    <?php
    if (isset($_GET['notification'])) {
        $notification = $_GET['notification'];

        if ($notification == "report_submitted") {
            echo "<script> alert_submitSuccessful(); </script>";
        }
    }
    ?>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_admin.php">
                <div class="sidebar-brand-text mx-3"> Stop Islamophobia </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <!-- <div class="row">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            </b><?php
                                $j = 0;
                                while ($j != $num_row) {
                                    echo $text[$j];

                                    $j = $j + 1;
                                }
                                ?><b>
                        </div><br><br>
                    </div> -->

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Reports Submitted Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Reports Submitted </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $num_row ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x" style="color:#4e73df"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Data Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Tweets Analyzed </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= mysqli_num_rows(mysqli_query($con, "select * from data")) ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fab fa-twitter fa-2x" style="color:#36b9cc"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Hashtags Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Hashtags </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= mysqli_num_rows(mysqli_query($con, "select * from hashtag_frequency")) ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hashtag fa-2x" style="color:#1cc88a"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Most Hashtag Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Most Used Hashtag </div>
                                            <?php
                                            $q = mysqli_query(
                                                $con,
                                                "SELECT tags FROM hashtag_frequency LIMIT 1"
                                            );
                                            $v = "";
                                            while ($row = mysqli_fetch_array($q, MYSQLI_BOTH)) {
                                                $v = strval($row[0]);
                                            }
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $v ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-exclamation-triangle fa-2x" style="color:#e74a3b"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Hashtag Frequency Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Reports Stats</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-secondary"></i> Un-moderated
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Approved
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Denied
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; No Islamophobia 2021</span>
                    </div>
                </div>
            </footer> -->
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="node_modules/jquery/dist/jquery.min.js"></script> -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>

    <script src="js/piechart_reports.js"></script>
    <script src="js/barchart_hashtags.js"></script>

</body>

</html>