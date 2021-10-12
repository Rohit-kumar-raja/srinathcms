<?php

use Dompdf\FrameDecorator\Inline;

$page_no = "10";
$page_no_inside = "6_2";
include "include/authentication.php";
include './include/config.php';
?>
<?php
$sql = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' && `admission_username` = '" . $_SESSION["logger_username1"] . "'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$student_mobile = $row['admission_mobile_student'];
// here to getting attendance of user
$attendace_query = "SELECT * FROM `tbl_attendance` WHERE  `student_id` IN(SELECT student_id FROM tbl_student WHERE `parent_mob_no_2`='$student_mobile')";
$attendace_result = mysqli_query($con_attendance, $attendace_query);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRINATH UNIVERSITY | Dashboard</title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script>
        $(function() {
            var current = location.pathname;
            $('#nav li a').each(function() {
                var $this = $(this);
                // if the current path is like this link, make it active
                if ($this.attr('href').indexOf(current) !== -1) {
                    $this.addClass('active');
                }
            })
        })
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="page-title">Attendance Sheet</h4>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="main-wrapper">

                    <div class="page-wrapper">
                        <div class="content">
                            <div class="row">
                                <div class="col-sm-12">

                                </div>
                            </div>
                            <div class="row filter-row">
                                <div class="col-sm-6 col-md-3">

                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group form-focus select-focus">
                                        <label class="focus-label">Select Year</label>
                                        <select class="form-control select floating">
                                            <option selected disabled>-Select-</option>
                                            <option>2017</option>
                                            <option>2016</option>
                                            <option>2015</option>
                                            <option>2014</option>
                                            <option>2013</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <br>
                                    <a href="#" class="btn btn-success"> Search </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Month</th>
                                                    <?php for ($i = 1; $i <= 31; $i++) {
                                                        echo '<th>' . $i . '</th>';
                                                    } ?>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 0; $i <= 12; $i++) { ?>
                                                    <tr>
                                                        <td><?php echo date('M', strtotime('+' . $i . ' month', strtotime(date("0"))));
                                                            $full_date = date('Y-' . $i . '');
                                                            ?></td>
                                                        <?php while ($attendace_row = mysqli_fetch_array($attendace_result)) {
                                                            $attendace_date = $attendace_row['attendance_date'];
                                                            $year = explode('-', $attendace_date)[0];
                                                            $month = explode('-', $attendace_date)[1];
                                                            $attendace_year_moth = $year . '-' . $month;
                                                            if ($attendace_row['attendance_status'] == 'Present') {
                                                        ?>
                                                                <td><i class="fa fa-check text-success"></i> </td>
                                                            <?php } elseif ($attendace_row['attendance_status'] == 'Absent') { ?>
                                                                <td><i class="fa fa-times text-danger"></i> </td>
                                                            <?php } else { ?>
                                                                <td><i class=""></i> </td>
                                                        <?php   }
                                                        } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <thead>
                                                <tr>
                                                    <th>Month</th>
                                                    <?php for ($i = 1; $i <= 31; $i++) {
                                                        $all_days =   date('l', strtotime('+' . $i . 'day', strtotime(date("0"))));

                                                        echo '<th>' .  $all_days . ' ' . '</th>';
                                                    } ?>

                                                </tr>
                                            </thead>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>




                <div class="sidebar-overlay" data-reff=""></div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <h5 class="m-0 text-dark">&emsp;&emsp;Hello, <a href="#"><?php echo ucfirst($row["admission_first_name"]) ?> </a>- Welcome to your dashboard
                            <br>&emsp;&emsp;If you want to update your profile information than please drop a message in <a href="complaint">Complaint Management</a>
                        </h5>
                    </div>
                </div>
            </section>
           
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include 'include/footer.php'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script type="text/javascript" src="js/moment-with-locales.js"></script>
    <!-- Calendar js -->
    <script src="./dist/js/calender.js"></script>
</body>

</html>


