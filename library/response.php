<?php
// include file
include_once('easebuzz-lib/easebuzz_payment_gateway.php');
// include '../Backend/connection.inc.php';
// salt for testing env
$SALT = "92HHB0OBFH";

/*
    * Get the API response and verify response is correct or not.
    *
    * params string $easebuzzObj - holds the object of Easebuzz class.
    * params array $_POST - holds the API response array.
    * params string $SALT - holds the merchant salt key.
    * params array $result - holds the API response array after valification of API response.
    *
    * ##Return values
    *
    * - return array $result - hoids API response after varification.
    * 
    * @params string $easebuzzObj - holds the object of Easebuzz class.
    * @params array $_POST - holds the API response array.
    * @params string $SALT - holds the merchant salt key.
    * @params array $result - holds the API response array after valification of API response.
    *
    * @return array $result - hoids API response after varification.
    *
    */
$easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);

$result = $easebuzzObj->easebuzzResponse($_POST);

// print_r($result);
$result = json_decode($result, true);
$connection = '';
session_start();
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $connection = mysqli_connect("localhost", "root", "", "srinath_cms");
} else {
    $connection = mysqli_connect("localhost", "phpmyadmin", "raja@#", "srinath_cms");
}
//echo "<h1>EaseBuzz</h1>"; 
// $chk_tx = $result["data"]["status"];
// echo "<br>";
$_SESSION['email'] = $email;
$payment_status = $result['data']['status'];
if ($payment_status == 'success') {

    $prospectus_rate = $result['data']['net_amount_debit'];
    $prospectus_payment_mode = $result['data']['mode'];
    $prospectus_deposit_to = $result['data']['bank_ref_num'];
    $bank_name = $result['data']['bank_name'];
    $transaction_no = $result['data']['txnid'];
    $transaction_date = $result['data']['addedon'];
    // $post_at=$result['data']['bank_ref_num'];
    $type = $result['data']['PG_TYPE'];
    $easebuzz_id = $result['data']['easepayid'];
    $transaction_id = $result['data']['txnid'];
    $status = md5('visible');
    $email = $result['data']['email'];
    $_SESSION['email'] = $email;
    // here to gettiong the propectus no automatic
    $getmaxid = "SELECT MAX(prospectus_no) as id FROM `tbl_prospectus`";
    $getmaxid_result = mysqli_query($connection, $getmaxid);
    $getmaxid_data = mysqli_fetch_array($getmaxid_result);
    $prosprectus_number = $getmaxid_data['id'];
    $prosprectus_number = explode('/', $prosprectus_number)[2] + 1;
    // getting the current time and store into the table
    $timing = date("Y/m/d   h:i:sa");
    // $prospectus_number=rand(1000000,999999);
    $data_row = mysqli_fetch_array($p_no_result);
    $prospectus_number = 'SU/P/' . $prosprectus_number;

    $update_payment = "UPDATE `tbl_prospectus` SET `prospectus_no`='$prospectus_number', `payment_status`='$payment_status',`prospectus_rate`='$prospectus_rate',`prospectus_payment_mode`='$prospectus_payment_mode',`prospectus_deposit_to`='$prospectus_deposit_to',`bank_name`='$bank_name',`transaction_no`='$transaction_no',`transaction_date`='$transaction_date',`post_at`='$timing',`type`='$type',`easebuzz_id`='$easebuzz_id',`transaction_id`='$transaction_id',`status`='$status' WHERE `prospectus_emailid`='$email' ";
    $update_payment_result = mysqli_query($connection, $update_payment);
    if ($update_payment_result) {
        // getting the data for the send the email 
        $propectus_no_query = "SELECT * FROM tbl_prospectus  WHERE `prospectus_emailid`='$email'";
        $p_no_result = mysqli_query($connection, $propectus_no_query);
        $data_row = mysqli_fetch_array($p_no_result);
        $name = $data_row['prospectus_applicant_name'];
        $prospectus_course_name = $data_row['prospectus_course_name'];
        $prospectus_session = $data_row['prospectus_session'];

        $p_no_result = mysqli_query($connection, $propectus_no_query);

        // here to start send the email to the user 
        include '../Backend/sendprospectus.php';

        prospectus_mail($email, $prosprectus_number, $prospectus_rate, $prospectus_course_name, $prospectus_session, $name);
        // for printing the propectus reference pdf

        // getting the course id and session id
        // $course_no_query = "SELECT * FROM `tbl_course` WHERE `course_name`='$prospectus_course_name'";
        // $course_no_result = mysqli_query($connection, $course_no_query);
        // $data_row1 = mysqli_fetch_array($course_no_result);

        // $prospectus_course_id = $data_row1['course_duration'];
        // $prospectus_session_id = $data_row1['course_id'];

        // $update_payment = "UPDATE `tbl_prospectus` SET `prospectus_course_name`='$prospectus_course_id',`prospectus_session`='$prospectus_session_id' WHERE `prospectus_emailid`='$email' ";
        // $update_payment_result = mysqli_query($connection, $update_payment);


        echo '<script> window.location.replace("../print.php") </script>';
    }
} else {
    $_SESSION['email'] = $email;
    echo '<script> window.location.replace("../registration.php") </script>';
}
