<?php
// include file
session_start();
include_once('./library/easebuzz-lib/easebuzz_payment_gateway.php');
include_once('./Backend/connection.inc.php');
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
// salt for testing env
 // $SALT = "M87TPWFJ44";

// 	//live
	$SALT = "LNRNU85EPI";
?>


<?php 

// Decode Jeson
ini_set("error_reporting","off");
//include_once('easebuzz-lib/easebuzz_payment_gateway.php');
/*
Enter The SALT 
*/
//$SALT = "M87TPWFJ44";
$easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);
//	print_r($_POST);
	//echo "<br>";
//	echo $_POST['bank_ref_num'];
$result = $easebuzzObj->easebuzzResponse( $_POST );
/*
$result jeson Data
*/
//print_r($result);
 $result = json_decode($result, true);
  
  //echo "<h1>EaseBuzz</h1>"; 
$chk_tx=$result["data"]["status"];
 
//echo $chk;

 if($chk_tx=="success")
 {
  	$prospectus_applicant_name = $_SESSION["prospectus_applicant_name"];
	$prospectus_father_name = $_SESSION["prospectus_father_name"];
	$prospectus_gender = $_SESSION["prospectus_gender"];
	$prospectus_dob = $_SESSION["prospectus_dob"];
	$prospectus_emailid = $_SESSION["prospectus_emailid"];
	$prospectus_address = $_SESSION["prospectus_address"];
	$prospectus_country = $_SESSION["prospectus_country"];
	$prospectus_state = $_SESSION["prospectus_state"];
	$prospectus_city = $_SESSION["prospectus_city"];
	$prospectus_postal_code = $_SESSION["prospectus_postal_code"];
	$mobile = $_SESSION["mobile"];
	$prospectus_course = $_SESSION["prospectus_course"];
	$amount = $_SESSION["prospectus_amount"];
	$prospectus_payment_mode = $_SESSION["prospectus_payment_mode"];
	$id = $_SESSION['id'];
	$date = date_create()->format('yy-m-d');
	
	$object_cosmic = new DBEVAL();	
    $object = new DBEVAL();
   // if($prospectus_course == "PH.D"){
     //   $message="Dear user, You have Successfully bought the package. We will get back to you ASAP. For more details contact us on +91-7008576635\n\nRegards,\nCosmic Yoga, \nJamshedpur. ";
   //     $object->send_otp($mobile, $message);
  //  }
	$object_cosmic->new_db("localhost","cosmicyoga_db","IEr5xdwj","cosmicyoga_db");
    $check = $object_cosmic->update("booking_tbl", "`payment_status`= 'YES',`prospectus_payment_mode`='Online',`type`='enquiry',`easebuzz_id`= '".$result["data"]["easepayid"]."',`transaction_id` = '".$result["data"]["txnid"]."',`post_at`= '$date' WHERE `booking_id`='".$id."'");
	
	if($check == 1){
        $object_cosmic->sql = "";
        $object_cosmic->update("tbl_alert", "`prospectus_enquiry`= `prospectus_enquiry`+1 WHERE `id`='1'");
        
			
?>
<!DOCTYPE html>
<html lang="en">

<head id="head-section">
  <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Netaji Subhas University">
    <!-- ========== Page Title ========== -->
    <title>Netaji Subhas University | Print</title>
        <!-- ========== Favicon Icon ========== -->
<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">

<!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <!--  W3 CSS link  -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap" rel="stylesheet">
    <!-- ========== Start Stylesheet ========== -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css" />
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/aos.css" />
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
<?php	include_once('include/header.php'); ?>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
	
	    <div class="page-wrapper" id="div1">
          <section class="inner-banner" style="background: url('assets/images/header-bg.png'); background-position:top; background-size:cover;">
                <h1 class="font-weight-bold text-center">Payment Details</h1>
            </section>
            <!-- end inner-banner -->
            <section class="course">
                <div class="container" >
                   <div class="sec-title text-center mb-3 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <h2>Payment Details</h2>
                        <div class="divider"> <span class="fa fa-mortar-board"></span> </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12">
                             
                            <div class="career-form p-5 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="1000" >
                                <div class="border-line"></div>
                               
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Name</label>
                                            <input  name="" class="form-control"  value="<?php echo $_SESSION['prospectus_applicant_name'] ?>" type="text" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Email Address</label>
                                            <input id="placement_contact_email" value="<?php echo $_SESSION['prospectus_emailid'] ?>" class="form-control"  placeholder="Enter Email" type="email" readonly>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Phone Number</label>
                                            <input id="placement_contact_phone" value="<?php echo $_SESSION['mobile'] ?>" class="form-control"  placeholder="Enter Number" type="text" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Enquiry</label>
                                            <input value="Prospectus" class="form-control"  placeholder="Company Name" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Amount</label>
                                            <input id="placement_contact_phone" value="<?php echo $result["data"]["amount"]; ?>" class="form-control"  placeholder="Enter Number" type="text" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Course</label>
                                            <input value="<?php echo $_SESSION['prospectus_course'] ?>"  class="form-control"  placeholder="Company Name" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Transaction ID</label>
                                            <input value="<?php echo $result["data"]["txnid"]; ?>" class="form-control"  placeholder="Enter Designation" type="text" readonly>
                                        </div>
                                   

                                   <div class="form-group col-md-6">
                                        <label for="">Easebuzz ID</label>
                                       <input type="text" value="<?php echo $result["data"]["easepayid"]; ?>" class="form-control"  placeholder="Request For Information" readonly>
                                    </div>
                                     </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Payment Date & Time</label>
                                            <input value="<?php echo $date_variable_today_month_year_with_timing; ?>" class="form-control"  placeholder="Enter Designation" type="text" readonly>
                                        </div>                                  
                                     </div>
                                <button onclick="printContent('div1')" style="float:right;">Print</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <script type="text/javascript">
	function printContent(e1)
	{
		var restorepage=document.body.innerHTML;
		var printContent=document.getElementById(e1).innerHTML;
		document.body.innerHTML=printContent;
		window.print();
		document.body.innerHTML=restorepage;
	}
</script>
								
<?php
}
 }
 elseif ($chk_tx=="userCancelled") {
	# code...
	echo "<hr>";
	 echo "<br> Transaction Details:-";
	 echo "<br> Status    :".$result["data"]["status"];
	 echo "<br> Name      :".$result["data"]["firstname"];
	 echo "<br> Name On Card     :".$result["data"]["name_on_card"];
	 echo "<br> Email     :".$result["data"]["email"];
	 echo "<br> Amount    :".$result["data"]["amount"];
	 echo "<br> Transaction Id    :".$result["data"]["txnid"];
	 echo "<br> EaseBuzz Pay Id    :".$result["data"]["easepayid"];	 
 }
 else
 { 
	 /*
	 // Failure  Code..
	  As Per Your Need
	 */	
	echo "<hr>";
	echo "<br> Transaction Details ";
	echo '<p><font color="red">';
	echo "<br> <b>Error    :".$result["data"]["error_Message"]."</b>"; 
	echo "</font></p>";
		
	
	 
 }
 ?>
  <?php	include_once('include/footer.php'); ?>
  <?php	//include_once('include/jslinks.php'); ?>