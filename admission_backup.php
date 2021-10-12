<?php
$page_no = "5";
$page_no_inside = "5_1";
include "./Backend/connection.inc.php";
$con = $connection;



// $_SESSION['emailid'] = 'rohit83015@gmail.com';
if (isset($_SESSION['emailid']) && ($_SESSION['emailid'] != '') ) {
  $email = trim($_SESSION['emailid']);
  // data retring from tbl_course_type table
  // $course_type = "SELECT  *  FROM `tbl_course_type` WHERE `prospectus_emailid`='$email'";
  // $coursr_result = mysqli_query($connection, $course_type);
  //data retring from course_name table
  $course_name = "SELECT * FROM `tbl_course` WHERE 1";
  $course_name_result = mysqli_query($connection, $course_name);
  $email = $_SESSION['emailid'];
  // showing the data if avaible in the database



  $user_data_query = "SELECT * FROM `tbl_prospectus` WHERE `prospectus_emailid`='$email'";
  $propactus_details = mysqli_query($connection, $user_data_query);
  $row = mysqli_fetch_array($propactus_details);
  // course details
  $prospectus_no = $row['prospectus_no'];
  $prospectus_course_name = $row['prospectus_course_name'];
  $prospectus_session = $row['prospectus_session'];
  // personal details
  $prospectus_applicant_name = $row['prospectus_applicant_name'];
  $prospectus_gender = $row['prospectus_gender'];
  $prospectus_father_name = $row['prospectus_father_name'];
  $prospectus_mother_name = $row['prospectus_mother_name'];
  $prospectus_dob = $row['prospectus_dob'];
  $prospectus_emailid = $row['prospectus_emailid'];
  $mobile = $row['mobile'];
  $revert_by    = $row['revert_by'];
  // address details
  // here i have to getting the data from the json
  $prospectus_address = $row['prospectus_address'];
  $address = json_decode($prospectus_address);

  $prospectus_country = $row['prospectus_country'];
  $prospectus_state = $row['prospectus_state'];
  $prospectus_city = $row['prospectus_city'];
  $prospectus_postal_code = $row['prospectus_postal_code'];
  $status = $row['status'];
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRINATH UNIVERSITY | Admission Form </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include './srinath.inc/foot.php'; ?>
    <?php include './srinath.inc/head.php'; ?>
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

    <link rel="stylesheet" href="./srinath/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="./asset/css/admission.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <?php include './srinath.inc/header.php'; ?>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">


      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Admission Form</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                </ol>
              </div>
            </div>
          </div>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

            <!-- SELECT2 EXAMPLE -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Admission Form</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                </div>
              </div>

              <form role="form" method="POST" id="add_admission_form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12" id="error_section"></div>
                    <div class="col-4">

                      <?php
                      // $sel=mysqli_query($con," SELECT MAX(admission_id) + 1 AS id FROM tbl_admission");
                      // while($result=mysqli_fetch_array($sel)){
                      ?>
                      <label>Prospectus No</label>
                      <input required id="form_no" type="text" name="add_admission_form_no" class="form-control" value="<?php echo $prospectus_no; ?>" readonly required>

                    </div>
                    <div class="col-4">
                      <label>Course Name</label>
                      <input required id="form_no" type="text" name="add_admission_form_no" value="<?= $prospectus_course_name; ?>" class="form-control" readonly required>
                    </div>
                    <div class="col-4">
                      <label>Session</label>
                      <input required type="text" name="add_admission_no" class="form-control" value="<?= $prospectus_session; ?>" readonly>
                    </div>

                    <div class="col-4">
                      <label>Title</label>
                      <select name="add_admission_title" class="form-control">
                        <option value="0">Select</option>
                        <option value="Master">Master</option>
                        <option value="Miss">Miss</option>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                      </select>
                    </div>

                    <div class="col-4">
                      <label>Name</label>
                      <input required disabled id="first_name" type="text" name="name" value="<?= $prospectus_applicant_name; ?>" class="form-control" required>
                    </div>
                    <div class="col-4">
                      <label>Father Name</label>
                      <input required disabled id="first_name" type="text" name="father_name" class="form-control" value="<?= $prospectus_father_name; ?>" required>
                    </div>
                    <div class="col-4">
                      <label>Mother Name</label>
                      <input required disabled id="first_name" type="text" name="mother_name" class="form-control" value="<?= $prospectus_mother_name; ?>" required>
                    </div>




                    <div class="col-4">
                      <label>Gender</label>
                      <!-- <select id="gender" name="add_admission_gender" class="form-control">
                        <option value="0">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select> -->
                      <input required disabled id="first_name" type="text" name="mother_name" class="form-control" value="<?= $prospectus_gender; ?>">

                    </div>


                    <div class="col-4">
                      <label>Date Of Birth</label>
                      <input required id="dob" type="text" value="<?php echo $prospectus_dob; ?>" name="add_admission_dob" class="form-control" disabled required>
                    </div>

                    <div class="col-4">
                      <label>Nationality</label>
                      <input required type="text" name="add_admission_nationality" class="form-control">
                    </div>

                    <div class="col-4">
                      <label>Aadhar No</label>
                      <input required type="text" name="add_admission_aadhar_no" class="form-control">
                    </div>

                    <div class="col-4">
                      <label>Religion</label>
                      <select name="add_admission_category" class="form-control">
                        <option selected disabled>Select</option>
                        <option value="hindu">Hindu</option>
                        <option value="muslim">Muslim</option>
                        <option value="sikh">Sikh</option>
                        <option value="christian">Christian</option>
                        <option value="Others">Others</option>
                      </select>
                    </div>
                    <div class="col-4">
                      <label>Category</label>
                      <select name="add_admission_category" class="form-control">
                        <option value="0">Select</option>
                        <option value="General">General</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                        <option value="OBC">OBC</option>
                      </select>
                    </div>



                    <div class="col-md-4">
                      <label>Username</label>
                      <input required disabled type="text" name="add_admission_username" class="form-control" required value="<?php echo $prospectus_emailid ?>">
                    </div>
                    <div class="col-4">
                      <label>Password</label>
                      <input required type="password" name="add_admission_password" class="form-control" required>
                    </div>
                    <div class="col-4">
                      <label>Blood Group(Optional)</label>
                      <input required type="text" name="add_admission_blood_group" class="form-control">
                    </div>




                    <div class="col-4">
                      <label>Image</label>
                      <input required type="file" accept="image/*" name="add_admission_profile_image" id="add_admission_profile_image" class="form-control">
                    </div>
                    <div class="col-4">
                      <img src="http://www.clipartpanda.com/clipart_images/user-66327738/download" id="photoBrowser" style="margin-top:17px;margin-left:4px;border:solid 1px lightgray" width="120" height="120">
                    </div>

                  </div>
                </div>
            </div>
            <!-- address details  -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Address Details</h3>
              </div>

              <div class="card-body table-responsive p-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <label>Parmanent Address</label>
                      <input required type="text" disabled value="<?php echo $address->permanet; ?>" class="form-control">
                    </div>
                    <div class="col-4">
                      <label>Correspondence Address</label>
                      <input required type="text" disabled value=" <?php echo $address->crosspodens;  ?>" class="form-control">
                    </div>

                    <div class="col-4">
                      <label>Pin code</label>
                      <input required readonly type="text" name="pin" value="<?php echo $prospectus_postal_code;  ?>" class="form-control" value="<?php echo date('Y-m-d') ?>">
                    </div>


                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Decleration </h3>
              </div> -->


              <!-- <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">PRESENT ADDRESS</h3>
              </div>

              <div class="card-body table-responsive p-0">
                <div class="card-body">
                  <div class="row">
                  <div class="col-4">
                      
                      <label>Parmanent Address</label>
                      <textarea id="address" name="add_admission_residential_address" class="form-control" style="height: 38px;"></textarea>
                    </div>
                    <div class="col-4">
                      
                      <label>Residential Address</label>
                      <textarea id="address" name="add_admission_residential_address" class="form-control" style="height: 38px;"></textarea>
                    </div>
                    <div class="col-4">
                      <label>State</label>
                      <input required id="state" type="text" name="add_admission_state" class="form-control">
                    </div>
                  
                    <div class="col-4">
                      <label>District</label>
                      <input required type="text" name="add_admission_district" class="form-control">
                    </div>
                    <div class="col-4">
                      <label>Pin Code</label>
                      <input required id="postal_code" type="text" name="add_admission_pin_code" class="form-control">
                    </div>
                  
                  
              
                  </div>
                </div>
              </div>
            </div> -->

              <!-- <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Parent Details</h3>
              </div>

              <div class="card-body table-responsive p-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <label>Father Name</label>
                      <input required id="father_name" type="text" name="add_admission_father_name" class="form-control">
                    </div>
                    <div class="col-4">
                      <label>Father Whatsapp No</label>
                      <input required type="text" name="add_admission_father_whatsappno" class="form-control">
                    </div>
                    <div class="col-4">
                      <label>Mother Name</label>
                      <input required id="mother_name" type="text" name="add_admission_mother_name" class="form-control">
                    </div>
                  </div>
                </div>
                </div>
                </div> -->

               <div class="card card-secondary">
                <div class="card-header">
                <h3 class="card-title">Academic Details</h3>
                </div>

                 <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Qualification</th>
                      <th>Board/University</th>
                      <th>School/College Name</th>
                      <th>Year Of Passing</th>
                      <th>Percentage or CGPA</th>
                      <th>Subjects</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>High School</td>
                      <td><input required type="text" name="add_admission_high_school_board_university" size="15" value=""></td>
                      <td><input required type="text" name="add_admission_high_school_college_name" size="15" value=""></td>
                      <td><input required type="text" name="add_admission_high_school_passing_year" size="15" value=""></td>
                      <td><input required type="text" name="add_admission_high_school_per" size="15" value=""></td>
                      <td><input required type="text" name="add_admission_high_school_subjects" size="15" value=""></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Intermediate</td>
                      <td><input required type="text" name="add_admission_intermediate_board_university" size="15" value=""></td>
                      <td><input required type="text" name="add_admission_intermediate_college_name" size="15" value=""></td>
                      <td><input required type="text" name="add_admission_intermediate_passing_year" size="15" value=""></td>
                      <td><input required type="text" name="add_admission_intermediate_per" size="15" value=""></td>
                      <td><input required type="text" name="add_admission_intermediate_subjects" size="15" value=""></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Graduation</td>
                      <td><input type="text" name="add_admission_graduation_board_university" size="15" value=""></td>
                      <td><input type="text" name="add_admission_graduation_college_name" size="15" value=""></td>
                      <td><input type="text" name="add_admission_graduation_passing_year" size="15" value=""></td>
                      <td><input type="text" name="add_admission_graduation_per" size="15" value=""></td>
                      <td><input type="text" name="add_admission_graduation_subjects" size="15" value=""></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Post Graduation</td>
                      <td><input type="text" name="add_admission_post_graduation_board_university" size="15" value=""></td>
                      <td><input type="text" name="add_admission_post_graduation_college_name" size="15" value=""></td>
                      <td><input type="text" name="add_admission_post_graduation_others" size="15" value=""></td>
                      <td><input type="text" name="add_admission_post_graduation_per" size="15" value=""></td>
                      <td><input type="text" name="add_admission_post_graduation_subjects" size="15" value=""></td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Others</td>
                      <td><input type="text" name="add_admission_others_board_university" size="15" value=""></td>
                      <td><input type="text" name="add_admission_others_college_name" size="15" value=""></td>
                      <td><input type="text" name="add_admission_others_passing_year" size="15" value=""></td>
                      <td><input type="text" name="add_admission_others_per" size="15" value=""></td>
                      <td><input type="text" name="add_admission_others_subjects" size="15" value=""></td>
                    </tr>
                  </tbody>
                </table>
                </div>
               </div> 


              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Documents Required For Admission</h3>
                </div>

                <div class="card-body table-responsive p-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <label>10th Marksheet</label>
                        <input required type="file" accept="image/*" name="add_admission_tenth_marksheet" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>10th Passing Certificate</label>
                        <input  type="file" accept="image/*" name="add_admission_tenth_passing_certificate" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>12th Marksheet</label>
                        <input required type="file" accept="image/*" name="add_admission_twelve_markesheet" class="form-control">
                      </div>

                      <div class="col-4">
                        <label>12th Passing Certificate</label>
                        <input type="file" accept="image/*" name="add_admission_twelve_passing_certificate" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>Graduation Marksheet</label>
                        <input type="file" accept="image/*" name="add_admission_graduation_marksheet" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>Recent Character Certificate</label>
                        <input type="file" accept="image/*" name="add_admission_recent_character_certificate" class="form-control">
                      </div>

                      <div class="col-4">
                        <label>Other Certificate (If applicable)</label>
                        <input type="file" accept="image/*" name="add_admission_other_certificate" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>Character Certificate (If applicable)</label>
                        <input type="file" accept="image/*" name="add_admission_character_certificate" class="form-control">
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">TECHNICAL QUALIFICATION (IF ANY)</h3>
              </div>

              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Course</th>
                      <th>Board / University</th>
                      <th>Year Of Passing</th>
                      <th>Percentage or CGPA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td><input type="text" name="add_admission_course1" size="15" value=""></td>
                      <td><input type="text" name="add_admission_board_university1" size="15" value=""></td>
                      <td><input type="text" name="add_admission_year_of_passing1" size="15" value=""></td>
                      <td><input type="text" name="add_admission_percentage1" size="15" value=""></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td><input type="text" name="add_admission_course2" size="15" value=""></td>
                      <td><input type="text" name="add_admission_board_university2" size="15" value=""></td>
                      <td><input type="text" name="add_admission_year_of_passing2" size="15" value=""></td>
                      <td><input type="text" name="add_admission_percentage2" size="15" value=""></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td><input type="text" name="add_admission_course3" size="15" value=""></td>
                      <td><input type="text" name="add_admission_board_university3" size="15" value=""></td>
                      <td><input type="text" name="add_admission_year_of_passing3" size="15" value=""></td>
                      <td><input type="text" name="add_admission_percentage3" size="15" value=""></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td><input type="text" name="add_admission_course4" size="15" value=""></td>
                      <td><input type="text" name="add_admission_board_university4" size="15" value=""></td>
                      <td><input type="text" name="add_admission_year_of_passing4" size="15" value=""></td>
                      <td><input type="text" name="add_admission_percentage4" size="15" value=""></td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td><input type="text" name="add_admission_course5" size="15" value=""></td>
                      <td><input type="text" name="add_admission_board_university5" size="15" value=""></td>
                      <td><input type="text" name="add_admission_year_of_passing5" size="15" value=""></td>
                      <td><input type="text" name="add_admission_percentage5" size="15" value=""></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div> -->

              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Documents Required For Admission</h3>
                </div>

                <div class="card-body table-responsive p-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <label>Student Signature</label>
                        <input required type="file" accept="image/*" name="student_sing" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>Parent Signature</label>
                        <input required type="file" accept="image/*" name="parent_sing" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>Date</label>
                        <input required readonly type="text" name="date" class="form-control" value="<?php echo date('Y-m-d') ?>">
                      </div>


                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Decleration For Admission</h3>
                </div>

                <div class="card-body table-responsive p-0">
                  <div class="card-body">
                    <div class="row">

                      <div class="col-12">
                        <label>
                          <input required readonly type="checkbox" name="tandc" class="">
                          i have to accepts all the terms and conditions for taking the admission</label>
                      </div>


                    </div>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div id="loader_section"></div>
              </div>
              <div class="col-md-6">
                <!-- <input required required type="hidden" name="action" value="add_admission" /> -->
                <button type="submit" name="add_admission_button" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-primary">Reset</button>
              </div>
              </form>

            </div>
        </section>
        <!-- /.content -->
      </div>

      <?php include './srinath.inc/footer.php'; ?>

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
    <!-- <script>
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

      })
    </script>
    <script>
      $(document).ready(function() {
        $('#form_no').on('keyup', function(event) {
          $.ajax({
            url: 'include/view.php?action=fetch_prospectus_info',
            type: 'POST',
            data: $('#add_admission_form').serializeArray(),
            success: function(result) {
              $('#first_name').val('');
              $('#last_name').val('');
              $('#gender').val('0');
              $('#father_name').val('');
              $('#address').val('');
              $('#country').val('');
              $('#state').val('');
              $('#city').val('');
              $('#postal_code').val('');
              $('#email_id').val('');
              $('#dob').val('');
              $('#mobile_no').val('');
              $('#course').val('0');
              if (result != "") {
                var fullinfo = result.split('|||');
                $('#first_name').val(fullinfo[0]);
                $('#last_name').val(fullinfo[1]);
                $('#gender').val(fullinfo[2]);
                $('#father_name').val(fullinfo[3]);
                $('#address').val(fullinfo[4]);
                $('#country').val(fullinfo[5]);
                $('#state').val(fullinfo[6]);
                $('#city').val(fullinfo[7]);
                $('#postal_code').val(fullinfo[8]);
                $('#email_id').val(fullinfo[9]);
                $('#dob').val(fullinfo[10]);
                $('#mobile_no').val(fullinfo[11]);
                $('#course').val(Number(fullinfo[12]));
                $('#session_check').val(Number(fullinfo[13]));
                $('#mother_name').val(fullinfo[14]);
              }
            }
          });
          event.preventDefault();
        });
      });
    </script> -->
  </body>

  </html>
<?php
} else {
  echo "<script>
       window.location.replace('admission_login.php')
      
      </script>";
}
?>

<?php
// here i have to reicivig the data of the user from the from
if (isset($_POST['add_admission_button'])) {
  echo "<pre>";
  print_r($_POST) ;
//educational details of the student who is appling for the admisssion
$add_admission_high_school_board_university=$_POST['add_admission_high_school_board_university'];
$add_admission_high_school_college_name=$_POST['add_admission_high_school_college_name'];
$add_admission_high_school_passing_year=$_POST['add_admission_high_school_passing_year'];
$add_admission_high_school_per=$_POST['add_admission_high_school_per'];
$add_admission_high_school_subjects=$_POST['add_admission_high_school_subjects'];
$add_admission_intermediate_board_university=$_POST['add_admission_intermediate_board_university'];
$add_admission_intermediate_college_name=$_POST['add_admission_intermediate_college_name'];
$add_admission_intermediate_passing_year=$_POST['add_admission_intermediate_passing_year'];
$add_admission_intermediate_per=$_POST['add_admission_intermediate_per'];
$add_admission_intermediate_subjects=$_POST['add_admission_intermediate_subjects'];
$add_admission_graduation_board_university=$_POST['add_admission_graduation_board_university'];
$add_admission_graduation_college_name=$_POST['add_admission_graduation_college_name'];
$add_admission_graduation_passing_year=$_POST['add_admission_graduation_passing_year'];
$add_admission_graduation_per=$_POST['add_admission_graduation_per'];
$add_admission_graduation_subjects=$_POST['add_admission_graduation_subjects'];
$add_admission_post_graduation_board_university=$_POST['add_admission_post_graduation_board_university'];
$add_admission_post_graduation_college_name=$_POST['add_admission_post_graduation_college_name'];
$add_admission_post_graduation_others=$_POST['add_admission_post_graduation_others'];
$add_admission_post_graduation_per=$_POST['add_admission_post_graduation_per'];
$add_admission_post_graduation_subjects=$_POST['add_admission_post_graduation_subjects'];
$add_admission_others_board_university=$_POST['add_admission_others_board_university'];
$add_admission_others_college_name=$_POST['add_admission_others_college_name'];
$add_admission_others_passing_year=$_POST['add_admission_others_passing_year'];
$add_admission_others_per=$_POST['add_admission_others_per'];
$add_admission_others_subjects=$_POST['add_admission_others_subjects'];


    // here i have to storing the data of image in variable and sending the data into the database
  $add_admission_profile_image = addslashes(file_get_contents($_FILES['add_admission_profile_image']['tmp_name']));

  $add_admission_tenth_marksheet = addslashes(file_get_contents($_FILES['add_admission_tenth_marksheet']['tmp_name']));

  $add_admission_tenth_passing_certificate = addslashes(file_get_contents($_FILES['add_admission_tenth_passing_certificate']['tmp_name']));

  $add_admission_twelve_markesheet = addslashes(file_get_contents($_FILES['add_admission_twelve_markesheet']['tmp_name']));

  $add_admission_twelve_passing_certificate = addslashes(file_get_contents($_FILES['add_admission_twelve_passing_certificate']['tmp_name']));

  $add_admission_graduation_marksheet = addslashes(file_get_contents($_FILES['add_admission_graduation_marksheet']['tmp_name']));

  $add_admission_recent_character_certificate = addslashes(file_get_contents($_FILES['add_admission_recent_character_certificate']['tmp_name']));

  $add_admission_other_certificate = addslashes(file_get_contents($_FILES['add_admission_other_certificate']['tmp_name']));

  $add_admission_character_certificate = addslashes(file_get_contents($_FILES['add_admission_character_certificate']['tmp_name']));

  $student_sing = addslashes(file_get_contents($_FILES['student_sing']['tmp_name']));

  $parent_sing = addslashes(file_get_contents($_FILES['parent_sing']['tmp_name']));


  // here i have to storge the normal data of the user 
  $add_admission_title = $_POST['add_admission_title'];

  $add_admission_nationality = $_POST['add_admission_nationality'];

  $add_admission_aadhar_no = $_POST['add_admission_aadhar_no'];

  $add_admission_category = $_POST['add_admission_category'];

  $add_admission_password = $_POST['add_admission_password'];

  $add_admission_blood_group = $_POST['add_admission_blood_group'];
  // echo "<pre>";
  // print_r($_POST);
  $add_admission_title = $_POST['add_admission_title'];
  $admission_form_no_query = "SELECT MAX(admission_id) FROM tbl_admission;";
  $admission_form_result = mysqli_query($connection, $admission_form_no_query);
  $admission_form_no = mysqli_fetch_array($admission_form_result);
  $admission_form_no = $admission_form_no['MAX(admission_id)'] + 1;
  $first_name = explode(" ", "$prospectus_applicant_name")[0];
  // $middle_name=explode(" ","$prospectus_applicant_name")[1];
  $visible = $status;
  $visible_stud = 1;
  $last_name = explode(" ", "$prospectus_applicant_name")[1];
  $add_admission_password = md5($add_admission_password);
  $admission_query = "INSERT INTO `tbl_admission`(`admission_form_no`, `admission_title`, `admission_first_name`,`admission_last_name`, `admission_course_name`, `admission_session`, `admission_dob`, `admission_nationality`, `admission_aadhar_no`,`admission_category`, `admission_gender`, `admission_username`, `admission_password`, `admission_blood_group`,`admission_profile_image`,`student_signature`,`parent_signature`, `admission_residential_address`, `admission_state`, `admission_city`, `admission_district`, `admission_pin_code`, `admission_mobile_student`, `admission_emailid_student`, `admission_father_name`, `admission_mother_name`,`admission_tenth_marksheet`, `admission_tenth_passing_certificate`, `admission_twelve_markesheet`, `admission_twelve_passing_certificate`, `admission_graduation_marksheet`, `admission_recent_character_certificate`, `admission_other_certificate`, `admission_character_certificate`,`status`, `stud_status`) VALUES 
                                                 ('$admission_form_no','$add_admission_title','$prospectus_applicant_name','$last_name','$prospectus_course_name','$prospectus_session','$prospectus_dob','$add_admission_nationality','$add_admission_aadhar_no','$add_admission_category','$prospectus_gender','$prospectus_emailid','$add_admission_password','$add_admission_blood_group','$add_admission_profile_image','$student_sing','$parent_sing','$prospectus_address','$prospectus_state', '$prospectus_city',  '$prospectus_city','$prospectus_postal_code','$mobile', '$prospectus_emailid', '$prospectus_father_name', '$prospectus_mother_name','$add_admission_tenth_marksheet', '$add_admission_tenth_passing_certificate',      '$add_admission_twelve_markesheet','$add_admission_twelve_passing_certificate','$add_admission_graduation_marksheet', '$add_admission_recent_character_certificate','$add_admission_other_certificate','$add_admission_character_certificate','$visible','$visible_stud')";

  $result = mysqli_query($connection, $admission_query);
  if ($result) {
  //  echo $update_education_details_query="UPDATE `tbl_admission` SET `admission_high_school_board_university`='$add_admission_high_school_board_university',`admission_high_school_college_name`='$add_admission_high_school_college_name',`admission_high_school_passing_year`='$add_admission_high_school_passing_year',`admission_high_school_per`='$add_admission_high_school_per',`admission_high_school_subjects`='$add_admission_high_school_subjects',`admission_intermediate_board_university`='$add_admission_intermediate_board_university',`admission_intermediate_college_name`='$add_admission_intermediate_college_name',`admission_intermediate_passing_year`='$add_admission_intermediate_passing_year',`admission_intermediate_per`='$add_admission_intermediate_per',`admission_intermediate_subjects`='$add_admission_intermediate_subjects',`admission_graduation_board_university`='$add_admission_graduation_board_university',`admission_graduation_college_name`='$add_admission_graduation_college_name',`admission_graduation_passing_year`='$add_admission_graduation_passing_year',`admission_graduation_per`='$add_admission_graduation_per',`admission_graduation_subjects`='$add_admission_graduation_subjects',`admission_post_graduation_board_university`='$add_admission_post_graduation_board_university',`admission_post_graduation_college_name`='$add_admission_post_graduation_college_name',`admission_post_graduation_others`='$add_admission_post_graduation_others',`admission_post_graduation_per`='$add_admission_post_graduation_per',`admission_post_graduation_subjects`='$add_admission_post_graduation_subjects',`admission_others_board_university`='$add_admission_others_board_university',`admission_others_college_name`='$add_admission_others_college_name',`admission_others_passing_year`='$add_admission_others_passing_year',`admission_others_per`='$add_admission_others_per',`admission_others_subjects`='$add_admission_others_subjects' WHERE `admission_emailid_student`='$prospectus_emailid'";
  //   $update_education_details_result=mysqli_query($connection,$update_education_details_query);
  //   if($update_education_details_result){
  //     echo "<script>
  //     window.location.replace('./thankyou.php')
  //   </script>";
    // }
  }
}
