<?php
$page_no = "3";
$page_no_inside = "3_1";
include "include/authentication.php";
?>
<?php
$sql = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' && `admission_username` = '" . $_SESSION["logger_username1"] . "'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRINATH UNIVERSITY | Pay Fee </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">

    </script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        table,
        th,
        td {
            border-collapse: collapse;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini" oncontextmenu="return false;">
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="padding: 0px 0.5rem;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pay Fee</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Pay Fee</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Pay Fee</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>
                        </div>-->
                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-md-12" id="error_section"></div>
                                    <div class="col-md-5">
                                        <label>Student Registration No</label>
                                        <input type="text" name="studentRegistrationNo" value="<?php echo $row["admission_id"]; ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px;">
                                        <button type="submit" id="fetchStudentDataButton" onclick="completeCalculation()" class="btn btn-info btn-block">Go</button>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <hr style="width:80%;">
                            </center>
                            <div class="col-12" id="loader_section"></div>
                        </form>
                        <div class="col-12" id="loader_section"></div>
                        <div id="data_table" class="col-md-12" style="margin-top: -35px;">

                        </div>
                    </div>

                </div>

        </div>
        </section>
        <!-- /.content -->
    </div>

    <?php include 'include/footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page script -->

    <script>
        function completeCalculation() {
            var totalPaid = 0;
            var totalParticular = 0;
            var fineAmount = 0;
            var rebateAmount = Number(document.getElementById("rebate_amount").value);
            if (rebateAmount > 0) {
                if (document.getElementById("rebate_from").value == "") {
                    $("#rebate_amount").addClass("is-invalid");
                    $("#rebateErr").html("~ Please select 'Rebate From'");
                } else {
                    $("#rebate_amount").removeClass("is-invalid");
                    $("#rebateErr").html("");
                }
            } else {
                $("#rebate_amount").removeClass("is-invalid");
                $("#rebateErr").html("");
            }
            var remainingAmount = 0;
            <?php
            $Idno = 0;
            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
            ?>
                if (document.getElementById("particular_paid_amount[<?php echo $Idno; ?>]").value != "")
                    totalParticular = totalParticular + parseInt(document.getElementById("particular_paid_amount[<?php echo $Idno; ?>]").value);
            <?php
                $Idno++;
            }
            ?>
            if (document.getElementById("fine_amount").value != "")
                fineAmount = parseInt(document.getElementById("fine_amount").value);
            //firstName = '<%= Session["FirstName"] ?? "" %>';

            totalPaid = totalPaid + parseInt(totalParticular);
            totalPaid = totalPaid + parseInt(fineAmount);
            remainingAmount = parseInt(<?php echo $totalRemainings; ?>) - parseInt(totalPaid) - parseInt(rebateAmount);
            //$("#total_amount").val(totalPaid);
            //$("#total_amount").val(remainingAmount);
            $("#amount").val(totalPaid + ".0");
            //$("#remaining_amount").val(remainingAmount);
            //$("#remaining_amount").val(0);
            if (0 > parseInt(remainingAmount)) {
                $("#remaining_amount").addClass("is-invalid");
                $("#remainingErr").html("~ Cannot use negative value, Remaining value must be 'greater than or equal to 0'");
                $("#totalErr").html("~ Total value must be 'less than or equal to <?php echo $totalRemainings; ?>'");
                $("#total_amount").addClass("is-invalid");
            } else {
                $("#remaining_amount").removeClass("is-invalid");
                $("#total_amount").removeClass("is-invalid");
                $("#remainingErr").html("");
                $("#totalErr").html("");
            }
        }



        document.onkeydown = function(e) {
            if (event.keyCode == 123) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }

            if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
            }

            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        }


        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#fetchStudentDataForm').submit(function(event) {
                $('#loader_section').append('<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>');
                $('#fetchStudentDataButton').prop('disabled', true);
                $.ajax({
                    url: 'include/view.php?action=fetch_student_fee_details',
                    type: 'POST',
                    data: $('#fetchStudentDataForm').serializeArray(),
                    success: function(result) {
                        //$("#data_table").html(result);
                        $('#response').remove();
                        if (result == 0) {
                            $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please enter Registration Number!!!</div></div>');
                        } else if (result == 1) {
                            $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>');
                        } else {
                            //$('#fetchStudentDataForm')[0].reset();
                            $('#data_table').append('<div id = "response">' + result + '</div>');
                        }
                        $('#loading').fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#fetchStudentDataButton').prop('disabled', false);
                    }
                });
                event.preventDefault();
            });
        });
    </script>
    <script src="./dist/js/Remaingcheck.js"></script>
</body>
<<<<<<< HEAD
  <script src="./dist/js/Remaingcheck.js"></script>
=======
<!-- somthing is changed  -->
>>>>>>> 9d0283c37ada8b74adfe68a4f7f6700faa1883e3
</html>
