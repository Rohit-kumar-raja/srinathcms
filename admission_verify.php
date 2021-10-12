<?php
$smg = '';
$otp = '';
$otp_value = '';
$name = '';
$email = '';
$phone = '';

require('./Backend/connection.inc.php');
include './Backend/function.inc.php';

if (isset($_POST['submit']) && isset($_POST['otp'])) {
    $otp = $_POST['otp'];
    echo "<br>";

    if ($_SESSION['otp'] == $otp) {
        $_SESSION['verify']='yes';
        header("location:admission.php");
    } else {
        $smg = "Wrong OTP";
    }
}


?>


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Srinath university</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Timmana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="footer.css">

    <link rel="stylesheet" href="productcart.css">

    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="search.css">

    <link rel="stylesheet" href="./asset/css/login.css">
    <!-- Roboto Font -->
    <link rel="icon" href="app-assets/images/logo/favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="app-assets/images/logo/favicon-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon" href="app-assets/images/logo/favicon-apple.png">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN VENDOR CSS -->
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

    <?php include './srinath.inc/head.php'; ?>
    <!-- Your custom styles (optional) -->

</head>

<body>
    <?php include './srinath.inc/header.php'; ?>
    <nav class="whitenav">
        <div class="nav-wrapper">
        <a href="index.php">
            <img src="./asset/img/logo.png" alt="Srinath logo">
            </a>
            <ul class="right">
                <div class="nav-btn d-sm d-md d-lg-inline-block">
                    <a href="http://srinathuniversity.in/" target="blank">Back to Home</a>
                </div>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-8  p-0 ">

           
                <div class="login-box">

                    <div class="login-snip">

                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                        <label for="tab-1" class="tab">OTP varification</label>
                        <input required id="tab-2" type="radio" name="tab" class="sign-up">
                        <label for="tab-2" class="tab"></label>
                        <div class="login-space">
                            <div class="login">
                                <form action="" method="POST">
                                    <div class="group col-sm-6"> <label for="user" class="label">Otp</label> <input required id="user" type="text" class="input" placeholder="Enter 6 Digit otp" name="otp">
                                    <?php echo $_SESSION['msg']; ?>   
                                    <p class="errormsg"><?php echo $smg; ?></p>
                                    </div>

                                    <br>
                                    <div class="group col-sm-6"> <input required type="submit" class="button btn-primary" value="Submit Otp" name="submit">
                                    </div>

                                    <div class="hr"></div>



                                </form>
                            </div>



                        </div>
                    </div>
        
            </div>
            </div>
            <div class="col-sm">
                <img class="es-margin" src="./asset/img/index_banner.jpeg" alt="">
            </div>
        </div>
    </div>
    <!--Main layout-->
    <?php include './srinath.inc/footer.php';  ?>
    <?php include './srinath.inc/foot.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>