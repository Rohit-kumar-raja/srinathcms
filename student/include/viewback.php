<?php
//Starting Session
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "config.php";
// Setting Time Zone in India Standard Timing
$random_number = rand(111111, 999999); // Random Number
$s_no = 1; //Serial Number
$visible = md5("visible");
$trash = md5("trash");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
//All File Directries Start
$university_logos_dir = "../images/university_logos";
$admission_profile_image_dir = "images/student_images";
$certificates = "images/student_certificates";
//All File Directries End
if (isset($_GET["action"])) {
    //Action Section Start
    /* ---------- All Admin(Backend) View Codes Start ---------- */
    /* ------------------------------------------------- Fee Payment Start -------------------------------------------------- */
    // Student fee start
    if ($_GET["action"] == "fetch_student_fee_details") {
        $studentRegistrationNo = $_POST["studentRegistrationNo"];
        if (!empty($studentRegistrationNo)) {
            $sql = "SELECT *
                        FROM `tbl_admission` where `admission_id`='$studentRegistrationNo'
                        -- INNER JOIN `tbl_university_details` ON `tbl_admission`.`admission_session` = `tbl_university_details`.`university_details_id`
                        -- INNER JOIN `tbl_course` ON `tbl_admission`.`admission_course_name` = `tbl_course`.`course_id`
                        -- WHERE `tbl_admission`.`admission_id` = '$studentRegistrationNo' && `tbl_admission`.`status` = '$visible' && `tbl_course`.`status` = '$visible' && `tbl_university_details`.`status` = '$visible'
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                //Define Variables Section Start
                //Numeric Veriables
                $arrayFee = array(); //In Amount or In Number
                $arrayFine = array(); //In Amount or In Number
                $arrayRemaining = array(); //In Amount or In Number
                $arrayRebate = array(); //In Amount or In Number
                $totalFee = 0; //In Amount or In Number
                $totalFine = 0; //In Amount or In Number
                $totalRemaining = 0; //In Amount or In Number
                $totalRemainings = 0; //In Amount or In Number
                $totalRebate = 0; //In Amount or In Number
                $totalPaid = 0; //In Amount or In Number
                //String Variables
                $arrayPerticular = array();
                $arrayTblFee = array();
                $objTblFee = "";
                //Checking If Hostel If Available Or Not
                $course_name = $row["admission_course_name"];
                $course_id_query = "SELECT * FROM `tbl_course` WHERE `course_name`='$course_name' ";
                $course_id_result = mysqli_query($con, $course_id_query);
                $course_data = mysqli_fetch_array($course_id_result);
                $course_id = $course_data['course_id'];

                // course session
                $session_qury = "SELECT * FROM `tbl_admission` WHERE `admission_course_name`='$course_name'";
                $result_session = mysqli_query($con, $session_qury);
                $session_data = mysqli_fetch_array($result_session);
                $admission_sesssion = $session_data['admission_session'];
                // checking the condition admission session
                if ($admission_sesssion == '01/04/ 2021 -31/03/ 2024') {
                    $admission_sesssion = 3;
                } elseif ($admission_sesssion == '01/04/ 2021 -31/03/ 2023') {
                    $admission_sesssion = 2;
                } else {
                    $admission_sesssion = 2;
                }
                if (strtolower($row["admission_hostel"]) == "yes")
                    $sqlTblFee = "SELECT *
                                     FROM `tbl_fee`
                                     WHERE `status` = '$visible' AND `course_id` = '$course_id' AND `fee_academic_year` = '$admission_sesssion' ORDER BY `fee_particulars` ASC
                                     ";
                else
                    //$sqlTblFee = "SELECT *
                    //FROM `tbl_fee`
                    //WHERE `status` = '$visible' AND `course_id` = '".$row["admission_course_name"]."' AND `fee_academic_year` = '".$row["admission_session"]."' AND `fee_particulars` NOT IN ('HOSTEL FEE', 'hostel fee', 'Hostel Fee', 'HOSTELS FEES', 'hostels fees', 'Hostels Fees', 'HOSTELS FEE', 'hostels fee', 'Hostels Fee', 'HOSTEL FEES', 'hostel fees', 'Hostel Fees') ORDER BY `fee_particulars` ASC
                    //  ";

                    $sqlTblFee = "SELECT *
                                     FROM `tbl_fee`
                                     WHERE `status` = '$visible' AND `course_id` = '$course_id' AND `fee_academic_year` = '$admission_sesssion' AND `fee_particulars` NOT IN ('HOSTEL FEE', 'hostel fee', 'Hostel Fee', 'HOSTELS FEES', 'hostels fees', 'Hostels Fees', 'HOSTELS FEE', 'hostels fee', 'Hostels Fee', 'HOSTEL FEES', 'hostel fees', 'Hostel Fees', '1st Year Hostel Fee', '1ST YEAR HOSTEL FEE', '2nd Year Hostel Fee', '2ND YEAR HOSTEL FEE', '3rd Year Hostel Fee', '3RD YEAR HOSTEL FEE', '4th Year Hostel Fee', '4TH YEAR HOSTEL FEE', '5th Year Hostel Fee', '5TH YEAR HOSTEL FEE', '6th Year Hostel Fee', '6TH YEAR HOSTEL FEE') ORDER BY `fee_particulars` ASC
                                     ";
                $resultTblFee = $con->query($sqlTblFee);
                if ($resultTblFee->num_rows > 0)
                    while ($rowTblFee = $resultTblFee->fetch_assoc()) {
                        $totalFee = $totalFee + intval($rowTblFee["fee_amount"]);
                        if (strtotime(date($rowTblFee["fee_lastdate"])) < strtotime(date("Y-m-d")))
                            $noOfDays = (strtotime(date("Y-m-d")) - strtotime(date($rowTblFee["fee_lastdate"]))) / 60 / 60 / 24;
                        else
                            $noOfDays = 0;
                        if ($rowTblFee["fee_astatus"] == "Active")
                            $fine_particular = $rowTblFee["fee_fine"];
                        else
                            $fine_particular = 0;
                        $completeArray = array(
                            "fee_id" => $rowTblFee["fee_id"],
                            "fee_particulars" => $rowTblFee["fee_particulars"],
                            "fee_amount" => $rowTblFee["fee_amount"],
                            "fee_paid" => 0,
                            "fee_fine" => $fine_particular,
                            "fee_rebate" => 0,
                            "fee_remaining" => $rowTblFee["fee_amount"],
                            "fee_fine_days" => $noOfDays
                        );
                        array_push($arrayTblFee, $completeArray);
                    }
                $arrayTblFee = json_decode(json_encode($arrayTblFee));
                $sqlTblFeePaid = "SELECT *
                                     FROM `tbl_fee_paid`
                                     WHERE `status` = '$visible' AND `student_id` = '" . $studentRegistrationNo . "' AND `payment_status` IN ('cleared', 'pending')
                                     ";
                $resultTblFeePaid = $con->query($sqlTblFeePaid);
                if ($resultTblFeePaid->num_rows > 0)
                    while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {
                        $arrayPaidId = explode(",", $rowTblFeePaid["particular_id"]);
                        $arrayPaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);
                        for ($i = 0; $i < count($arrayPaidId); $i++) {
                            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                if ($arrayTblFeeUpdate->fee_id == $arrayPaidId[$i]) {
                                    $totalPaid = $totalPaid + intval($arrayPaidAmount[$i]);
                                    if ($rowTblFeePaid["rebate_amount"] != "") {
                                        $arrayRebateAmount = explode(",", $rowTblFeePaid["rebate_amount"]);
                                        if ($arrayTblFeeUpdate->fee_id == intval($arrayRebateAmount[1])) {
                                            $totalRebate = $totalRebate + intval($arrayRebateAmount[0]);
                                            $arrayTblFeeUpdate->fee_rebate = $arrayTblFeeUpdate->fee_rebate + intval($arrayRebateAmount[0]);
                                        }
                                    }
                                    $arrayTblFeeUpdate->fee_paid = $arrayTblFeeUpdate->fee_paid + intval($arrayPaidAmount[$i]);
                                    $arrayTblFeeUpdate->fee_remaining = $arrayTblFeeUpdate->fee_remaining - intval($arrayPaidAmount[$i]);
                                }
                            }
                        }
                    }
                //Define Variables Section End
?>

                <body>
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <?php
                                        if (!empty($row["admission_profile_image"])) {
                                        ?>
                                            <img class="profile-user-img " src=<?php echo  ' "data:image/jpeg;base64,' . base64_encode($row["admission_profile_image"]) . '" ' ?> alt="Student profile picture">
                                        <?php
                                        } else if (strtolower($row["admission_gender"]) == "female") {
                                        ?>
                                            <img class="profile-user-img img-fluid img-circle" src="images/womenIcon.png" alt="Student profile picture">
                                        <?php } else {   ?>
                                            <img class="profile-user-img img-fluid img-circle" src="images/menIcon.png" alt="Student profile picture">
                                        <?php } ?>
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $row["admission_first_name"] ?></h3>
                                    <?php
                                    $completeSessionStart = explode("-", $row["university_details_academic_start_date"]);
                                    $completeSessionEnd = explode("-", $row["university_details_academic_end_date"]);
                                    $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                    ?>
                                    <p class="text-muted text-center">( <?php echo $row["course_name"] . " | " . $completeSessionOnlyYear; ?> )</p>

                                    <p>
                                        <b>Reg. No</b> <a class="float-right"><?php echo $row["admission_id"]; ?></a></br>


                                        <b>Course Name</b> <a class="float-right"><?php echo $row["course_name"]; ?></a></br>

                                        <b>Session</b> <a class="float-right"><?php echo $completeSessionOnlyYear; ?></a></br>

                                        <b>Hostel</b> <a class="float-right"><?php echo $row["admission_hostel"]; ?></a></br>

                                        <b>User Name</b> <a class="float-right"><?php echo $row["admission_username"]; ?></a></br>

                                        <b>Status</b> <a class="float-right">Active</a>
                                    </p>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About <?php echo $row["admission_first_name"]; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fas fa-user mr-1"></i> Personal Details</strong>
                                    <p class="text-muted">
                                        <b>Name - </b><?php echo $row["admission_first_name"] ?><br />
                                        <b>Gender - </b><?php echo $row["admission_gender"]; ?><br />
                                        <b>DOB - </b><?php echo $row["admission_dob"]; ?><br />
                                        <b> Nationality - </b><?php echo $row["admission_nationality"]; ?><br />
                                        <b> Blood Group - </b><?php echo $row["admission_blood_group"]; ?><br />
                                        <b> Email - </b><?php echo $row["admission_emailid_student"]; ?><br />
                                        <b>Contact No - </b><?php echo $row["admission_mobile_student"]; ?><br />
                                        <b>Father's Name - </b><?php echo $row["admission_father_name"]; ?><br />
                                        <b>Father's Email - </b><?php echo $row["admission_emailid_father"]; ?><br />
                                        <b>Father's Contact - </b><?php echo $row["admission_father_phoneno"]; ?><br />
                                        <b>Father's Whatsapp - </b><?php echo $row["admission_father_whatsappno"]; ?><br />
                                        <b> Mother's Name - </b><?php echo $row["admission_mother_name"]; ?><br />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">More Informations</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <h6><i class="fas fa-book mr-1"></i> Educational Details (10th)</h6>
                                    <p class="text-muted">
                                        University - <?php echo $row["admission_high_school_board_university"]; ?><br />
                                        College - <?php echo $row["admission_high_school_college_name"]; ?><br />
                                        Passing Year - <?php echo $row["admission_high_school_passing_year"]; ?><br />
                                        Percentage - <?php echo $row["admission_high_school_per"]; ?> %<br />
                                    </p>

                                    <h6><i class="fas fa-map-marker-alt mr-1"></i> Location</h6>
                                    <p class="text-muted">
                                        <?php echo $row["admission_residential_address"]; ?>,<br />
                                        <?php echo $row["admission_city"]; ?>, </br><?php echo $row["admission_state"]; ?><br />
                                        <?php echo $row["admission_district"]; ?>,<br />
                                        <?php echo $row["admission_pin_code"]; ?><br />
                                    </p>
                                </div>
                                <!-- /.card-body -->

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#payfee" data-toggle="tab">Fee Payment</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#paidfee" data-toggle="tab">Paid Info</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="payfee">
                                            <form method="POST" id="PayFeeForm">
                                                <!-- Table row -->
                                                <div class="row">
                                                    <input type="hidden" name="registrationNumber" value="<?php echo $studentRegistrationNo; ?>" readonly />
                                                    <input type="hidden" name="courseId" value="<?php echo $row["course_id"]; ?>" readonly />
                                                    <input type="hidden" name="academicYear" value="<?php echo $row["university_details_id"]; ?>" readonly />
                                                    <div class="col-12 table-responsive">
                                                        <h5>Fee Details of <b><a href="javascript:void(0);"><?php echo $row["course_name"] . " | " . $completeSessionOnlyYear; ?></a></b></h5>
                                                        <table class="table table-bordered table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Particulars</th>
                                                                    <th>Amount</th>
                                                                    <th>Paid</th>
                                                                    <th>Rebate</th>
                                                                    <th>Remaining</th>
                                                                    <th>Fine</th>
                                                                    <th><span class="text-red">Total<sup class="text-yellow ml-1 text-xs">(Including Fine)</sup></span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $tmpSNo = 1;
                                                                foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                                    if ((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) {
                                                                        $totalRemainings = $totalRemainings + 0;
                                                                        $totalRemaining = $totalRemaining + 0;
                                                                        $totalFine = $totalFine + 0;
                                                                    } else {
                                                                        $totalRemainings = $totalRemainings + (($arrayTblFeeUpdate->fee_remaining) + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)) - ($arrayTblFeeUpdate->fee_rebate));
                                                                        $totalRemaining = $totalRemaining + (($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate));
                                                                        $totalFine = $totalFine + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days));
                                                                    }

                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $tmpSNo; ?></td>
                                                                        <td><?php echo $arrayTblFeeUpdate->fee_particulars; ?></td>
                                                                        <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_amount); ?></td>
                                                                        <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_paid); ?></td>
                                                                        <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_rebate); ?></td>
                                                                        <?php
                                                                        if ((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) {
                                                                        ?>
                                                                            <td>&#8377; <?php echo 0; ?></td>
                                                                            <td>&#8377; <?php echo 0; ?></td>
                                                                            <td><span class="text-red text-bold">&#8377; <?php echo 0; ?></span></td>
                                                                        <?php } else {
                                                                        ?>
                                                                            <td>&#8377; <?php echo number_format(($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)); ?></td>
                                                                            <td>&#8377; <?php echo number_format(($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)); ?></td>
                                                                            <td><span class="text-red text-bold">&#8377; <?php echo number_format(($arrayTblFeeUpdate->fee_remaining) + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)) - ($arrayTblFeeUpdate->fee_rebate)); ?></span></td>
                                                                        <?php
                                                                        } ?>
                                                                    </tr>
                                                                <?php
                                                                    $tmpSNo++;
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="text-right text-bold">Total</td>
                                                                    <td class="text-bold">&#8377; <?php echo number_format($totalFee); ?></td>
                                                                    <td class="text-bold">&#8377; <?php echo number_format($totalPaid); ?></td>
                                                                    <td class="text-bold">&#8377; <?php echo number_format($totalRebate); ?></td>
                                                                    <td class="text-bold">&#8377; <?php echo number_format($totalRemaining); ?></td>
                                                                    <td class="text-bold">&#8377; <?php echo number_format($totalFine); ?></td>
                                                                    <td class="text-bold"><span class="text-red"> &#8377; <?php echo number_format($totalRemainings); ?></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="col-md-6" style="float:right">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Payment Date</span>
                                                                    </div>
                                                                    <input type="date" name="paymentDate" class="form-control" value="<?php echo date("Y-m-d"); ?>" onkeyup="completeCalculation();" onclick="completeCalculation();" onchange="completeCalculation();" />
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                        </div>
                                                        <h5>Pay Remaining<b><a href="javascript:void(0);"> Fee</a></b></h5>
                                                        <p id="errorMessage" class="text-red"></p>
                                                        <table class="table table-bordered table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Particulars</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $tmpSNo = 1;
                                                                $Idno = 0;
                                                                foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $tmpSNo; ?></td>
                                                                        <td><?php echo $arrayTblFeeUpdate->fee_particulars; ?></td>
                                                                        <td>
                                                                            <input type="hidden" name="particular_paid_id[<?php echo $Idno; ?>]" value="<?php echo $arrayTblFeeUpdate->fee_id; ?>" />
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text">&#8377;</span>
                                                                                </div>
                                                                                <!--<input id="particular_paid_amount[<?php //echo $Idno; 
                                                                                                                        ?>]" name="particular_paid_amount[<?php //echo $Idno; 
                                                                                                                                                            ?>]" min="0" max="<?php //echo (($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)); 
                                                                                                                                                                                ?>" type="number" class="form-control" onKeyup="completeCalculation();" onClick="completeCalculation();" onChange="completeCalculation();" onBlur="completeCalculation();" <?php //if((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) echo "readonly"; 
                                                                                                                                                                                                                                                                                                                                                            ?>>-->
                                                                                <input id="particular_paid_amount[<?php echo $Idno; ?>]" name="particular_paid_amount[<?php echo $Idno; ?>]" min="0" value="<?php echo ($arrayTblFeeUpdate->fee_remaining) + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)) - ($arrayTblFeeUpdate->fee_rebate); ?>" onmouseover="completeCalculation();" max="<?php echo (($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)); ?>" type="number" class="form-control" <?php //if((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) echo "readonly"; 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ?>readonly>

                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                    $Idno++;
                                                                    $tmpSNo++;
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $tmpSNo; ?></td>
                                                                    <td>Fine</td>
                                                                    <td>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">&#8377;</span>
                                                                            </div>
                                                                            <input id="fine_amount" name="fine_amount" min="0" max="<?php echo $totalFine; ?>" type="number" class="form-control" onKeyup="completeCalculation();" onClick="completeCalculation();" onChange="completeCalculation();" onBlur="completeCalculation();" <?php if ($totalFine == 0) echo "readonly"; ?>>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr style="display:none;">
                                                                    <td><?php echo ++$tmpSNo; ?></td>
                                                                    <td>Rebate</td>
                                                                    <td>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">&#8377;</span>
                                                                            </div>
                                                                            <input id="rebate_amount" name="rebate_amount" min="0" max="" type="number" class="form-control" onKeyup="completeCalculation();" onClick="completeCalculation();" onChange="completeCalculation();" onBlur="completeCalculation();">
                                                                            <div class="input-group-prepend">
                                                                                <select id="rebate_from" name="rebate_from" class="btn btn-danger btn-block form-control" onKeyup="completeCalculation();" onClick="completeCalculation();" onChange="completeCalculation();" onBlur="completeCalculation();">
                                                                                    <option value="">Rebate From</option>
                                                                                    <?php
                                                                                    foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                                                    ?>
                                                                                        <option value="<?php echo $arrayTblFeeUpdate->fee_id; ?>">From - <?php echo $arrayTblFeeUpdate->fee_particulars; ?></option>
                                                                                    <?php } ?>
                                                                                    <option value="fine">From - Fine</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <small class="text-red" id="rebateErr"></small>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="text-right text-bold">Total</td>
                                                                    <td class="text-bold">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">&#8377;</span>
                                                                            </div>
                                                                            <input id="total_amount" name="total_amount" min="0" max="<?php echo $totalRemainings ?>" type="number" class="form-control" readonly>
                                                                        </div>
                                                                        <small class="text-red" id="totalErr"></small>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="text-right text-bold">Remaining</td>
                                                                    <td class="text-bold">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">&#8377;</span>
                                                                            </div>
                                                                            <input id="remaining_amount" name="remaining_amount" min="0" value="<?php echo $totalRemainings ?>" type="number" style="font-weight: 900;color: #dc3545;" class="form-control" readonly>
                                                                            <!--<input id="remaining_amount" name="remaining_amount" min="0" value="0<?php //echo $totalRemainings 
                                                                                                                                                        ?>" type="number" style="font-weight: 900;color: #dc3545;" class="form-control" readonly>-->

                                                                        </div>
                                                                        <small class="text-red" id="remainingErr"></small>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>


                                                    </div>
                                                    <!-- /.col -->

                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Payment Mode</label>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-university"></i></span>
                                                                </div>
                                                                <select id="PaymentMode" name="PaymentMode" class="form-control" onchange="">
                                                                    <option value="Online">Online</option>
                                                                </select>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" id="cash_div" style="">
                                                        <label>Deposit To</label>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-money-check"></i></span>
                                                                </div>
                                                                <select id="cashDepositTo" name="cashDepositTo" class="form-control">
                                                                    <option value="University Office">University Office</option>
                                                                </select>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="receiptDate_div" style="">
                                                        <label>Receipt Date</label>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                                </div>
                                                                <input id="paidDate" name="paidDate" type="date" class="form-control" value="<?php echo date("Y-m-d"); ?>" />
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12"></div>
                                                    <div class="col-md-12" id="" style="margin-top:20px;"></div>
                                                    <div class="col-md-3" id="pay_div" style=" margin-top:20px;">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="hidden" name="action" value="pay_fees" />
                                                                <button id="PayFeeButton" name="PayFeeButton" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal" onclick="completeCalculation">Pay & Confirm</button>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-3" id="reset_div" style="margin-top:20px;">
                                              <div class="form-group">
                                                  <div class="input-group">
                                                      <button class="btn btn-danger btn-lg btn-block" type="reset" onclick="return confirm('Are you sure you want to reset all Informations???');" >Reset</button>
                                                  </div>
                                                  
                                              </div>
                                          </div>-->


                                                </div>
                                                <!-- /.row -->
                                            </form>

                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            $len = 10;   // total number of numbers
                                                            $min = 1000;  // minimum
                                                            $max = 9999;  // maximum
                                                            $range = []; // initialize array
                                                            foreach (range(0, $len - 1) as $i) {
                                                                while (in_array($num = mt_rand($min, $max), $range));
                                                                $range[] = $num;
                                                            }
                                                            ?>

                                                            <form id="payment_form" method="post" action="easebuzz/easebuzz.php?api_name=initiate_payment">
                                                                <input type="hidden" name="paymode" value="9" />
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Transaction ID</label>
                                                                        <input id="txnid" class="form-control" name="txnid" value="<?php echo $num; ?>" placeholder="" readonly>
                                                                    </div>

                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Amount</label>
                                                                        <!--<input class="form-control" id="amount"  name="amount" value="<?php //echo $_SESSION["remaining_amount"] 
                                                                                                                                            ?>" readonly>-->
                                                                        <input class="form-control" id="amount" name="amount" value="" readonly>

                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Name</label>
                                                                        <input id="firstname" class="form-control" name="firstname" value="<?php echo $row["admission_first_name"] . " " . $row["admission_last_name"]; ?>" placeholder="" readonly>
                                                                    </div>

                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Course</label>
                                                                        <input id="course" class="form-control" name="udf1" value="<?php echo $row["course_name"]; ?>" placeholder="" readonly>
                                                                        <?php $_SESSION["course_name"] = $row['course_name']; ?>
                                                                    </div>

                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Session</label>
                                                                        <input id="course" class="form-control" name="udf2" value="<?php echo $completeSessionOnlyYear; ?>" placeholder="" readonly>
                                                                        <?php //$_SESSION['".$completeSessionOnlyYear."]= $completeSessionOnlyYear; 
                                                                        ?>
                                                                    </div>


                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Email ID</label>
                                                                        <input id="email" class="form-control" name="email" value="<?php echo $row["admission_emailid_student"] ?>" placeholder="" readonly>
                                                                        <?php $_SESSION["admission_emailid_student"] = $row['admission_emailid_student']; ?>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Phone No</label>
                                                                        <input id="phone" class="form-control" name="phone" value="<?php echo $row["admission_mobile_student"] ?>" placeholder="" readonly>
                                                                        <?php $_SESSION["admission_mobile_student"] = $row['admission_mobile_student']; ?>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Status</label>
                                                                        <input id="productinfo" class="form-control" name="productinfo" value="<?php echo "Fee"; ?>" placeholder="" readonly>
                                                                    </div>
                                                                    <input type="hidden" id="surl" class="surl" name="surl" value="https://nsucms.in/nsucms/student/success" placeholder="">
                                                                    <input type="hidden" id="furl" class="furl" name="furl" value="https://nsucms.in/nsucms/student/success" placeholder="">
                                                                    <div class="form-group col-md-4 mt-2">
                                                                        <button class="btn btn-primary btn-lg btn-block" type="submit" name="button"><i class="fa fa-paper-plane"></i> Pay </button>
                                                                    </div>
                                                                </div>
                                                                <!-- Submit And Payment Section Ends -->
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <script>
                                                window.onscroll = function() {
                                                    completeCalculation()
                                                };

                                                //alert('working');
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
                                                    totalPaid = totalPaid + parseInt(totalParticular);
                                                    //alert(totalPaid); 
                                                    totalPaid = totalPaid + parseInt(fineAmount);
                                                    remainingAmount = parseInt(<?php echo $totalRemainings; ?>) - parseInt(totalPaid) - parseInt(rebateAmount);
                                                    $("#total_amount").val(totalPaid);
                                                    $("#amount").val(totalPaid + ".0");
                                                    $("#remaining_amount").val(remainingAmount);
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
                                            </script>
                                            <script>
                                                function PaymentModeSelect(PaymentMode) {
                                                    var cash_div = document.getElementById('cash_div');
                                                    var bankName_div = document.getElementById('bankName_div');
                                                    var chequeNo_div = document.getElementById('chequeNo_div');
                                                    var receiptDate_div = document.getElementById('receiptDate_div');
                                                    var notes_div = document.getElementById('notes_div');
                                                    var pay_div = document.getElementById('pay_div');
                                                    if (PaymentMode == "Cash") {
                                                        cash_div.style.display = "block";
                                                        bankName_div.style.display = "none";
                                                        chequeNo_div.style.display = "none";
                                                        receiptDate_div.style.display = "block";
                                                        notes_div.style.display = "block";
                                                        pay_div.style.display = "block";
                                                    } else if (PaymentMode == "Cheque" || PaymentMode == "DD" || PaymentMode == "Online" || PaymentMode == "NEFT/IMPS/RTGS") {
                                                        cash_div.style.display = "none";
                                                        bankName_div.style.display = "block";
                                                        chequeNo_div.style.display = "block";
                                                        receiptDate_div.style.display = "block";
                                                        notes_div.style.display = "block";
                                                        pay_div.style.display = "block";
                                                    } else {
                                                        cash_div.style.display = "none";
                                                        bankName_div.style.display = "none";
                                                        chequeNo_div.style.display = "none";
                                                        receiptDate_div.style.display = "none";
                                                        notes_div.style.display = "none";
                                                        pay_div.style.display = "none";
                                                    }
                                                }
                                            </script>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#PayFeeForm').submit(function(event) {
                                                        $('#PayText').hide();
                                                        $('#loader_section_on_pay_fee').append('<img id = "loading" width="30px" src = "images/ajax-loader.gif" alt="Currently loading" />');
                                                        $('#PayFeeButton').prop('disabled', true);
                                                        $.ajax({
                                                            url: 'include/controller.php',
                                                            type: 'POST',
                                                            data: $('#PayFeeForm').serializeArray(),
                                                            success: function(result) {
                                                                $('#response_on_pay_fee').remove();
                                                                if (result == "success") {
                                                                    $('#error_on_pay_fee').append('<div id = "response_on_pay_fee"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Fee Paid Successfully!!!</div></div>');
                                                                    $('#PayFeeForm')[0].reset();
                                                                    $('#loading').fadeOut(1000, function() {
                                                                        $(this).remove();
                                                                        $('#PayText').show();
                                                                        $('#PayFeeButton').prop('disabled', false);
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
                                                                    });
                                                                } else
                                                                    $('#error_on_pay_fee').append('<div id = "response_on_pay_fee">' + result + '</div>');
                                                                $('#loading').fadeOut(500, function() {
                                                                    $(this).remove();
                                                                    $('#PayText').show();
                                                                    $('#PayFeeButton').prop('disabled', false);
                                                                });
                                                            }
                                                        });
                                                        event.preventDefault();
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="paidfee">
                                            <!-- The timeline -->
                                            <div class="timeline timeline-inverse">
                                                <?php
                                                $sql_paid_time = "SELECT * FROM `tbl_fee_paid`
                                                        WHERE `status` = '$visible' && `student_id` = '$studentRegistrationNo' && `payment_status` != 'deleted'
                                                        ORDER BY `receipt_date` DESC
                                                        ";
                                                $result_paid_time = $con->query($sql_paid_time);
                                                if ($result_paid_time->num_rows > 0) {
                                                    while ($row_paid_time = $result_paid_time->fetch_assoc()) {
                                                        $allPerticulars = explode(",", $row_paid_time["paid_amount"]);
                                                        $totalPerticular = 0;
                                                        for ($i = 0; $i < count($allPerticulars); $i++)
                                                            $totalPerticular = $totalPerticular + intval($allPerticulars[$i]);
                                                        $totalAmount = $totalPerticular + intval($row_paid_time["fine"]) - intval($row_paid_time["rebate_amount"]);

                                                ?>
                                                        <!-- Timeline Section Start -- >
                                          <!-- timeline time label -->
                                                        <div class="time-label">
                                                            <span class="bg-success">
                                                                <?php echo date("d M, Y", strtotime($row_paid_time["receipt_date"])); ?>
                                                            </span>
                                                        </div>
                                                        <!-- /.timeline-label -->
                                                        <!-- timeline item -->
                                                        <div>
                                                            <i class="fas fa-money-check bg-info"></i>

                                                            <div id="fee_Status_section_full<?php echo $row_paid_time["feepaid_id"]; ?>" class="timeline-item" style="background-color:<?php if (strtolower($row_paid_time["payment_status"]) == "bounced") echo '#ffcccb';
                                                                                                                                                                                        if (strtolower($row_paid_time["payment_status"]) == "pending") echo '#ffffed';
                                                                                                                                                                                        if (strtolower($row_paid_time["payment_status"]) == "refunded") echo '#ffa7a7'; ?>;">
                                                                <span class="time"><i class="far fa-clock"></i> <?php echo $row_paid_time["fee_paid_time"]; ?> </span>

                                                                <h3 class="timeline-header"><a href="javascript:void(0);">Payment Information</a></h3>

                                                                <div class="timeline-body">
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Total Perticular</th>
                                                                                <th>Fine</th>
                                                                                <th>Rebate</th>
                                                                                <th>Total Paid</th>
                                                                                <th><span class="text-red">Remaining</span></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>&#8377; <?php echo number_format(intval($totalPerticular)); ?></td>
                                                                                <td>&#8377; <?php echo number_format(intval($row_paid_time["fine"])); ?></td>
                                                                                <td>&#8377; <?php echo number_format(intval($row_paid_time["rebate_amount"])); ?></td>
                                                                                <td>&#8377; <?php echo number_format(intval($totalAmount) + intval($row_paid_time["rebate_amount"])); ?></td>
                                                                                <td>&#8377; <?php echo number_format(intval($row_paid_time["balance"])); ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <h5 class="timeline-header"><a href="javascript:void(0);">Payment Mode</a> ~ <?php echo $row_paid_time["payment_mode"]; ?></h5>
                                                                    <h5 class="timeline-header"><a href="javascript:void(0);">Payment Status</a> ~ <span id="fee_Status_section<?php echo $row_paid_time["feepaid_id"]; ?>"><span class="<?php if (strtolower($row_paid_time["payment_status"]) == "bounced") echo 'bg-danger';
                                                                                                                                                                                                                                            if (strtolower($row_paid_time["payment_status"]) == "refunded") echo 'bg-danger';
                                                                                                                                                                                                                                            else if (strtolower($row_paid_time["payment_status"]) == "pending") echo 'bg-warning'; ?>"><?php echo strtoupper($row_paid_time["payment_status"]); ?></span></span> </h5>
                                                                </div>
                                                                <div class="timeline-footer" align="right" style="display:none">
                                                                    <h5 class="timeline-header"><a href="javascript:void(0);">Give Status Here</a></h5>
                                                                    <?php if ($row_paid_time["payment_status"] == "refunded") { ?>
                                                                        <a onclick="statusChange('<?php echo $row_paid_time["feepaid_id"]; ?>' ,'cleared')" class="btn btn-info btn-sm">Add this Fee</a>
                                                                        <a onclick="statusChange('<?php echo $row_paid_time["feepaid_id"]; ?>' ,'deleted')" class="btn btn-danger btn-sm">Delete</a>
                                                                    <?php } else {
                                                                    ?>
                                                                        <a onclick="statusChange('<?php echo $row_paid_time["feepaid_id"]; ?>' ,'refunded')" class="btn btn-info btn-sm">Refund</a>
                                                                        <a onclick="statusChange('<?php echo $row_paid_time["feepaid_id"]; ?>' ,'deleted')" class="btn btn-danger btn-sm">Delete</a>
                                                                    <?php
                                                                    } ?>
                                                                    <?php if ($row_paid_time["payment_mode"] == "Cheque") { ?>
                                                                        <a onclick="statusChange('<?php echo $row_paid_time["feepaid_id"]; ?>' ,'cleared')" class="btn btn-success btn-sm">Cleared</a>
                                                                        <a onclick="statusChange('<?php echo $row_paid_time["feepaid_id"]; ?>' ,'pending')" class="btn btn-warning btn-sm">Pending</a>
                                                                        <a onclick="statusChange('<?php echo $row_paid_time["feepaid_id"]; ?>' ,'bounced')" class="btn btn-danger btn-sm">Bounced</a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END timeline item -->
                                                        <!-- Timeline Section End -->
                                                    <?php }
                                                } else {
                                                    ?>
                                                    <center><b class="text-red">No any Payment Yet!!!</b></center>
                                                <?php
                                                } ?>
                                                <div>
                                                    <i class="fas fa-money-bill-alt bg-danger"></i>
                                                </div>
                                                <script>
                                                    function statusChange(feepaid_id, statusUpdate) {
                                                        $('#paidfee').css("opacity", "0.4");
                                                        $('#paidfee').css("pointer-events", "none");
                                                        var action = "change_Fee_Status";
                                                        var dataString = 'action=' + action + '&feepaid_id=' + feepaid_id + '&status=' + statusUpdate;
                                                        $.ajax({
                                                            url: 'include/controller.php',
                                                            type: 'POST',
                                                            data: dataString,
                                                            success: function(result) {
                                                                if (result != "error" && result != "empty") {
                                                                    console.log(result);
                                                                    var fullinfo = result.split(',');
                                                                    $('#fee_Status_section' + feepaid_id).html(fullinfo[0]);
                                                                    $('#fee_Status_section_full' + feepaid_id).css("background-color", fullinfo[1]);
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
                                                                }
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
            <?php
            } else
                echo '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  No Student Found!!!</div>';
        } else
            echo "0";
    }
    //Student fee End
    //  fee Calculations Details start
    if ($_GET["action"] == "completeCalculationForFees") {
        $completeCalculationArray = array();
        $totalAmountArry = array();
        $totalPerticularArry = array();
        $completeCalculation = "";
        $paid_perticular_amount = 0;
        $remaining_perticular_amount = 0;
        $fine_perticular_amount = 0;
        $total_perticular_amount = 0;
        $total_paid_perticular_amount = 0;
        $total_remaining_perticular_amount = 0;
        $total_fine_perticular_amount = 0;
        $total_total_perticular_amount = 0;
        $particular_paid_amount = 0;
        $fine_amount = 0;
        $rebate_amount = 0;
        $total_amount = 0;
        $remaining_amount = 0;
        $last_fine = 0;
        $errorMessage = "";
        $registrationNumber = $_POST["registrationNumber"];
        $academicYear = $_POST["academicYear"];
        $courseId = $_POST["courseId"];
        $hostelCheck = $_POST["hostelCheck"];
        $paymentDate = $_POST["paymentDate"];
        $sql_paid = "SELECT * FROM `tbl_fee_paid`
                        WHERE `status` = '$visible' && `student_id` = '$registrationNumber' && `university_details_id` = '$academicYear'
                        ";
        $result_paid = $con->query($sql_paid);
        while ($row_paid = $result_paid->fetch_assoc()) {
            $last_balance = $row_paid["balance"];
            $last_fine = intval($row_paid["fine"]);
            $amountsPaid = explode(",", $row_paid["paid_amount"]);
            $totalPerticularArry = explode(",", $row_paid["particular_id"]);
            $totalAmountVal = 0;
            for ($i = 0; $i < count($amountsPaid); $i++) {
                if (!isset($totalAmountArry[$i]) && empty($totalAmountArry[$i]))
                    $totalAmountArry[$i] = 0;
                $totalAmountArry[$i] = $totalAmountArry[$i] + intval($amountsPaid[$i]);
            }
            if ($last_balance == 0)
                $submitClose = "";
        }
        $sql_fee = "SELECT * FROM `tbl_fee`
                        WHERE `status` = '$visible' && `course_id` = '$courseId' && `fee_academic_year` = '$academicYear'
                       ";
        $result_fee = $con->query($sql_fee);
        $sno = 0;
        $Idno = 0;
        $total_fees = 0;
        $total_paid = 0;
        $total_remaining = 0;
        $total_fine = 0;
        while ($row_fee = $result_fee->fetch_assoc()) {
            $fee_perticular = 0;
            if (strtolower($hostelCheck) == "yes") {
                $sno++;
                $total_fees = $total_fees + $row_fee["fee_amount"];
                $fine_perticular_amountArray[$Idno] = 0;
                $total_perticular_amountArray[$Idno] = 0;
                if (isset($totalAmountArry[$Idno])) {
                    $total_paid = $total_paid + $totalAmountArry[$Idno];
                    if ($totalAmountArry[$Idno] == $row_fee["fee_amount"]) {
                        $total_fine = $total_fine + 0;
                        $fee_perticular = 0;
                        $fine_perticular_amountArray[$Idno] = $fee_perticular;
                        $total_perticular_amountArray[$Idno] = $fee_perticular;
                    } else {
                        $beforeDate = date($row_fee["fee_lastdate"]);
                        if ($paymentDate > $beforeDate) {
                            if ($row_fee["fee_astatus"] == "Active") {
                                $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            }
                        }
                        $total_perticular_amountArray[$Idno] = $row_fee["fee_amount"] + ($fee_perticular + $totalAmountArry[$Idno]);
                    }
                } else {
                    $beforeDate = date($row_fee["fee_lastdate"]);
                    if ($paymentDate > $beforeDate) {
                        if ($row_fee["fee_astatus"] == "Active") {
                            $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                            $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                            $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                            $fine_perticular_amountArray[$Idno] = $fee_perticular;
                        }
                    }
                    $total_perticular_amountArray[$Idno] = $fee_perticular + $row_fee["fee_amount"];
                }
                $Idno++;
            } else {
                if (strtolower($row_fee["fee_particulars"]) != "hostel fee") {
                    $sno++;
                    $total_fees = $total_fees + $row_fee["fee_amount"];
                    $fine_perticular_amountArray[$Idno] = 0;
                    if (isset($totalAmountArry[$Idno])) {
                        $total_paid = $total_paid + $totalAmountArry[$Idno];
                        if ($totalAmountArry[$Idno] == $row_fee["fee_amount"]) {
                            $total_fine = $total_fine + 0;
                            $fee_perticular = 0;
                            $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            $total_perticular_amountArray[$Idno] = $fee_perticular;
                        } else {
                            $beforeDate = date($row_fee["fee_lastdate"]);
                            if ($paymentDate > $beforeDate) {
                                if ($row_fee["fee_astatus"] == "Active") {
                                    $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                    $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                    $fee_perticular = $numberOfDays * intval($row_fee["fee_fine"]);
                                    $fine_perticular_amountArray[$Idno] = $fee_perticular;
                                    $total_perticular_amountArray[$Idno] = $fee_perticular + $totalAmountArry[$Idno];
                                }
                            }
                            $total_perticular_amountArray[$Idno] = $row_fee["fee_amount"] + ($fee_perticular + $totalAmountArry[$Idno]);
                        }
                    } else {
                        $beforeDate = date($row_fee["fee_lastdate"]);
                        if ($paymentDate > $beforeDate) {
                            if ($row_fee["fee_astatus"] == "Active") {
                                $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            }
                        }
                        $total_perticular_amountArray[$Idno] = $fee_perticular + $row_fee["fee_amount"];
                    }
                    $Idno++;
                }
            }
        }
        $total_remaining = $total_fine + ($total_fees - $total_paid);

        if (!empty($_POST["fine_amount"]))
            $fine_amount = $_POST["fine_amount"];
        if (!empty($_POST["rebate_amount"]))
            $rebate_amount = $_POST["rebate_amount"];
        for ($i = 0; $i < count($_POST["particular_paid_amount"]); $i++) {
            if (!empty($_POST["particular_paid_amount"][$i]))
                $total_amount = $total_amount + intval($_POST["particular_paid_amount"][$i]);
        }
        //Total Amount With Fee
        $total_amount = $total_amount + $fine_amount;
        //Total Amount With Rebate
        $total_amount = $total_amount - $rebate_amount;
        //Remaining Total
        $remaining_amount = $total_remaining - $total_amount;
        //Remaining Total Amount With Rebate
        $remaining_amount = $remaining_amount - $rebate_amount;
        //Fine Arrays
        $fine_perticular_amount = implode("|", $fine_perticular_amountArray);
        $total_perticular_amount = implode("|", $total_perticular_amountArray);
        //Set Negative Error
        if ($total_amount < 0 || $remaining_amount < 0 || $fine_perticular_amount < 0)
            $errorMessage .= " Connot Use Negative Values.";
        if ($total_amount > $total_remaining)
            $errorMessage .= " Your total amount Should be less than or equal to ~ $total_remaining.";
        //Complete Calculation
        $completeCalculationArray[] = $total_remaining;
        $completeCalculationArray[] = $total_amount;
        $completeCalculationArray[] = $remaining_amount;
        $completeCalculationArray[] = $fine_perticular_amount;
        $completeCalculationArray[] = $total_perticular_amount;
        $completeCalculationArray[] = $errorMessage;
        //Implode all the Calculations
        $completeCalculation = implode(",", $completeCalculationArray);
        echo $completeCalculation;
    }
    // fee Calculations Details End
    /* ------------------------------------------------ Fee Payment End ------------------------------------------------------- */

    // add exam form list
    if ($_GET["action"] == "fetch_exam_form") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        $amount = $_POST["amount"];
        $subject_id = $_POST["subject_id"];

        $_SESSION["course_id"] = $course_id;
        $_SESSION["academic_year"] = $academic_year;
        $_SESSION["semester_id"] = $semester_id;
        $_SESSION["amount"] = $amount;

        $sql = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' && `admission_username` = '" . $_SESSION["logger_username1"] . "'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $admission_id = $row['admission_id'];

        $sql1 = "SELECT * FROM `tbl_admission_details` WHERE `status` = '$visible' && `admission_id` = '$admission_id' && `course_id` = '" . $_SESSION["course_id"] . "'";
        $adresult = $con->query($sql1);
        $adrow = $adresult->fetch_assoc();


        $sql2 = "SELECT * FROM `tbl_examination_form` WHERE `status` = '$visible' && `course_id` = '" . $_SESSION["course_id"] . "'";
        $depresult = $con->query($sql);
        $deprow = $result->fetch_assoc();


        //echo "<pre>";
        //print_r($adrow); exit;
        //echo $adrow['roll_no']; 
        //echo $row['admission_id']; 
            ?>
            <form action="exam_confirm" method="post" enctype="multipart/form-data">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">PERSONAL DETAILS</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">

                                    <label>Registration Number</label>
                                    <input id="" type="hidden" name="course_id" value="<?php echo $_SESSION['course_id'] ?>" class="form-control">
                                    <input id="" type="hidden" name="academic_year" value="<?php echo $_SESSION['academic_year'] ?>" class="form-control">
                                    <input id="" type="hidden" name="semester_id" value="<?php echo $_SESSION['semester_id'] ?>" class="form-control">
                                    <input id="" type="hidden" name="amount" value="<?php echo $_SESSION['amount'] ?>" class="form-control">
                                    <input id="" type="text" name="registration_no" class="form-control" required value="<?php echo $adrow['reg_no'] ?>">
                                </div>

                                <div class="col-4">
                                    <label>Roll Number</label>
                                    <input id="" type="text" name="roll_no" class="form-control" value="<?php echo $adrow['roll_no'] ?>">
                                </div>

                                <div class="col-4">
                                    <label>Candidate's Name</label>
                                    <input id="" type="hidden" name="candidate_name" class="form-control" value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>">
                                    <input id="" type="text" name="candidate_name" class="form-control" value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Father's Name</label>
                                    <input id="" type="hidden" name="father_name" class="form-control" value="<?php echo $row['admission_father_name'] ?>">
                                    <input id="" type="text" name="father_name" class="form-control" value="<?php echo $row['admission_father_name'] ?>" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Department / Specialisation</label>
                                    <input id="" type="text" name="department" class="form-control" required value="<?php echo $deprow['department'] ?>">
                                </div>

                                <div class="col-4">
                                    <label>Candidate Signature</label>
                                    <input type="file" id="fileSign" onchange="Filevalidation()" name="candidate_signature" class="form-control" required>
                                    <script>
                                        Filevalidation = () => {
                                            var fi = document.getElementById('fileSign');
                                            // Check if any file is selected. 
                                            if (fi.files.length > 0) {
                                                for (i = 0; i <= fi.files.length - 1; i++) {

                                                    var fsize = fi.files.item(i).size;
                                                    var file = Math.round((fsize / 1024));
                                                    // The size of the file. 
                                                    if (file >= 4096) {
                                                        alert(
                                                            "File too Big, please select a file less than 4mb");
                                                        $("#fileSign").val("");
                                                    } else {
                                                        document.getElementById('size').innerHTML = '<b>' +
                                                            file + '</b> KB';
                                                    }
                                                }
                                            }
                                        }
                                    </script>
                                </div>

                                <div class="col-8">
                                    <label>Passport Size Photograph</label><br>
                                    <input type="hidden" name="passport_photo" class="form-control" value="<?php echo $row["admission_profile_image"]; ?>">
                                    <img class="profile-user-img " src="../images/student_images/<?php echo $row["admission_profile_image"]; ?>" alt="Student profile picture">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">PERSONAL DETAILS</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <label>Gender</label>
                                    <input id="" type="hidden" name="gender" class="form-control" value="<?php echo strtoupper($row['admission_gender']) ?>">
                                    <input id="" type="text" name="gender" class="form-control" value="<?php echo strtoupper($row['admission_gender']) ?>" readonly>
                                </div>
                                <div class="col-4">
                                    <label>Date Of Birth</label>
                                    <input id="" type="hidden" name="dob" class="form-control" value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>">
                                    <input id="" type="text" name="dob" class="form-control" value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>">
                                </div>
                                <div class="col-4">
                                    <label>Email Id (Student)</label>
                                    <input id="" type="hidden" name="email_id" class="form-control" value="<?php echo $row['admission_emailid_student'] ?>">
                                    <input id="" type="text" name="email_id" class="form-control" value="<?php echo $row['admission_emailid_student'] ?>">
                                </div>
                                <div class="col-4">
                                    <label>Mobile No.(01)</label>
                                    <input id="" type="hidden" name="mobile_no1" class="form-control" value="<?php echo $row['admission_mobile_student'] ?>">
                                    <input id="" type="text" name="mobile_no1" class="form-control" value="<?php echo $row['admission_mobile_student'] ?>">
                                </div>
                                <div class="col-4">
                                    <label>Mobile No.(02)</label>
                                    <input id="" type="text" name="mobile_no2" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Adhar No</label>
                                    <input id="" type="hidden" name="adhar_no" class="form-control" value="<?php echo $row['admission_aadhar_no'] ?>">
                                    <input id="" type="text" name="adhar_no" class="form-control" value="<?php echo $row['admission_aadhar_no'] ?>">
                                </div>
                                <div class="col-12">
                                    <label>Correspondence Address (for all communication by the University):</label>
                                    <input id="" type="hidden" name="address" class="form-control" value="<?php echo $row['admission_residential_address'] ?>">
                                    <textarea id="address" name="address" class="form-control" value="<?php echo $row['admission_residential_address'] ?>" style="height: 38px;"><?php echo $row['admission_residential_address'] ?></textarea>
                                </div>
                                <div class="col-4">
                                    <label>Last Examination Passed & Year</label>
                                    <input id="" type="text" name="last_exam_year" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
                    <thead>
                        <tr>
                            <th width="10%">S.No</th>
                            <th width="20%">Paper Code</th>
                            <th width="20%">Paper Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //$subject_id = $_POST["subject_id"];                        
                        $sql = "SELECT * FROM `tbl_subjects`  WHERE `status` = '$visible' && course_id = '$course_id' && semester_id = '$semester_id' ORDER BY `subject_id` ASC ";
                        // echo $sql;exit();
                        $row = $con->query($sql);
                        while ($row_course = $row->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $s_no; ?></td>
                                <td> <input type="text" name="paper_code" class="form-control" value="<?php echo $row_course["subject_code"] ?>" readonly></td>
                                <td> <input type="text" name="paper_name" class="form-control" value="<?php echo $row_course["subject_name"] ?>" readonly></td>
                            </tr>
                        <?php
                            $s_no++;
                        }
                        ?>
                    </tbody>
                </table>

                <p>Declaration By the Student :</p>
                <p style="text-align:justify;">I hereby declare that I have read and understood the instructions given above. I also affirm that I have submitted all the required numbers of assignment as applicable for the aforesaid course filled in the examination form and my registration for the course is valid and not time barred. If any of my statements is found to be untrue, I will have no claim for appearing in the examination. I undertake that I shall abide by the rules and regulations of the University.</p>

                <tr>
                    <td height="40" colspan="8" valign="middle" align="center" class="narmal">
                        <input type="submit" name="submit" value="Next" class="btn btn-primary">
                    </td>
                </tr>
            </form>

        <?php

    }
    //add exam form Student list end
    //test add exam form list
    if ($_GET["action"] == "test_fetch_exam_form") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        $amount = $_POST["amount"];
        $subject_id = $_POST["subject_id"];

        $_SESSION["course_id"] = $course_id;
        $_SESSION["academic_year"] = $academic_year;
        $_SESSION["semester_id"] = $semester_id;
        $_SESSION["amount"] = $amount;

        $sql = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' && `admission_username` = '" . $_SESSION["logger_username1"] . "'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        ?>
            <form action="exam_submit" method="post" enctype="multipart/form-data">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">PERSONAL DETAILS</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">

                                    <label>Registration Number</label>
                                    <input id="" type="hidden" name="course_id" value="<?php echo $_SESSION['course_id'] ?>" class="form-control">
                                    <input id="" type="hidden" name="academic_year" value="<?php echo $_SESSION['academic_year'] ?>" class="form-control">
                                    <input id="" type="hidden" name="semester_id" value="<?php echo $_SESSION['semester_id'] ?>" class="form-control">
                                    <input id="" type="hidden" name="amount" value="<?php echo $_SESSION['amount'] ?>" class="form-control">
                                    <input id="" type="text" name="registration_no" class="form-control" required>
                                </div>

                                <div class="col-4">
                                    <label>Roll Number</label>
                                    <input id="" type="text" name="roll_no" class="form-control" required>
                                </div>

                                <div class="col-4">
                                    <label>Candidate's Name</label>
                                    <input id="" type="hidden" name="candidate_name" class="form-control" value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>">
                                    <input id="" type="text" name="candidate_name" class="form-control" value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Father's Name</label>
                                    <input id="" type="hidden" name="father_name" class="form-control" value="<?php echo $row['admission_father_name'] ?>">
                                    <input id="" type="text" name="father_name" class="form-control" value="<?php echo $row['admission_father_name'] ?>" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Department / Specialisation</label>
                                    <input id="" type="text" name="department" class="form-control" required>
                                </div>

                                <div class="col-4">
                                    <label>Candidate Signature</label>
                                    <input type="file" id="fileSign" onchange="Filevalidation()" name="candidate_signature" class="form-control" required>
                                    <script>
                                        Filevalidation = () => {
                                            var fi = document.getElementById('fileSign');
                                            // Check if any file is selected. 
                                            if (fi.files.length > 0) {
                                                for (i = 0; i <= fi.files.length - 1; i++) {

                                                    var fsize = fi.files.item(i).size;
                                                    var file = Math.round((fsize / 1024));
                                                    // The size of the file. 
                                                    if (file >= 4096) {
                                                        alert(
                                                            "File too Big, please select a file less than 4mb");
                                                        $("#fileSign").val("");
                                                    } else {
                                                        document.getElementById('size').innerHTML = '<b>' +
                                                            file + '</b> KB';
                                                    }
                                                }
                                            }
                                        }
                                    </script>
                                </div>

                                <div class="col-8">
                                    <label>Passport Size Photograph</label><br>
                                    <input type="hidden" name="passport_photo" class="form-control" value="<?php echo $row["admission_profile_image"]; ?>">
                                    <img class="profile-user-img " src="../images/student_images/<?php echo $row["admission_profile_image"]; ?>" alt="Student profile picture">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">PERSONAL DETAILS</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <label>Gender</label>
                                    <input id="" type="hidden" name="gender" class="form-control" value="<?php echo strtoupper($row['admission_gender']) ?>">
                                    <input id="" type="text" name="gender" class="form-control" value="<?php echo strtoupper($row['admission_gender']) ?>" readonly>
                                </div>
                                <div class="col-4">
                                    <label>Date Of Birth</label>
                                    <input id="" type="hidden" name="dob" class="form-control" value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>">
                                    <input id="" type="text" name="dob" class="form-control" value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>">
                                </div>
                                <div class="col-4">
                                    <label>Email Id (Student)</label>
                                    <input id="" type="hidden" name="email_id" class="form-control" value="<?php echo $row['admission_emailid_student'] ?>">
                                    <input id="" type="text" name="email_id" class="form-control" value="<?php echo $row['admission_emailid_student'] ?>">
                                </div>
                                <div class="col-4">
                                    <label>Mobile No.(01)</label>
                                    <input id="" type="hidden" name="mobile_no1" class="form-control" value="<?php echo $row['admission_mobile_student'] ?>">
                                    <input id="" type="text" name="mobile_no1" class="form-control" value="<?php echo $row['admission_mobile_student'] ?>">
                                </div>
                                <div class="col-4">
                                    <label>Mobile No.(02)</label>
                                    <input id="" type="text" name="mobile_no2" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Adhar No</label>
                                    <input id="" type="hidden" name="adhar_no" class="form-control" value="<?php echo $row['admission_aadhar_no'] ?>">
                                    <input id="" type="text" name="adhar_no" class="form-control" value="<?php echo $row['admission_aadhar_no'] ?>">
                                </div>
                                <div class="col-12">
                                    <label>Correspondence Address (for all communication by the University):</label>
                                    <input id="" type="hidden" name="address" class="form-control" value="<?php echo $row['admission_residential_address'] ?>">
                                    <textarea id="address" name="address" class="form-control" value="<?php echo $row['admission_residential_address'] ?>" style="height: 38px;"><?php echo $row['admission_residential_address'] ?></textarea>
                                </div>
                                <div class="col-4">
                                    <label>Last Examination Passed & Year</label>
                                    <input id="" type="text" name="last_exam_year" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
                    <thead>
                        <tr>
                            <th width="10%">S.No</th>
                            <th width="20%">Paper Code</th>
                            <th width="20%">Paper Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //$subject_id = $_POST["subject_id"];                        
                        $sql = "SELECT * FROM `tbl_subjects` WHERE course_id = '$course_id' && semester_id = '$semester_id' ORDER BY `subject_id` ASC ";
                        // echo $sql;exit();
                        $row = $con->query($sql);
                        while ($row_course = $row->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $s_no; ?></td>
                                <td> <input type="text" name="paper_code" class="form-control" value="<?php echo $row_course["subject_code"] ?>" readonly></td>
                                <td> <input type="text" name="paper_name" class="form-control" value="<?php echo $row_course["subject_name"] ?>" readonly></td>
                            </tr>
                        <?php
                            $s_no++;
                        }
                        ?>
                    </tbody>
                </table>

                <p>Declaration By the Student :</p>
                <p style="text-align:justify;">I hereby declare that I have read and understood the instructions given above. I also affirm that I have submitted all the required numbers of assignment as applicable for the aforesaid course filled in the examination form and my registration for the course is valid and not time barred. If any of my statements is found to be untrue, I will have no claim for appearing in the examination. I undertake that I shall abide by the rules and regulations of the University.</p>

                <tr>
                    <td height="40" colspan="8" valign="middle" align="center" class="narmal">
                        <input type="submit" name="submit" value="Next" class="btn btn-primary">
                    </td>
                </tr>
            </form>

    <?php

    }
    //test add exam form Student list end
    /* ---------- All Admin(Backend) View Codes End ---------- */
    //Action Section End   
}
    ?>