
<!DOCTYPE html>
<html lang="en">
<head>

    <title><?php echo __SYSTEM__; ?></title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon"  href="/Upload/logo.svg" />
    <!-- Meta -->
    <meta name="author" content="<?php echo __SYSTEM__; ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/Assets/v2/Assets/img/favicon.png">

    <!-- vendor css -->
    <link href="/Assets/v2/Assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/Assets/v2/Assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="/Assets/v2/Assets/css/dashforge.css">
    <link rel="stylesheet" href="/Assets/v2/Assets/css/dashforge.auth.css">
</head>
<body>

<header class="navbar navbar-header navbar-header-fixed">
    <div class="navbar-brand">
        <a href="/" style="font-weight: 100;" class="df-logo"><?php echo __SYSTEM__; ?></a>
    </div><!-- navbar-brand -->
</header><!-- navbar -->

<div class="content content-fixed content-auth-alt">
    <div class="container d-flex justify-content-center ht-100p">
        <div class="mx-wd-300 wd-sm-450 ht-100p d-flex flex-column align-items-center justify-content-center">
            <div class="wd-80p wd-sm-300 mg-b-15"><img src="/Assets/v2/Assets/img/img18.png" class="img-fluid" alt=""></div>
            <h4 class="tx-20 tx-sm-24">Password Reset</h4>
            <p class="tx-color-03 mg-b-30 tx-center">If you have forgotten your authorized password or e-mail address, contact the system administrator.</p>
            <span class="tx-12 tx-color-03"> <a href="/">LOGIN</a></span>

        </div>
    </div><!-- container -->
</div>

<footer class="footer">
    <div>
        <span>&copy; <?php echo date("Y"); ?> All rights reserved. </span>
        <span>Created by <a href="https://vobo.company"><?php echo __SYSTEM__; ?></a></span>
    </div>
    <div>
        <nav class="nav">
            <a href="https://vobo.company" class="nav-link"><?php echo __SYSTEM__; ?></a>
        </nav>
    </div>
</footer>

<script src="/Assets/v2/Assets/lib/jquery/jquery.min.js"></script>
<script src="/Assets/v2/Assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/Assets/v2/Assets/lib/feather-icons/feather.min.js"></script>
<script src="/Assets/v2/Assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="/Assets/v2/Assets/js/dashforge.js"></script>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(function () {


        $(".loginForm").submit(function () {

            $.ajax({
                type: "POST",
                url: "/auth/ajax/login",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {

                    if(response.status === "success"){
                        location.href = "/app/dashboard";
                    }else{
                        swal(response.title,response.message,response.status, {
                            buttons: {
                                cancel: {
                                    text: "Try Again",
                                    value: false,
                                    visible: true
                                }
                            }
                        });
                    }

                }
            });

        });
    });
</script>



</body>
</html>



