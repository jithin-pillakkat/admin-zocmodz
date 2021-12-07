<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Profile</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="active">Profile</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->

    <section class="m-t-40">
        <div class="sttabs tabs-style-iconbox">
            <nav>
                <ul>
                    <li class="tab-current"><a href="#section-iconbox-1" class="sticon ti-user"><span>Profile</span></a></li>
                    <li class=""><a href="#section-iconbox-2" class="sticon ti-world"><span>Social Media</span></a></li>
                    <li class=""><a href="#section-iconbox-3" class="sticon ti-settings"><span>Settings</span></a></li>
                </ul>
            </nav>
            <div class="content-wrap">
                <section id="section-iconbox-1" class="content-current">
                    <form autocomplete="off" id="profile_form">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $this->session->userdata('name'); ?>" placeholder="Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $this->session->userdata('email'); ?>" placeholder="Email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" id="update_profile" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        </div>
                    </form>
                </section>
                <section id="section-iconbox-2" class="">
                    <!-- <form> -->
                    <div class="form-group">
                        <form id="twitter_form">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="input-group m-t-10">
                                <span class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-info icon-width"><i class="fab fa-twitter"></i></button>
                                </span>
                                <input type="text" id="twitter" name="twitter" value="<?= $twitter?>" class="form-control" placeholder="Twitter">
                                <span class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-success" id="btn_twitter">Update</button>
                                </span>

                            </div>
                        </form>

                        <form id="facebook_form">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="input-group m-t-10">
                                <span class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-primary icon-width"><i class="fab fa-facebook-f"></i></button>
                                </span>
                                <input type="text" id="facebook" name="facebook" value="<?= $facebook?>" class="form-control" placeholder="Facebook"> <span class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-success" id="btn_facebook">Update</button>
                                </span>
                            </div>
                        </form>
                        <form id="instagram_form">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="input-group m-t-10">
                                <span class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-danger icon-width"><i class="fab fa-instagram"></i></button>
                                </span>
                                <input type="text" id="instagram" name="instagram" value="<?= $instagram?>" class="form-control" placeholder="Instagram"> <span class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-success" id="btn_instagram">Update</button>
                                </span>
                            </div>
                        </form>
                        <form id="youtube_form">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="input-group m-t-10">
                                <span class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-danger icon-width"><i class="fab fa-youtube"></i></button>
                                </span>
                                <input type="text" id="youtube" name="youtube" value="<?= $youtube?>" class="form-control" placeholder="Youtube"> <span class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-success" id="btn_youtube">Update</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!-- form-group -->

                </section>
                <section id="section-iconbox-3" class="">
                    <h2>Tabbing 5</h2>
                </section>
            </div>
            <!-- /content -->
        </div>
        <!-- /tabs -->
    </section>
</div>
<style>
    .icon-width {
        min-width: 42px;
    }
</style>
<script src="<?= base_url('assets/js/cbpFWTabs.js') ?>"></script>
<script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();

    $('#update_profile').click(function() {
        $.ajax({
            method: "post",
            url: "<?= base_url('profile/update_profile') ?>",
            dataType: 'json',
            data: $('#profile_form').serialize(),
            beforeSend: function() {
                $('#update_profile').text('updating...').attr('disabled', 'true');
            },
            success: function(response) {
                $('#update_profile').text('Save').removeAttr('disabled');
                $('.name').remove();
                $('.email').remove();
                $('.password').remove();
                if (response.status.name) {
                    $('#name').parent().parent().addClass('has-error');
                    $('#name').after(response.status.name);
                } else {
                    $('.name').remove();
                    $('#name').parent().parent().removeClass('has-error');
                }

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

                if (response.status == 'warning') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'warning',
                        hideAfter: 3700
                    });
                }
                if (response.status == 'success') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3700
                    });
                }
            }
        })
    })

    $('#btn_twitter').click(function() {
        $.ajax({
            method: "post",
            url: "<?= base_url('profile/update_twitter') ?>",
            dataType: 'json',
            data: $('#twitter_form').serialize(),
            beforeSend: function() {
                $('#btn_twitter').text('Updating...').attr('disabled', 'true');
            },
            success: function(response) {
                $('#btn_twitter').text('Update').removeAttr('disabled');

                if (response.status.twitter) {
                    $.toast({
                        heading: 'error',
                        text: response.status.twitter,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3700
                    });
                    $('#twitter').parent().parent().addClass('has-error');
                } else {
                    $('#twitter').parent().parent().removeClass('has-error');
                }
                if (response.status == 'warning') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'warning',
                        hideAfter: 3700
                    });
                }
                if (response.status == 'success') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3700
                    });
                }
            }
        })
    })

    $('#btn_facebook').click(function() {
        $.ajax({
            method: "post",
            url: "<?= base_url('profile/update_facebook') ?>",
            dataType: 'json',
            data: $('#facebook_form').serialize(),
            beforeSend: function() {
                $('#btn_facebook').text('Updating...').attr('disabled', 'true');
            },
            success: function(response) {
                $('#btn_facebook').text('Update').removeAttr('disabled');

                if (response.status.facebook) {
                    $.toast({
                        heading: 'error',
                        text: response.status.facebook,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3700
                    });
                    $('#facebook').parent().parent().addClass('has-error');
                } else {
                    $('#facebook').parent().parent().removeClass('has-error');
                }
                if (response.status == 'warning') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'warning',
                        hideAfter: 3700
                    });
                }
                if (response.status == 'success') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3700
                    });
                }
            }
        })
    })

    $('#btn_instagram').click(function() {
        $.ajax({
            method: "post",
            url: "<?= base_url('profile/update_instagram') ?>",
            dataType: 'json',
            data: $('#instagram_form').serialize(),
            beforeSend: function() {
                $('#btn_instagram').text('Updating...').attr('disabled', 'true');
            },
            success: function(response) {
                $('#btn_instagram').text('Update').removeAttr('disabled');

                if (response.status.instagram) {
                    $.toast({
                        heading: 'error',
                        text: response.status.instagram,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3700
                    });
                    $('#instagram').parent().parent().addClass('has-error');
                } else {
                    $('#instagram').parent().parent().removeClass('has-error');
                }
                if (response.status == 'warning') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'warning',
                        hideAfter: 3700
                    });
                }
                if (response.status == 'success') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3700
                    });
                }
            }
        })
    })

    $('#btn_youtube').click(function() {
        $.ajax({
            method: "post",
            url: "<?= base_url('profile/update_youtube') ?>",
            dataType: 'json',
            data: $('#youtube_form').serialize(),
            beforeSend: function() {
                $('#btn_youtube').text('Updating...').attr('disabled', 'true');
            },
            success: function(response) {
                $('#btn_youtube').text('Update').removeAttr('disabled');

                if (response.status.youtube) {
                    $.toast({
                        heading: 'error',
                        text: response.status.youtube,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3700
                    });
                    $('#youtube').parent().parent().addClass('has-error');
                } else {
                    $('#youtube').parent().parent().removeClass('has-error');
                }
                if (response.status == 'warning') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'warning',
                        hideAfter: 3700
                    });
                }
                if (response.status == 'success') {
                    $.toast({
                        heading: response.status,
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3700
                    });
                }
            }
        })
    })
</script>