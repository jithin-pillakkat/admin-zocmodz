<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Product</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('product') ?>">Product</a></li>
                <li class="active">Add</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> ADD PRODUCT <button type="button" class="btn btn-default pull-right" onclick="window.location.href='<?= base_url('product') ?>'">BACK</button></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="<?= base_url('product/store') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Category *</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?= $category->id ?>" <?= (set_value('category_id')==$category->id) ? 'selected' : ''; ?>><?= $category->title ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <?= form_error('category_id', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Subcategory *</label>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                                <option value="">Select Subcategory</option>                                                
                                            </select>
                                            <?= form_error('subcategory_id', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Product Name *</label>
                                            <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Product Name">
                                            <?= form_error('title', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Quantity *</label>
                                            <input type="text" class="form-control" name="quantity" value="<?= set_value('quantity'); ?>" placeholder="Quantity">
                                            <?= form_error('quantity', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price *</label>
                                            <input type="text" class="form-control" name="price" value="<?= set_value('price'); ?>" placeholder="Price in ₹">
                                            <?= form_error('price', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input type="text" class="form-control" name="discount" value="<?= set_value('discount'); ?>" placeholder="Discount in %">
                                            <?= form_error('discount', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!-- /row -->

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label>Product Description*</label>
                                            <textarea class="form-control" rows="4" name="description"><?= set_value('description'); ?></textarea>
                                            <?= form_error('description', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image 1 *</label>
                                            <div class="input-group">
                                                <input type="file" name="image_1" class="form-control">
                                                <?= form_error('image_1', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image 2</label>
                                            <div class="input-group">
                                                <input type="file" name="image_2" class="form-control">
                                                <?= form_error('image_2', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image 3</label>
                                            <div class="input-group">
                                                <input type="file" name="image_3" class="form-control">
                                                <?= form_error('image_3', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image 4</label>
                                            <div class="input-group">
                                                <input type="file" name="image_4" class="form-control">
                                                <?= form_error('image_4', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!-- /row -->
                            </div>
                            <div class="form-actions m-t-40">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.href='<?= base_url('product/create') ?>'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#category_id').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    method: "GET",
                    url: "<?= base_url('product/getSubcategories') ?>",
                    data: {
                        categoryId: categoryId
                    },
                    headers: {
                        'CSRFToken': "<?= $this->security->get_csrf_token_name(); ?>"
                    },
                    success: function(response) {
                        $('#subcategory_id').html(response);
                    }
                })
            }

        })
    })
</script>