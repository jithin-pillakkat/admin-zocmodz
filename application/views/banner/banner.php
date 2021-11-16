<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Banner</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard')?>">Dashboard</a></li>
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
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <img class="img-responsive" alt="banner" src="<?= base_url('uploads/banner/' . $banner->image) ?>">
                <div class="white-box">
                    <div class="text-muted">
                        <span class="m-r-10">
                            <i class="icon-calender"></i> <?= date('M d', strtotime($banner->created_at)) ?> </span>
                        <div class="checkbox checkbox-success pull-right">
                            <input class="changeStatus" type="checkbox" <?= $status ?> name="status" data-id="<?= $banner->id ?>"><label></label>
                        </div>
                    </div>                    
                    <h3 class="m-t-20 m-b-20"><?= $banner->title ?></h3>
                    <a href="<?= base_url('banner/edit/' . $banner->id) ?>" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" title="Edit"><i class="ti-pencil-alt"></i></a>
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
    })
</script>