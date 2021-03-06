<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Bike</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?= base_url('bike')?>">Bike</a></li>
                <li class="active">Add</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> ADD BIKE <button type="button" onclick="window.location.href='<?= base_url('bike') ?>'" class="btn btn-default pull-right">BACK</a></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="<?= base_url('bike/store') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Bike Name *</label>
                                            <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Bike Name">
                                            <?= form_error('title', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Image *<sup class="text-danger"> 520X410</sup></label>
                                            <input type="file" class="form-control" name="image" placeholder="Bike Image">
                                            <?= form_error('image', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->

                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.href='<?= base_url('bike/create')?>'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>