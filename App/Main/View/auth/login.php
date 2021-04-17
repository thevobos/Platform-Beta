
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

<form class="loginForm" action="" onsubmit="return false;" >
    <div class="content content-fixed content-auth">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
                <div class="media-body align-items-center d-none d-lg-flex">
                    <div class="mx-wd-600">
                        <img src="/Assets/v2/Assets/img/img15.png" class="img-fluid" alt="">
                    </div>
                </div><!-- media-body -->
                <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
                    <div class="wd-100p">
                        <h3 class="tx-color-01 mg-b-5">Authorized Login</h3>
                        <p class="tx-color-03 tx-16 mg-b-40">Please log in to manage your data.</p>

                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="email" name="email" class="form-control" placeholder="mail@adresi.com">
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Password</label>
                                <a href="/auth/password" class="tx-13">Password Reset??</a>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="******">
                        </div>
                        <button class="btn btn-brand-02 btn-block">Sign In</button>
                        <div class="tx-13 mg-t-20 tx-center"> <!-- Buton altı mesajı --> </div>
                    </div>
                </div><!-- sign-wrapper -->
            </div><!-- media -->
        </div><!-- container -->
    </div><!-- content -->
</form>

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



