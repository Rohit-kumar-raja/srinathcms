<?php
$page_no = "16";
$page_no_inside = "16_3";
include '../Backend/connection.inc.php';

$get_event = "SELECT *
FROM participants_list
GROUP BY college_name
ORDER BY id ASC;";
$event_result = mysqli_query($connection, $get_event);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRINATH UNIVERSITY | Event </title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="./event_hindi_inc/css/main.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <?php
        // included the file for inserting the event and updating the event

        include './event_hindi_inc/event_hindi/insert.php'; ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Participants</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Participants</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-7">

                    </div>
                    <div class="col-sm-5">
                        <form action="../srinath/event_hindi_inc/export/participants.php" >

                            <div class="container">
                                <div class="row">
                                    <div class=" form-group col-sm-8">

                                     

                                    </div>
                                    <div class=" form-group col-sm-4">
                                        <button type="submit" class="btn  btn-warning">
                                            Export
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-body">


                        </div>
                        <div class="col-12">
                            <!-- /.card-header -->
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="th-sm">S.NO
                                            </th>
                                            <!-- <th class="th-sm">Name
                                                </th>
                                                <th class="th-sm">department
                                                </th>
                                                <th class="th-sm">Father
                                                </th>
                                                <th class="th-sm">DOB
                                                </th>
                                                <th class="th-sm">gender
                                                </th>
                                                <th class="th-sm">student_mobile
                                                </th>
                                                <th class="th-sm">student_email
                                                </th>
                                                <th class="th-sm">student_whatsapp
                                                </th>
                                                <th class="th-sm">student_address
                                                </th>
                                                <th class="th-sm">student_imgages
                                                </th>
                                                <th class="th-sm">event_name
                                                </th> -->
                                            <th class="th-sm text-center">name
                                            </th>
                                            <th class="th-sm text-center">type
                                            </th>
                                            <th class="th-sm text-center">board name
                                            </th>
                                            <th class="th-sm">affiliated_name
                                            </th>

                                            <th class="th-sm text-center">mobile
                                            </th>
                                            <th class="th-sm text-center">Email
                                            </th>
                                            <th class="th-sm">country
                                            </th>
                                            <th class="th-sm">state
                                            </th>
                                            <th class="th-sm text-center">city
                                            </th>
                                            <th class="th-sm text-center">pincode
                                            </th>
                                            <th class="th-sm text-center">address1
                                            </th>
                                            <th class="th-sm text-center">address2
                                            </th>
                                            <th class="th-sm text-center">Print
                                            </th>
                                            <th class="th-sm text-center">Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($get_row = mysqli_fetch_array($event_result)) {


                                        ?>
                                            <!-- Button trigger modal -->


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?php echo $get_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Term & Conditions</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $get_row['t&c']; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <!-- <td><?php // echo $get_row['s_name']; ?></td> 
                                                    <td><?php // echo $get_row['s_department']; ?></td>
                                                    <td><?php //echo $get_row['s_f_name']; ?></td>
                                                    <td><?php // echo $get_row['s_dob']; ?></td>
                                                    <td><?php // echo $get_row['s_gender']; ?></td>
                                                    <td><?php // echo $get_row['s_mobile']; ?></td>
                                                    <td><?php // echo $get_row['s_email']; ?></td>
                                                    <td><?php // echo $get_row['s_whatsapp']; ?></td>
                                                    <td><?php // echo $get_row['s_address']; ?></td>
                                                    <td>
                                                       
                                                            <img class="img-fluid" src=<?php //echo  ' "data:image/jpeg;base64,' . base64_encode($get_row["s_imgages"]) . '" ' ?>>

  
                                                    </td>

                                                    <td><?php // $event = str_replace("[", " ", $get_row['event_name']);
                                                      //  $event = str_replace("]", " ", $event);
                                                      //  echo str_replace('"', " ", $event);
                                                        ?></td> -->
                                                <td><?php echo $get_row['college_name']; ?></td>
                                                <td><?php echo $get_row['type']; ?></td>
                                                <td><?php echo $get_row['board_name']; ?></td>
                                                <td><?php echo $get_row['affiliated_name']; ?></td>
                                                <td><?php echo $get_row['mobile']; ?></td>
                                                <td><?php echo $get_row['email']; ?></td>
                                                <td><?php echo $get_row['state']; ?></td>
                                                <td><?php echo $get_row['state']; ?></td>
                                                <td><?php echo $get_row['city']; ?></td>
                                                <td><?php echo $get_row['pincode']; ?></td>
                                                <td><?php echo $get_row['address1']; ?></td>
                                                <td><?php echo $get_row['address2']; ?></td>

                                                <td> <a href="http://65.2.20.135/printevent?ins=<?php echo $get_row['college_name'] ?>" target="_blank" class="btn btn-success btn-sm"> Print</a></td>
                                                <td> <a href="./event_hindi_inc/participants/delete.php?delete=<?php echo $get_row['college_name'] ?>" class="btn btn-danger btn-sm"> Delete</a></td>
                                            </tr>
                                        <?php $i++;
                                        } ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="th-sm">S.NO
                                            </th>
                                            <!-- <th class="th-sm">Name
                                                </th>
                                                <th class="th-sm">department
                                                </th>
                                                <th class="th-sm">Father
                                                </th>
                                                <th class="th-sm">DOB
                                                </th>
                                                <th class="th-sm">gender
                                                </th>
                                                <th class="th-sm">student_mobile
                                                </th>
                                                <th class="th-sm">student_email
                                                </th>
                                                <th class="th-sm">student_whatsapp
                                                </th>
                                                <th class="th-sm">student_address
                                                </th>
                                                <th class="th-sm">student_imgages
                                                </th> -->
                                            <!-- <th class="th-sm">event_name
                                                </th> -->
                                            <th class="th-sm text-center">name
                                            </th>
                                            <th class="th-sm text-center">type
                                            </th>
                                            <th class="th-sm text-center">board name
                                            </th>
                                            <th class="th-sm">affiliated_name
                                            </th>

                                            <th class="th-sm text-center">mobile
                                            </th>
                                            <th class="th-sm text-center">Email
                                            </th>
                                            <th class="th-sm">country
                                            </th>
                                            <th class="th-sm">state
                                            </th>
                                            <th class="th-sm text-center">city
                                            </th>
                                            <th class="th-sm text-center">pincode
                                            </th>
                                            <th class="th-sm text-center">address1
                                            </th>
                                            <th class="th-sm text-center">address2
                                            </th>
                                            <th class="th-sm text-center">Print
                                            </th>
                                            <th class="th-sm text-center">Action
                                            </th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="./event_hindi_inc/js/main.js"></script>
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
    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;

            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added" ><td><input type="text" id="slno' + i + '" value="' + i + '" readonly class="form-control" style="border:none;" /></td><td><input type="text" name="name[]" placeholder="Enter Activities name" class="form-control" /></td><td><input type="text" name="limit[]" placeholder="Limit of the participants" class="form-control" /></td><td><input type="text" name="place[]" placeholder="Enter the place of the Event" class="form-control" /></td>   <td width="5%" ><input type="time" name="start[]" placeholder="place" class="form-control" /></td>                                     <td width="5%" ><input type="time" name="end[]" placeholder="place" class="form-control" /></td>    <td width="35%"><textarea name="t&c[]" placeholder="" class="form-control"> </textarea></td> <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>

</body>

</html>
