
<?php
include './Backend/connection.inc.php';
include './Backend/function.inc.php';

if (isset($_SESSION['email']) && $_SESSION['email'] != '') {

    // $phone = $_SESSION['phone'];
    $email = $_SESSION['email'];
    $email = trim($email);
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


    // payment details
    $payment_status = $row['payment_status'];
    $prospectus_rate = $row['prospectus_rate'];
    $prospectus_payment_mode = $row['prospectus_payment_mode'];
    $prospectus_deposit_to = $row['prospectus_deposit_to'];
    $bank_name = $row['bank_name'];
    $transaction_no = $row['transaction_no'];
    $transaction_date = $row['transaction_date'];
    $post_at = $row['post_at'];
    $type = $row['type'];
    $easebuzz_id = $row['easebuzz_id'];
    $transaction_id = $row['transaction_no'];
    $status = $row['status'];

?>
    <html>

    <head>
        <title>Dashboard Details</title>
        <?php include './srinath.inc/foot.php'; ?>
        <link rel="icon" href="app-assets/images/logo/favicon-32x32.png" sizes="32x32">
        <link rel="icon" href="app-assets/images/logo/favicon-192x192.png" sizes="192x192">
        <link rel="apple-touch-icon" href="app-assets/images/logo/favicon-apple.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- BEGIN VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/flag-icon/css/flag-icon.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/dropify/css/dropify.min.css">

        <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/materialize.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/style.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/pages/app-invoice.css">
        <!-- END Page Level CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/custom/custom.css">
        <link rel="stylesheet" href="./asset/css//print.css">
        <!-- END Custom CSS-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-modern-menu" data-color="" data-col="2-columns">
        <!--
    //////////////////////////////////////////////////////////////////////////// -->
        <!-- START HEADER -->
        <header class="page-topbar" id="header">

            <nav class="whitenav">
                <div class="nav-wrapper">
                    <img class="ajulogo" src="./asset/img/logo.png" alt="su Logo">
                    <ul class="right">
                        <li><a class="dropdown-trigger whitenav" href="#!" data-target="dropdown1"><?php echo $prospectus_applicant_name; ?><i class="material-icons right">arrow_drop_down</i></a>
                            <div id="dropdown1" class="dropdown-content" tabindex="0">
                                <a href="./Backend/logout.php" class="whitenav" tabindex="0">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

        </header>
        <!-- END HEADER -->
        <!-- START MAIN -->
        <div>
            <!-- START WRAPPER -->
            <div class="row">
                <div class="content-wrapper-before blue-grey lighten-5"></div>
                <div class="col s12">
                    <div class="container">
                        <!-- app invoice View Page -->
                        <section class="invoice-view-wrapper section">
                            <div class="row">
                                <!-- invoice view page -->
                                <div class="col l10 m8 s12">
                                </div>
                                <?php if ($payment_status == 'success') { ?>
                                    <div id="printid" class="col l2 m4 s12">
                                        <div class="card invoice-action-wrapper">
                                            <div class="card-content">
                                                <div class="invoice-action-btn">
                                                    <a href="" onclick="printdata()"> <button id="printbutton" onclick="print()" class="btn btn-success"> <span>Print</span> </button> </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col l12 ">
                                    <div class="card">
                                        <div class="card-content invoice-print-area" id="print_pdf_file">
                                            <div class="row">
                                                <div class="col l12" style="text-align: center; width: 100%;">
                                                    <nav class="whitenav" style="background-color: white; box-shadow: none;">
                                                        <div class="nav-wrapper">
                                                            <img src="./asset/img/logo.png" alt="srinth Logo">
                                                        </div>
                                                    </nav>

                                                    <h6 class="printhead">Online Prospectus Form</h6>
                                                </div><br><br>
                                                <div class="row">
                                                    <div class="col l12">
                                                        <strong> Prospectus No : <?php echo $prospectus_no; ?></strong>
                                                    </div>
                                                </div>
                                                <div class="invoice-product-details">
                                                    <table class="striped responsive-table" style="background:#a92a31; color:#fff; padding-top: 10px;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:100%;"><strong>Program Details</strong></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col l4">
                                                        <p><strong>Session</strong></p>
                                                        <p><?php echo $prospectus_session; ?></p>
                                                    </div>
                                                    <div class="col l4">
                                                        <p><strong>Course</strong></p>
                                                        <p><?php echo $prospectus_course_name; ?></p>
                                                    </div>
                                                </div><br>
                                                <div class="invoice-product-details">
                                                    <table class="striped responsive-table" style="background:#a92a31; color:#fff; padding-top: 10px;">
                                                        <thead>
                                                            <tr>
                                                                <th><strong>Personal Details</strong></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Your Name</strong></p>
                                                        <p><?php echo $prospectus_applicant_name; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Mobile Number</strong></p>
                                                        <p><?php echo $mobile; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Email</strong></p>
                                                        <p><?php echo $prospectus_emailid; ?></p>
                                                    </div>
                                                </div><br>
                                                <div class="row">

                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Gender</strong></p>
                                                        <p><?php echo $prospectus_gender; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Date Of Birth</strong></p>
                                                        <p><?php echo $prospectus_dob; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Refered BY</strong></p>
                                                        <p><?php echo $revert_by; ?></p>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Father's Name</strong></p>
                                                        <p><?php echo $prospectus_father_name ?></p>
                                                    </div>

                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Mother's Name</strong></p>
                                                        <p><?php echo $prospectus_mother_name;  ?></p>
                                                    </div>

                                                </div><br>
                                                <div class="row">

                                                </div><br>
                                                <div class="invoice-product-details">
                                                    <table class="striped responsive-table" style="background:#a92a31; color:#fff; padding-top: 10px;">
                                                        <thead>
                                                            <tr>
                                                                <th><strong>Address Details</strong></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Parmanent Address </strong></p>
                                                        <p><?php echo $address->permanet ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Crossponeds Address</strong></p>
                                                        <p><?php echo $address->crosspodens ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Country</strong></p>
                                                        <p><?php echo $prospectus_country; ?></p>
                                                    </div>

                                                </div><br>
                                                <div class="row">
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>City</strong></p>
                                                        <p><?php echo $prospectus_city ?></p>
                                                    </div>

                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>State/Province</strong></p>
                                                        <p><?php echo $prospectus_state; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Postal Code</strong></p>
                                                        <p><?php echo $prospectus_postal_code; ?></p>
                                                    </div>
                                                </div><br>


                                                <div class="invoice-product-details">
                                                    <table class="striped responsive-table" style="background:#a92a31; color:#fff; padding-top: 10px;">
                                                        <thead>
                                                            <tr>
                                                                <th><strong>Payment Details</strong></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Payment mode</strong></p>
                                                        <p><?php echo $prospectus_payment_mode; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Amount </strong></p>
                                                        <p><?php echo $prospectus_rate; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Deposit To</strong></p>
                                                        <p><?php echo $prospectus_deposit_to; ?></p>
                                                    </div>

                                                </div><br>
                                                <div class="row">
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Transaction Date</strong></p>
                                                        <p><?php echo $transaction_date; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Transaction Id</strong></p>
                                                        <p><?php echo $transaction_id; ?></p>
                                                    </div>
                                                    <div class="col l4" style="width: 33.33%">
                                                        <p><strong>Easebuzz Id</strong></p>
                                                        <p><?php echo $easebuzz_id; ?></p>
                                                    </div>
                                                </div><br>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section><!-- START RIGHT SIDEBAR NAV -->

                        <!-- END RIGHT SIDEBAR NAV -->
                    </div>
                    <div class="center-align red-text">For any query feel free to contact @ +91 9234459983
                    </div>
                    <br>
                    <div class="content-overlay"></div>
                </div>
            </div>
            <!-- END WRAPPER -->
        </div>
        <!-- END MAIN -->
        <!--
      //////////////////////////////////////////////////////////////////////////// -->
        <!-- START FOOTER -->
        <footer class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow"></footer>
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
        <script src="app-assets/js/scripts/app-invoice.js"></script>
        <!-- END PAGE LEVEL JS-->



    </body>

    </html>
<?php
} else {
    echo "<script>

    window.location.replace('./index.php');
</script>";
}
?>
<script>
    function printPageArea(areaID) {
        var printContent = document.getElementById(areaID);
        var WinPrint = window.open('', '', 'width=900,height=850');
        WinPrint.document.write(printContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();

       
    }
</script>