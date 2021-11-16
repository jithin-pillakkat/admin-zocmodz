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
                <div class="panel-heading"> EDIT PRODUCT <button type="button" class="btn btn-default pull-right" onclick="window.location.href='<?= base_url('product') ?>'">BACK</button></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="<?= base_url('product/update') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <input type="hidden" name="himage_1" value="<?= $product->image_1 ?>">
                            <input type="hidden" name="himage_2" value="<?= $product->image_2 ?>">
                            <input type="hidden" name="himage_3" value="<?= $product->image_3 ?>">
                            <input type="hidden" name="himage_4" value="<?= $product->image_4 ?>">
                            <input type="hidden" name="id" value="<?= $product->id ?>">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Category *</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?= $category->id ?>" <?php if (set_value('category_id') == $category->id) : echo 'selected';
                                                                                            elseif ($product->category_id == $category->id) : echo 'selected';
                                                                                            else : echo '';
                                                                                            endif ?>><?= $category->title ?></option>
                                                <?php endforeach; ?>
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
                                                <?php foreach ($subcategories as $subcategory) : ?>
                                                    <option value="<?= $subcategory->id ?>" <?php if (set_value('subcategory_id') == $subcategory->id) : echo 'selected';
                                                                                            elseif ($product->subcategory_id == $subcategory->id) : echo 'selected';
                                                                                            else : echo '';
                                                                                            endif ?>><?= $subcategory->title ?></option>
                                                <?php endforeach; ?>
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
                                            <input type="text" class="form-control" name="title" value="<?= (set_value('title')) ? set_value('title') : $product->title; ?>" placeholder="Product Name">
                                            <?= form_error('title', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Quantity *</label>
                                            <input type="text" class="form-control" name="quantity" value="<?= (set_value('quantity')) ? set_value('quantity') : $product->quantity; ?>" placeholder="Quantity">
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
                                            <div class="input-group">
                                                <div class="input-group-addon">₹</div>
                                                <input type="text" class="form-control" name="price" value="<?= (set_value('price')) ? set_value('price') : $product->price; ?>" placeholder="Price in ₹">
                                                <?= form_error('price', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">%</div>
                                                <input type="text" class="form-control" name="discount" value="<?= (set_value('discount')) ? set_value('discount') : $product->discount; ?>" placeholder="Discount in %">
                                                <?= form_error('discount', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!-- /row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>GST (%) *</label>
                                            <select class="form-control" name="gst">
                                                <option value="">Select GST</option>
                                                <?php foreach ($gsts as $gst) : ?>
                                                    <option value="<?= $gst->gst ?>" <?php if (set_value('gst') == $gst->gst) : echo 'selected';
                                                                                    elseif ($product->gst == $gst->gst) : echo 'selected';
                                                                                    else : echo '';
                                                                                    endif ?>><?= $gst->gst ?> %</option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('gst', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!-- /row -->

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label>Product Description *</label>
                                            <textarea class="form-control" rows="4" name="description"><?= (set_value('description')) ? set_value('description') : $product->description; ?></textarea>
                                            <?= form_error('description', '<span class="help-block">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-3">
                                        <h3 class="box-title text-center m-t-20">Image 1 <sup class="text-danger"> 520X410</sup></h3>
                                        <div class="product-img"> <img src="<?= base_url('uploads/product/' . $product->image_1) ?>">
                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Change Image</span>
                                                <input type="file" name="image_1" class="upload">
                                            </div>
                                        </div>
                                        <?= form_error('image_1', '<span class="help-block">', '</span>'); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <h3 class="box-title text-center m-t-20">Image 2 <sup class="text-danger"> 520X410</sup></h3>
                                        <div class="product-img">
                                            <?php if ($product->image_2) : ?>
                                                <img src="<?= base_url('uploads/product/' . $product->image_2) ?>">
                                                <div class="pro-img-overlay">
                                                    <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a>
                                                </div>
                                            <?php else : ?>
                                                <img src="<?= base_url('assets/images/no-image.png') ?>">
                                            <?php endif; ?>
                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Change Image</span>
                                                <input type="file" name="image_2" class="upload">
                                            </div>
                                        </div>
                                        <?= form_error('image_2', '<span class="help-block">', '</span>'); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <h3 class="box-title text-center m-t-20">Image 3 <sup class="text-danger"> 520X410</sup></h3>
                                        <div class="product-img">
                                            <?php if ($product->image_3) : ?>
                                                <img src="<?= base_url('uploads/product/' . $product->image_3) ?>">
                                                <div class="pro-img-overlay">
                                                    <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a>
                                                </div>
                                            <?php else : ?>
                                                <img src="<?= base_url('assets/images/no-image.png') ?>">
                                            <?php endif; ?>
                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Change Image</span>
                                                <input type="file" name="image_3" class="upload">
                                            </div>
                                        </div>
                                        <?= form_error('image_3', '<span class="help-block">', '</span>'); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <h3 class="box-title text-center m-t-20">Image 4 <sup class="text-danger"> 520X410</sup></h3>
                                        <div class="product-img">
                                            <?php if ($product->image_4) : ?>
                                                <img src="<?= base_url('uploads/product/' . $product->image_4) ?>">
                                                <div class="pro-img-overlay">
                                                    <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a>
                                                </div>
                                            <?php else : ?>
                                                <img src="<?= base_url('assets/images/no-image.png') ?>">
                                            <?php endif; ?>
                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Change Image</span>
                                                <input type="file" name="image_4" class="upload">
                                            </div>
                                        </div>
                                        <?= form_error('image_4', '<span class="help-block">', '</span>'); ?>
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <div class="form-actions m-t-40">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.href='<?= base_url('product/edit') ?>'">Cancel</button>
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