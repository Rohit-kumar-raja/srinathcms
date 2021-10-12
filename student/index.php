<?php
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "include/config.php";
if (isset($_SESSION["logger_username1"]) && isset($_SESSION["logger_password1"])) {
    echo "<script> location.replace('dashboard'); </script>";
} else {
?>

    <body>
        <title> SRINATH UNIVERSITY LOGIN PAGE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="dist/css/login.css" rel="stylesheet" id="bootstrap-css">

        <style type="text/css">
            body {
                background: url('images/img_bg_nsu.png') fixed;
                background-repeat: no-repeat;
                background-size: cover;
                padding: 0;
                margin: 0;

            }

            .img-title {
                margin-top: 20%;
                width: 300px;
            }

            .title {
                color: red;
                font-size: 30px;
                font-weight: 900;
                margin-top: 10%;

            }

            .p-white {
                color: white;
            }

            @media (min-width: 768px) {
                .margin {
                    margin-left: -40px;
                }
            }
        </style>

        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-5">
                    <div class="wrap">


                        <center class="margin"> <img class="img-title" src="images/images.png">


                            <p class="title">STUDENT LOGIN</p>
                            <form method="POST" id="student_login_form">
                                <div id="error_section"></div>
                                <b class="p-white"> User ID :</b><input type="text" id="student_login_username" name="student_login_username" class="form-control" placeholder="Username"></br>
                                <b class="p-white">Password : </b><input type="password" id="student_login_password" name="student_login_password" class="form-control" placeholder="Password"></br>
                                <div class="col-4">
                                    <div class="col-4">
                                        <input type='hidden' name='action' value='student_login' />
                                        <button type="submit" id="student_login_button" name="student_login_button" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                    <div class="col-12" id="loader_section"></div>
                                </div>
                            </form>
                            <br><br>
                            <!-- write code for sending the otp and forget the password -->
                            <p class="p-white" ><a style="color: white;" href="#"> Forget Password </a></p>
                        </center>
      
              
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col-sm-3">

                </div>
            </div>

        </div>
        <script>
            $(function() {

                $('#student_login_form').submit(function(event) {
                    $('#loader_section').append('<center id = "loading"><img width="50px" src = "images/load.gif" alt="Currently loading" /></center>');
                    $('#student_login_button').prop('disabled', true);
                    $.ajax({
                        url: 'include/controller.php',
                        type: 'POST',
                        data: $('#student_login_form').serializeArray(),
                        success: function(result) {
                            $('#response').remove();
                            $('#student_login_form')[0].reset();
                            $('#error_section').append('<div id = "response">' + result + '</div>');
                            $('#loading').fadeOut(500, function() {
                                $(this).remove();
                            });
                            $('#student_login_button').prop('disabled', false);
                        }

                    });
                    event.preventDefault();
                });

            });
        </script>

    </body>
    <style>
        .or {
            color: orangered !important;
        }

        .text-center {

            color: white;

            margin-top: 93rem;
        }

        @media screen and (min-width: 560px) {
            .text-center {

                color: white;

                margin-top: 63rem;
            }
        }
    </style>

    <footer class=" footer text-center mt-5 p-5">

        <strong>
            <p>&copy; <?php echo date("Y"); ?> <a class="or" style="color: #a82b12;" target="_blank" href="#">SRINATH UNIVERSITY </a> All Right Reserved. Powered By <a class="text-success" href="#" target="_blank">Infinite Net Solutions</a></p>
    </footer>

    </html>
<?php } ?>
<!--  rtrt-->