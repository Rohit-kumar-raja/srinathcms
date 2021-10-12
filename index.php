<!-- hello world you can do it -->

<?php
$smg = '';
$otp = '';
$otp_value = '';
$name = '';
$email = '';
$phone = '';

require('./Backend/connection.inc.php');
include('./Backend/function.inc.php');
if (isset($_POST['submit'])) {
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $otp_query = "SELECT * FROM `snu_login` WHERE `email`='$email'";
    $result = mysqli_query($connection, $otp_query);
    $data = mysqli_fetch_array($result);
    $dphone = $data['phone'];
    $demail = $data['email'];

    if ($demail == $email || $dphone == $phone) {
        $smg = "Data already Exist";
    } else {
        $_SESSION['name'] = $_POST['name'];    //the data type of name is string
        $_SESSION['phone'] = $_POST['phone'];  //the data type of phone number is string
        $_SESSION['email'] = $_POST['email'];   //the data type of name is string
        $_SESSION['otp'] = generate_otp($email);
        $_SESSION['msg'] = send_otp();
        // redirect to the page
        header("location:./submit_otp.php");
    }
}
if (isset($_POST['done'])) {

    $email = $_POST['email'];
    $otp_query = "SELECT * FROM `snu_login` WHERE `email`='$email'";
    $result = mysqli_query($connection, $otp_query);
    $data = mysqli_fetch_array($result);
    $name = $data['name'];
    $dphone = $data['phone'];
    $demail = $data['email'];


    if ($demail == $email) {

        $_SESSION['otp'] = generate_otp($email);
        $_SESSION['msg'] = send_otp();
        $_SESSION['name'] = $name;   //the data type of name is string
        $_SESSION['phone'] = $dphone;  //the data type of phone number is string
        $_SESSION['email'] = $demail;   //the data type of name is string

        // redirect to the page
        header("location:./alreadyuser.php");
    } else {
        $smg = "You don't have any Account";
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

    <link rel="stylesheet" href="./asset/css/login.css">
    <!-- Roboto Font -->
    <?php include './srinath.inc/head.php'; ?>
    <!-- Your custom styles (optional) -->

</head>

<body>
    <?php
    include './srinath.inc/header.php';
    ?>
    <nav class="whitenav">
        <div class="nav-wrapper">
            <a href="index.php">
                <img src="./asset/img/logo.png" alt="Srinath logo">
            </a>

            <ul class="right">
                <div class="nav-btn d-sm-none d-md-none d-lg-inline-block">
                    <a href="admission.php" target="blank">Admission <?php echo date('Y') ?></a>
                </div>
            </ul>
        </div>
    </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8  p-0 ">
                <div class="login-box">

                    <div class="login-snip">

                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                        <label for="tab-1" class="tab">New Applicaton</label>
                        <input required id="tab-2" type="radio" name="tab" class="sign-up">
                        <label for="tab-2" class="tab">Already Applied</label>
                        <div class="login-space">
                            <div class="login">
                                <form action="" method="POST">
                                    <div class="row">


                                        <div class="group col-sm-6"> <label for="user" class="label">Name</label> <input value="<?php echo $name; ?>" required id="user" type="text" class="input" placeholder="Enter full Name" name="name"> </div>

                                        <div class="group col-sm-6 "> <label for="user" class="label">Phone</label> <input value="<?php echo $phone; ?>" required id="user" type="text" class="input" placeholder="Enter Phone Number" name="phone" required maxlength="12" pattern="[6789][0-9]{9}"> </div>


                                        <div class="group col-sm-6"> <label for="user" class="label">Email</label> <input value="<?php echo $email; ?>" required id="user" type="email" class="input" placeholder="Enter Email id" name="email" required pattern="[^ @]*@[^ @]*"> </div>

                                        <p class="errormsg col-sm-6"><?php echo $smg; ?></p>
                                    </div>
                                    <?php echo $otp; ?>
                                    <!--                           here i have removed br tag -->
                                    <div class=" ad group col-sm-6"> <input required type="submit" class=" button btn-primary" name="submit" value="Get Otp"> </div>

                                    <div class="hr"></div>


                                </form>
                            </div>


                            <form action="" method="POST">
                                <div class="sign-up-form">

                                    <div class="group col-sm-6"> <label for="user" class="label">Email</label> <input required id="user" type="text" class="input" placeholder="Enter Email id" name="email">
                                    </div>
                                    <div class="group col-sm-6"> <input required id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Keep me Signed
                                            in</label> </div>
                                    <div class="group col-sm-6"> <input required type="submit" class="button btn-primary" value="Get Otp" name="done">
                                    </div>
                                    <p class="errormsg"><?php echo $smg; ?></p>
                                    <div class="hr"></div>
                                    <div class="foot"> <a href="forgetpass.php">Forget password</a> </div>


                                </div>
                            </form>
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