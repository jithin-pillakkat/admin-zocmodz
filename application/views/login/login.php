<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/favicon.png') ?>">
    <title>Admin ZocmodZ</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= base_url('assets/css/colors/default.css') ?>" id="theme" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?= base_url('assets/plugins/bower_components/toast-master/css/jquery.toast.css') ?>" rel="stylesheet">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="new-login-register">
        <div class="lg-info-panel">
            <div class="inner-panel">
                <div class="lg-content">
                    <img src="<?= base_url('assets/images/admin-logo.png') ?>">
                </div>
            </div>
        </div>
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">Sign In to Admin</h3>
                <small>Enter your details below</small>
                <form class="form-horizontal new-lg-form" id="loginform" autocomplete="off">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label>Email Address</label>
                            <input class="form-control" type="text" id="email" name="email" required="" placeholder="Email">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Password</label>
                            <input class="form-control" type="password" id="password" name="password" required="" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button id="login" class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="button">Log In</button>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="" autocomplete="off">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>                        
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <a href="javascript:void(0)" id="to-login" class="text-dark m-l-5">Back to login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="<?= base_url('assets/plugins/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url('assets/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') ?>"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= base_url('assets/js/jquery.slimscroll.js') ?>"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('assets/js/waves.js') ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url('assets/js/custom.min.js') ?>"></script>

    <script src="<?= base_url('assets/plugins/bower_components/toast-master/js/jquery.toast.js') ?>"></script>

    <script>
        $(function() {
            $('#login').click(function() {
                $.ajax({
                    method: "post",
                    url: "<?= base_url('login/login') ?>",
                    dataType: 'json',
                    data: $('#loginform').serialize(),
                    beforeSend: function() {
                        $('#login').text('Loading...').attr('disabled', 'true');
                    },
                    success: function(response) {
                        $('#login').text('Log In').removeAttr('disabled');
                        $('.email').remove();
                        $('.password').remove();
                        if (response.status.email) {
                            $('#email').parent().parent().addClass('has-error');
                            $('#email').after(response.status.email);
                        } else {
                            $('.email').remove();
                            $('#email').parent().parent().removeClass('has-error');
                        }

                        if (response.status.password) {
                            $('#password').parent().parent().addClass('has-error');
                            $('#password').after(response.status.password);
                        } else {
                            $('.password').remove();
                            $('#password').parent().parent().removeClass('has-error');
                        }

                        if (response.status == 'error') {
                            $.toast({
                                heading: response.status,
                                text: response.message,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 3700
                            });
                        }
                        if (response.status == 'success') {
                            window.location.href = '<?= base_url('dashboard') ?>';
                        } 
                    }
                })
            })
        })
    </script>

</body>

</html>