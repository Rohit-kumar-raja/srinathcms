<?php
$page_no = "9";
$page_no_inside = "9_2";
include "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRINATH UNIVERSITY | Admission Enquiry </title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<?php include 'include/navbar.php'; ?>
<?php include 'include/aside.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Prospectus Enquiry</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Prospectus</a></li>
                            <li class="breadcrumb-item active">Prospectus Enquiry</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger card-outline">
                        <div class="card-header card-warning">
                            <div class="form-group float-left mb-0">
                                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="dynamicChangeLimit">
                                    <option selected="selected">5</option>
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>75</option>
                                    <option>100</option>
                                    <option>125</option>
                                    <option>150</option>
                                    <option>175</option>
                                    <option>200</option>
                                    <option>250</option>
                                    <option>500</option>
                                    <option>1000</option>
                                    <option>2000</option>
                                    <option>5000</option>
                                    <option>10000</option>
                                    <option>All</option>
                                </select>
                            </div>
                            <form method="POST" action="export-list" class="float-right mb-0">
                                <input type="hidden" name="action" value="export_all_prospectus_details" />
                                <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-download"></i> Export All</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" id="data_table">

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-12">
                    <div class="card card-danger card-outline">
                        <div class="card-header card-warning">
                            <center>
                                <div class="btn-group">
                                    <button type="button" class="pr-2 pl-2 btn btn-default pagiNation" id="optionPre" name="options" value="pre">Pre</button>
                                    <button type="button" class="pr-2 pl-2 btn btn-danger pagiNation" id="option1" name="options" value="1">1</button>
                                    <button type="button" class="pr-2 pl-2 btn btn-default pagiNation" id="option2" name="options" value="2">2</button>
                                    <button type="button" class="pr-2 pl-2 btn btn-default pagiNation" id="dynamicChangeNumber" name="options" value="3">3</button>
                                    <button type="button" class="pr-2 pl-2 btn btn-default" value="">...</button>
                                    <button type="button" class="pr-2 pl-2 btn btn-default pagiNation" id="optionNext" name="options" value="next">Next</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <?php include 'include/footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'include/view.php?action=get_nsuniv-admission-enquiry',
                type: 'GET',
                success: function(result) {
                    $("#data_table").html(result);
                }
            });
        });
    </script>
</body>

</html>