
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Banner</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('banner') ?>">Banner</a></li>
                <li class="active">Add</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> ADD BANNER <button type="button" onclick="window.location.href='<?= base_url('banner') ?>'" class="btn btn-default pull-right">BACK</button></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="<?= base_url('banner/store') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Banner Title</label>
                                            <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Banner Title">
                                            <?= form_error('title', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Image *<sup class="text-danger"> 1555X1005</sup></label>
                                            <input type="file" class="form-control" name="image" placeholder="Banner Image">
                                            <?= form_error('image', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->                                
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" onclick="window.location.href='<?= base_url('banner/create') ?>'" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
