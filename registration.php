<script>
    var year = 3;

    function change_course(acadmic) {
        console.log(acadmic)
        var date = document.getElementById('datechange');

        var year = new Date();

        if (acadmic.startsWith("B") || acadmic.startsWith("P") || acadmic.startsWith("DIPLOMA")) {

            console.log(3)
            date.innerText = year.getFullYear() + "-" + (year.getFullYear() + 3);
            date.setAttribute('value', year.getFullYear() + "-" + (year.getFullYear() + 3))
        } else {
            console.log(2)
            date.innerText = year.getFullYear() + "-" + (year.getFullYear() + 2);
            date.setAttribute('value', year.getFullYear() + "-" + (year.getFullYear() + 2))
        }
    }
</script>

<!-- here to start getting the data from the database  -->
<?php
include './Backend/connection.inc.php';
include './Backend/function.inc.php';
// $_SESSION['email']="rohit83013@gmail.com";
if (isset($_SESSION['email']) && ($_SESSION['email'] != '')) {
    $email = trim($_SESSION['email']);
    // data retring from tbl_course_type table
    $course_type = "SELECT  *  FROM `tbl_course_type` WHERE `prospectus_emailid`='$email'";
    $coursr_result = mysqli_query($connection, $course_type);
    //data retring from course_name table
    $course_name = "SELECT * FROM `tbl_course` WHERE 1";
    $course_name_result = mysqli_query($connection, $course_name);

    // showing the data if avaible in the database

    $phone = $_SESSION['phone'];
    $email = $_SESSION['email'];
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
    $payment_status = $row['payment_status'];
    $prospectus_postal_code = $row['prospectus_postal_code'];
    if ($payment_status != "success") {
?>


        <html lang="en" data-textdirection="ltr">

        <head>

            <?php include './srinath.inc/head.php'; ?>
            <link rel="icon" href="app-assets/images/logo/favicon-32x32.png" sizes="32x32">
            <link rel="icon" href="app-assets/images/logo/favicon-192x192.png" sizes="192x192">
            <link rel="apple-touch-icon" href="app-assets/images/logo/favicon-apple.png">

            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!-- BEGIN VENDOR CSS-->
            <link rel="stylesheet" type="text/css" href="app-assets/vendors/vendors.min.css">
            <link rel="stylesheet" type="text/css" href="app-assets/vendors/flag-icon/css/flag-icon.min.css">
            <link rel="stylesheet" type="text/css" href="app-assets/vendors/dropify/css/dropify.min.css">
            <!-- END VENDOR CSS-->
            <!-- BEGIN THEME  CSS-->
            <!-- END THEME  CSS-->
            <!-- BEGIN Page Level CSS-->
            <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/materialize.css">
            <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/style.css">
            <!-- END Page Level CSS-->
            <!-- BEGIN Custom CSS-->
            <link rel="stylesheet" type="text/css" href="app-assets/css/custom/custom.css">
            <!-- END Custom CSS-->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- Your custom styles (optional) -->

        </head>

        <body>
            <?php include './srinath.inc/header.php'; ?>

            <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns menu-expanded fixed-navbar registration_form" data-open="click" data-menu="vertical-modern-menu" data-color="" data-col="2-columns">
                <!--
    //////////////////////////////////////////////////////////////////////////// -->
                <!-- START HEADER -->
                <header class="page-topbar" id="header">

                    <nav class="whitenav">
                        <div class="nav-wrapper">
                            <img class="ajulogo" src="./asset/img/logo.png" alt="AJU Logo">
                            <ul class="right">
                                <li><a class="dropdown-trigger whitenav" href="#!" data-target="dropdown1"><?php echo $_SESSION['name']; ?><i class="material-icons right">arrow_drop_down</i></a>
                                    <div id="dropdown1" class="dropdown-content" tabindex="0">
                                        <a href="./Backend/logout.php" class="whitenav" tabindex="0">Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!--
            <div class="row">
                <div class="col s6 m6 l6 margin-left"><img src="app-assets/images/logo/logo.jpg" /></div>
            </div>
        -->
                </header>
                <!-- END HEADER -->
                <!-- START MAIN -->
                <div>
                    <!-- START WRAPPER -->
                    <div class="row container">
                        <section class="content-wrapper-before">
                            <!--start container-->
                            <div class="col s12">
                                <div class="row">
                                    <div class="col s12">
                                        <form id="registration_submit" action="" method="POST" enctype="multipart/form-data">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Program Details</h3>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="input-field col l4 m4 s12">
                                                        <p>Academic <span class="color-red"> * </span></p>
                                                        <div class="select-wrapper">
                                                            <select required name="academic" onchange="change_course(this.value)" id="academic" tabindex="-1">
                                                                <option value="" disabled="" selected="">Choose your option</option>
                                                                <?php
                                                                // here i have to fetch the data fo course and showing the data
                                                                // while ($rwo = mysqli_fetch_array($coursr_result)) { 
                                                                ?>
                                                                    <option id="apply_for" value="<?php
                                                                                                    // echo $rwo['name']; 
                                                                                                    ?>"><?php
                                                                                                        // echo $rwo['name']; 
                                                                                                        ?></option>
                                                                <?php
                                                                // } 
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="error" id="academic1_err"></div>
                                                    </div> -->
                                                        <div class="input-field col l4 m4 s12" id="course_box">
                                                            <p>Course <span class="color-red"> * </span></p>
                                                            <div class="ug_class ">
                                                                <div class="select-wrapper">
                                                                    <select onchange="change_course(this.value)" required name="course" id="course_name">
                                                                        <?php if ($prospectus_course_name != '') { ?>
                                                                            <option value=" <?php echo $prospectus_course_name ?>" selected><?php echo $prospectus_course_name; ?></option>
                                                                        <?php } else { ?>
                                                                            <option selected disabled value="">Choose your option</option>
                                                                        <?php  } ?> ?>
                                                                        <?php while ($row = mysqli_fetch_array($course_name_result)) {
                                                                        ?>
                                                                            <option value="<?php echo $row['course_name']; ?>"><?php echo $row['course_name']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="input-field col s6 m6 l4">
                                                            <p for="transportation_opted">Session<span class="color-red"> * </span></p>
                                                            <div class="select-wrapper">
                                                                <?php
                                                                //    gettiting the starting date for input the session in 
                                                                // $startdate = date("Y");
                                                                ?>
                                                                </svg><select disabled required id="transportation" name="session" tabindex="-1">
                                                                    <?php
                                                                    if ($prospectus_session != '') {
                                                                        $prospectus_session = str_replace('-', '/', $prospectus_session);
                                                                        $first = explode('/', $prospectus_session)[2];
                                                                        $second = explode('/', $prospectus_session)[5];
                                                                        $prospectus_session = $first . '-' . $second;

                                                                    ?>
                                                                        <option value=" <?php
                                                                                        echo $prospectus_session ?>" selected><?php
                                                                                                                                echo $prospectus_session; ?></option>
                                                                    <?php
                                                                    }

                                                                    ?>

                                                                    <!-- <option value="" selected disabled="">-Select-</option> -->
                                                                    <?php //} 
                                                                    ?>


                                                                    <option value="<?php
                                                                                    // echo date('Y');
                                                                                    //                 echo " - ";
                                                                                    //                 echo date('Y', strtotime('+3 year')); 
                                                                                    ?>"><?php
                                                                                        //echo date('Y');
                                                                                        //                                                             echo " - ";
                                                                                        //                                                             echo date('Y', strtotime('+3 year')); 
                                                                                        ?></option>



                                                                    <option value="<?php
                                                                                    // echo date('Y');
                                                                                    //                 echo " - ";
                                                                                    //                 echo date('Y', strtotime('+3 year')); 
                                                                                    ?>"><?php
                                                                                        //echo date('Y');
                                                                                        //                                                             echo " - ";
                                                                                        //                                                             echo date('Y', strtotime('+2 year')); 
                                                                                        ?></option>

                                                                </select>
                                                            </div>
                                                            <div class="error" id="transportation_err"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Personal Details</h3>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s6 m6 l4">
                                                            <h6>Your Name <span class="color-red"> * </span></h6>
                                                            <input readonly required type="text" placeholder="Your Name" name="name" id="username" class="" value="<?php echo $_SESSION['name']; ?>">

                                                        </div>

                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="mobile_no">Mobile Number <span class="color-red"> * </span></h6>
                                                            <input readonly required placeholder="Mobile Number" id="mobile" name="mobile" type="tel" class="validate" value="<?php echo  $_SESSION['phone']; ?>">

                                                        </div>

                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="email">Email/Id <span class="color-red"> * </span></h6>
                                                            <input readonly required placeholder="Email" name="email" id="email" type="email" class="validate" value="<?php echo $_SESSION['email']; ?> ">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="father_nameid">Father's Name <span class="color-red"> * </span></h6>
                                                            <input required placeholder="Father's Name" id="father_name" name="father_name" type="text" class="validate" value="<?php echo $prospectus_father_name; ?>">

                                                        </div>


                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="transportation_opted">Mother's Name <span class="color-red"> * </span></h6>
                                                            <input required placeholder="Mothers's Name" id="mother_name" name="mother_name" type="text" class="validate" value=" <?php echo $prospectus_mother_name; ?> ">

                                                        </div>

                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="transportation_opted">Refered(Optional)</h6>
                                                            <input placeholder="Enter name of Refered BY" id="mother_name" name="referby" type="text" class="validate" value=" <?php echo $revert_by; ?>">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12 m6 l4">
                                                            <h6 for="first_name">Gender <span class="color-red"> * </span></h6>
                                                            <div class="select-wrapper">
                                                                <svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M7 10l5 5 5-5z"></path>
                                                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                                                </svg><select required id="gender" name="gender" tabindex="-1">
                                                                    <?php if ($prospectus_gender != '') { ?>
                                                                        <option id="gender" selected value="<?php echo $prospectus_gender; ?>"><?php echo $prospectus_gender ?></option>
                                                                    <?php } else { ?>
                                                                        <option selected disabled="">-Select-</option>
                                                                    <?php } ?>
                                                                    <option id="gender" value="Male">Male</option>
                                                                    <option id="gender" value="Female">Female</option>
                                                                    <option id="gender" value="Transgender">Transgender</option>
                                                                </select>
                                                            </div>
                                                            <div class="error" id="gender_err"></div>
                                                        </div>

                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="dob">Date Of Birth <span class="color-red"> * </span></h6>
                                                            <input required placeholder="Date Of Birth" id="dob" name="dob" type="text" class="datepicker" value="<?php echo $prospectus_dob; ?>">
                                                            <div class="error" id="dob_err"></div>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Address Details</h3>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="address1">Address 1<span class="color-red"> * </span></h6>
                                                            <input required placeholder="Permanent Address " id="address_1" name="address1" type="text" class="validate" value="<?php echo $address->permanet; ?>">
                                                            <div class="error" id="address_1_err"></div>
                                                        </div>

                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="address2"> Address 2 </h6>
                                                            <input required placeholder="Correspondence Address" id="address_2" name="address2" type="text" class="validate" value="<?php echo $address->crosspodens; ?>">
                                                        </div>
                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="country">Country <span class="color-red"> * </span></h6>
                                                            <div class="select-wrapper">

                                                                <select required id="country" name="country" tabindex="-1">
                                                                    <option value="" disabled="">-Select-</option>
                                                                    <option selected="" id="country" value="India">India</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="state1">State <span class="color-red"> * &nbsp; </span></h6>
                                                            <div class="select-wrapper">
                                                                <select required id="state" name="state" tabindex="-1">
                                                                    <?php if ($prospectus_state != '') { ?>
                                                                        <option id="state1" selected value="<?php echo $prospectus_state; ?>"><?php echo $prospectus_state; ?></option>
                                                                    <?php } else { ?>
                                                                        <option id="state1" selected value="" disabled="">-Select-</option>
                                                                    <?php } ?>
                                                                    <option id="state1" value="Andhra Pradesh">Andhra Pradesh</option>
                                                                    <option id="state1" value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                                    <option id="state1" value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                    <option id="state1" value="Assam">Assam</option>
                                                                    <option id="state1" value="Bihar">Bihar</option>
                                                                    <option id="state1" value="Chandigarh">Chandigarh</option>
                                                                    <option id="state1" value="Chhattisgarh">Chhattisgarh</option>
                                                                    <option id="state1" value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                                    <option id="state1" value="Daman and Diu">Daman and Diu</option>
                                                                    <option id="state1" value="Delhi">Delhi</option>
                                                                    <option id="state1" value="Lakshadweep">Lakshadweep</option>
                                                                    <option id="state1" value="Puducherry">Puducherry</option>
                                                                    <option id="state1" value="Goa">Goa</option>
                                                                    <option id="state1" value="Gujarat">Gujarat</option>
                                                                    <option id="state1" value="Haryana">Haryana</option>
                                                                    <option id="state1" value="Himachal Pradesh">Himachal Pradesh</option>
                                                                    <option id="state1" value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                                    <option id="state1" value="Jharkhand">Jharkhand</option>
                                                                    <option id="state1" value="Karnataka">Karnataka</option>
                                                                    <option id="state1" value="Kerala">Kerala</option>
                                                                    <option id="state1" value="Madhya Pradesh">Madhya Pradesh</option>
                                                                    <option id="state1" value="Maharashtra">Maharashtra</option>
                                                                    <option id="state1" value="Manipur">Manipur</option>
                                                                    <option id="state1" value="Meghalaya">Meghalaya</option>
                                                                    <option id="state1" value="Mizoram">Mizoram</option>
                                                                    <option id="state1" value="Nagaland">Nagaland</option>
                                                                    <option id="state1" value="Odisha">Odisha</option>
                                                                    <option id="state1" value="Punjab">Punjab</option>
                                                                    <option id="state1" value="Rajasthan">Rajasthan</option>
                                                                    <option id="state1" value="Sikkim">Sikkim</option>
                                                                    <option id="state1" value="Tamil Nadu">Tamil Nadu</option>
                                                                    <option id="state1" value="Telangana">Telangana</option>
                                                                    <option id="state1" value="Tripura">Tripura</option>
                                                                    <option id="state1" value="Uttar Pradesh">Uttar Pradesh</option>
                                                                    <option id="state1" value="Uttarakhand">Uttarakhand</option>
                                                                    <option id="state1" value="West Bengal">West Bengal</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="district">District <span class="color-red"> * </span></h6>
                                                            <input required placeholder="District" id="district" name="city" type="text" class="validate" value=" <?php echo $prospectus_city; ?>">
                                                            <div class="error" id="district_err"></div>
                                                        </div>
                                                        <div class="input-field col s6 m6 l4">
                                                            <h6 for="postal">Pincode <span class="color-red"> * </span></h6>
                                                            <input required placeholder="Postal Code" type="text" id="postal_code" name="postal_code" class="validate" value="<?php echo $prospectus_postal_code; ?>">
                                                            <div class="error" id="postal_code_err"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Declaration</h3>
                                                    </div>

                                                    <div class="row">
                                                        <div class="input-field col s12 m12 l12">
                                                            <p>
                                                                <label>
                                                                    <input required type="checkbox" id="declare_1" name="declare_1" value="1">
                                                                    <span>I declare that I meet all the eligibility criteria of admission as per the university guideline</span>
                                                                </label>
                                                            </p>
                                                            <div class="error" id="declare_1_err"></div>
                                                            <p></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <input required type="hidden" name="course_hide" id="course_hide" value="">
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn waves-effect waves-light" type="submit" name="submit">
                                                        Save &amp; Next
                                                        <i class="material-icons right">send</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <br>
                        <!-- END CONTENT -->
                        <!--
              //////////////////////////////////////////////////////////////////////////// -->
                    </div>
                    <!-- END WRAPPER -->
                </div>
                <!-- END MAIN -->
                <!--
      //////////////////////////////////////////////////////////////////////////// -->
                <!-- START FOOTER -->
                <?php include './srinath.inc/footer.php'; ?>
                <!-- END FOOTER -->
                <!-- ================================================
      Scripts
      ================================================ -->
                <!-- END: Footer-->
                <!-- BEGIN VENDOR JS-->
                <script src="app-assets/js/vendors.min.js"></script>
                <!-- BEGIN VENDOR JS-->
                <!-- BEGIN PAGE VENDOR JS-->
                <script src="app-assets/vendors/dropify/js/dropify.min.js"></script>
                <script src="app-assets/vendors/jquery-validation/jquery.validate.min.js"></script>
                <!-- END PAGE VENDOR JS-->
                <!-- BEGIN THEME  JS-->
                <script src="app-assets/js/plugins.js"></script>
                <script src="app-assets/js/search.js"></script>
                <script src="app-assets/js/custom/custom-script.js"></script>
                <!-- END THEME  JS-->
                <!-- BEGIN PAGE LEVEL JS-->
                <script src="app-assets/js/scripts/form-file-uploads.js"></script>
                <script src="app-assets/js/scripts/form-validation.js"></script>


                <div class="modal datepicker-modal" id="modal-fb7341e7-fdf4-92b2-dd44-d1ef2eb353c9" tabindex="0">
                    <div class="modal-content datepicker-container">
                        <div class="datepicker-date-display"><span class="year-text"></span><span class="date-text"></span></div>
                        <div class="datepicker-calendar-container">
                            <div class="datepicker-calendar"></div>
                            <div class="datepicker-footer"><button class="btn-flat datepicker-clear waves-effect" style="visibility: hidden;" type="button"></button>
                                <div class="confirmation-btns"><button class="btn-flat datepicker-cancel waves-effect" type="button">Cancel</button><button class="btn-flat datepicker-done waves-effect" type="button">Ok</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>

        </html>

<?php } else {
        header("location:print.php");
    }
    // here to inserting the data into the database
    if (isset($_POST['submit'])) {

        //     // course Details
        // i have to write this code due to in the erp support full full date and year du to i have wirted this code
        $prospectus_course_name = $_POST['course'];

        $prospectus_session_query = "SELECT * FROM `tbl_course` WHERE `course_name`='$prospectus_course_name'";
        $prospectus_session_result = mysqli_query($connection, $prospectus_session_query);
        $prospectus_session_data = mysqli_fetch_array($prospectus_session_result);
        $course_duration = $prospectus_session_data['course_duration'];
        $str = '';
        if ($course_duration == 2) {
            $str = date('Y') . "-" . date('Y', strtotime('+2 year'));
        } else {
            $str = date('Y') . "-" . date('Y', strtotime('+3 year'));
        }

        $prospectus_seession1 = '01/04/' . explode("-", $str)[0];
        $prospectus_seession2 = trim('31/03/' . explode("-", $str)[1]);

        $prospectus_session = trim($prospectus_seession1 . '-' . $prospectus_seession2);

        //     // persnal details

        $prospectus_applicant_name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $prospectus_emailid = $_POST['email'];
        $prospectus_gender = $_POST['gender'];
        $prospectus_dob = $_POST['dob'];
        $prospectus_father_name = $_POST['father_name'];
        $prospectus_mother_name = $_POST['mother_name'];
        $revert_by = $_POST['referby'];

        // address details
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        // address1 and address2 has converting into the json form and send to the database
        $address = array("permanet" => $address1, "crosspodens" => $address2);

        $prospectus_address = json_encode($address);
        $prospectus_country = $_POST['country'];
        $prospectus_state = $_POST['state'];
        $prospectus_city = $_POST['city'];
        $prospectus_postal_code = $_POST['postal_code'];

        // //for updating in final page
        //     $payment_status=
        //     $prospectus_rate=
        //     $prospectus_payment_mode=
        //     $prospectus_deposit_to=
        //     $bank_name=
        //     $transaction_no=
        //     $transaction_date=
        //     $post_at=
        //     $type=
        //     $easebuzz_id=
        //     $transaction_id=
        //     $status=

        $_SESSION['course_name'] = $prospectus_course_name;
        $_SESSION['course_session'] = $str;
        $_SESSION['name'] = $prospectus_applicant_name;
        $_SESSION['email'] = $prospectus_emailid;
        $_SESSION['phone'] = $mobile;
        $url_data = '';
        // here i have to check host name concatnate the directory
        // in to surl and furl
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $url_data = "/srinathcms";
        } else {
            $url_data = '';
        }

        $_SESSION['surl'] = 'http://' . $_SERVER['HTTP_HOST'] . $url_data . '/library/response.php';
        $_SESSION['furl'] = 'http://' . $_SERVER['HTTP_HOST'] . $url_data . '/library/response.php';

        $tbl_prospectus_query = "INSERT INTO `tbl_prospectus`(`prospectus_no`, `prospectus_applicant_name`, `prospectus_gender`, `prospectus_father_name`, `prospectus_mother_name`, `prospectus_address`, `prospectus_country`, `prospectus_state`, `prospectus_city`, `prospectus_postal_code`, `prospectus_dob`, `prospectus_emailid`, `mobile`, `revert_by`, `prospectus_course_name`, `prospectus_session`, `payment_status`, `prospectus_rate`, `prospectus_payment_mode`, `prospectus_deposit_to`, `bank_name`, `transaction_no`, `transaction_date`, `post_at`, `type`, `easebuzz_id`, `transaction_id`, `status`) VALUES ('NULL','$prospectus_applicant_name','$prospectus_gender','$prospectus_father_name','$prospectus_mother_name','$prospectus_address','$prospectus_country','$prospectus_state','$prospectus_city','$prospectus_postal_code','$prospectus_dob','$prospectus_emailid','$mobile','$revert_by','$prospectus_course_name','$prospectus_session','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL')";
        $tbl_prospectus_insert = mysqli_query($connection, $tbl_prospectus_query);
        if ($tbl_prospectus_insert) {

            // update the user login table

            echo "<script>
          window.location.replace('conformation.php');
            </script>";
        } else {
            $update_prospectus = "UPDATE `tbl_prospectus` SET `prospectus_gender`='$prospectus_gender',`prospectus_father_name`='$prospectus_father_name',`prospectus_mother_name`='$prospectus_mother_name',`prospectus_address`='$prospectus_address',`prospectus_country`='$prospectus_country',`prospectus_state`='$prospectus_state',`prospectus_city`='$prospectus_city',`prospectus_postal_code`='$prospectus_postal_code',`prospectus_dob`='$prospectus_dob',`prospectus_emailid`='$prospectus_emailid',`mobile`='$mobile',`revert_by`='$revert_by',`prospectus_course_name`='$prospectus_course_name',`prospectus_session`='$prospectus_session' WHERE `prospectus_emailid`='$prospectus_emailid'";
            $update_prospectus_result = mysqli_query($connection, $update_prospectus);
            if ($update_prospectus_result) {
                echo "<script>
                    window.location.replace('conformation.php');
                    </script>";
            }
        }
    }
} else {
    echo "<script>
    window.location.replace('./index.php');
</script>";
}


?>