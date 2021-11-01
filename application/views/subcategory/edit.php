<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Subcategory</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('subcategory') ?>">Subcategory</a></li>
                <li class="active">Edit</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> EDIT SUBCATEGORY <a href="<?= base_url('subcategory') ?>" class="btn btn-default pull-right">BACK</a></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="<?= base_url('subcategory/update') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <input type="hidden" name="himage" value="<?= $subcategory->image ?>">
                            <input type="hidden" name="id" value="<?= $subcategory->id ?>">
                            <div class="form-body">
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Category Name</label>
                                            <select class="form-control" name="category_id">
                                                <option value=" ">Select Category</option>
                                                <?php foreach($categories as $category): ?>
                                                <option value="<?= $category->id ?>" <?php if(set_value('category_id')==$category->id): echo 'selected'; elseif ($subcategory->category_id == $category->id): echo 'selected'; else : echo ''; endif ?>><?= $category->title?></option>  
                                                <?php endforeach ?>                                              
                                            </select> 
                                            <?= form_error('category_id', '<span class="help-block">', '</span>'); ?>                                       
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Subcategory Name</label>
                                            <input type="text" class="form-control" name="title" value="<?= (set_value('title')) ? set_value('title') : $subcategory->title; ?>" placeholder="Subcategory Name">
                                            <?= form_error('title', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Image<sup class="text-danger">* 520X410</sup></label>
                                            <input type="file" class="form-control" name="image" placeholder="Subcategory Image">
                                            <?= form_error('image', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img src="<?= base_url('uploads/subcategory/' . $subcategory->image) ?>" class="img-responsive" alt="Subcategory Image">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->

                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="<?= base_url('subcategory')?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>