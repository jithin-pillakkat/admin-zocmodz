<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Banner</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="active">Banner</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <a href="<?= base_url('banner/create') ?>" class="btn btn-info pull-right m-b-30">ADD</a>
        </div>
    </div>

    <div class="row">

        <?php foreach ($banners as $banner) : ?>
            <?php $status = ($banner->banner_status == 1) ? 'checked' : ''; ?>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12" id="rowid-<?= $banner->id ?>">
                <img class="img-responsive" alt="banner" src="<?= base_url('uploads/banner/' . $banner->image) ?>">
                <div class="white-box">
                    <div class="text-muted">
                        <span class="m-r-10">
                            <i class="icon-calender"></i> <?= date('M d', strtotime($banner->created_at)) ?> </span>
                        <div class="checkbox checkbox-success pull-right">
                            <input class="changeStatus" type="checkbox" <?= $status ?> name="status" data-id="<?= $banner->id ?>"><label></label>
                        </div>
                    </div>

                    <div class="form-group m-t-20">
                        <label class="control-label">Position </label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <span class="input-group-btn input-group-prepend"><button class="btn btn-default btn-outline bootstrap-touchspin-down" type="button" data-id=<?= $banner->id ?>>-</button></span>
                            <input id="position-<?= $banner->id ?>" type="text" value="<?= $banner->position ?>" min="1" data-bts-button-down-class="btn btn-default btn-outline" data-bts-button-up-class="btn btn-default btn-outline" class="form-control" disabled>
                            <span class="input-group-btn input-group-append"><button class="btn btn-default btn-outline bootstrap-touchspin-up" type="button" data-id=<?= $banner->id ?>>+</button></span>
                        </div>
                    </div>

                    <h3 class="m-t-20 m-b-20"><?= $banner->title ?></h3>

                    <a href="<?= base_url('banner/edit/' . $banner->id) ?>" class="btn btn-info btn-outline btn-circle m-r-5" title="Edit"><i class="ti-pencil-alt"></i></a>
                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 deleteButton" title="Delete" data-id="<?= $banner->id ?>"><i class="icon-trash"></i></button>
                </div>
            </div>
        <?php endforeach ?>

    </div>
    <!-- /row -->
</div>

<script>
    $(function() {
        
        // change status
        $(".changeStatus").click(function() {
            var id = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "<?= base_url('banner/changeStatus') ?>",
                dataType: 'json',
                data: {
                    id: id
                },
                headers: {
                    'CSRFToken': "<?= $this->security->get_csrf_token_name(); ?>"
                },
                success: function(response) {
                    if (response.status == 'active') {
                        $.toast({
                            heading: 'success',
                            text: response.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3700
                        });
                    } else if (response.status == 'deactive') {
                        $.toast({
                            heading: 'success',
                            text: response.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3700
                        });
                    } else {
                        $.toast({
                            heading: 'error',
                            text: response.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3700
                        });
                    }
                }
            })
        });

        $(".deleteButton").click(function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "GET",
                        url: "<?= base_url('banner/destroy') ?>",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        headers: {
                            'CSRFToken': "<?= $this->security->get_csrf_token_name(); ?>"
                        },
                        success: function(response) {
                            $('#rowid-' + id).slideUp();
                            if (response.status == 'success') {
                                $.toast({
                                    heading: response.status,
                                    text: response.message,
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 3700
                                });
                            } else {
                                $.toast({
                                    heading: response.status,
                                    text: response.message,
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'error',
                                    hideAfter: 3700
                                });
                            }
                        }
                    })
                }
            })

        });

        $('.bootstrap-touchspin-down').click(function(){
            var id = $(this).data('id');
            var value = $('#position-'+id).val();
            if(value != 1){
                $('#position-'+id).val(value-1);
                $.ajax({
                        method: "GET",
                        url: "<?= base_url('banner/position_down') ?>",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        headers: {
                            'CSRFToken': "<?= $this->security->get_csrf_token_name(); ?>"
                        },
                        success: function(response) {                            
                            if (response.status == 'success') {
                                $.toast({
                                    heading: 'Success',
                                    text: 'Position decreased one',
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 3700
                                });
                            } else {
                                $.toast({
                                    heading: 'Error',
                                    text: 'Updation failed.',
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'error',
                                    hideAfter: 3700
                                });
                            }
                        }
                    })
                
            }
        })

        $('.bootstrap-touchspin-up').click(function(){
            var id = $(this).data('id');
            var value = $('#position-'+id).val();
            
                $('#position-'+id).val(parseFloat(value)+1);
                $.ajax({
                        method: "GET",
                        url: "<?= base_url('banner/position_up') ?>",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        headers: {
                            'CSRFToken': "<?= $this->security->get_csrf_token_name(); ?>"
                        },
                        success: function(response) {                            
                            if (response.status == 'success') {
                                $.toast({
                                    heading: 'Success',
                                    text: 'Position increased one',
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 3700
                                });
                            } else {
                                $.toast({
                                    heading: 'Error',
                                    text: 'Updation failed.',
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'error',
                                    hideAfter: 3700
                                });
                            }
                        }
                    })
                
            
        })


    })
</script>