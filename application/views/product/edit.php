<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Product</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?= base_url('product')?>">Product</a></li>
                <li class="active">Add</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> EDIT PRODUCT <button type="button" class="btn btn-default pull-right" onclick="window.location.href='<?= base_url('product')?>'">BACK</button></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="#">
                            <div class="form-body">  
                            <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Category *</label>
                                            <select class="form-control">
                                                <option value="">Select Category</option>
                                                <option value="Category 2">Category 2</option>
                                                <option value="Category 3">Category 5</option>
                                                <option value="Category 4">Category 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Subcategory *</label>
                                            <select class="form-control">
                                                <option value="">Select Subcategory</option>
                                                <option value="Category 2">Category 2</option>
                                                <option value="Category 3">Category 3</option>
                                                <option value="Category 4">Category 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->                              
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Product Name *</label>
                                            <input type="text" class="form-control" placeholder="Product Name">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Quantity *</label>
                                            <input type="text" class="form-control" placeholder="Quantity">
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
                                                <input type="text" class="form-control" placeholder="Price in ₹">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">%</div>
                                                <input type="text" class="form-control" placeholder="Discount in %">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->                                    
                                </div>
                                <!-- /row -->
                                
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                        <label>Product Description *</label>
                                            <textarea class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->                                

                                <div class="row">                                    
                                    <div class="col-md-3">
                                        <h3 class="box-title text-center m-t-20">Image 1</h3>
                                        <div class="product-img"> <img src="../assets/plugins/images/chair.jpg">
                                            <div class="pro-img-overlay">                                                
                                                <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a></div>
                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Change Image</span>
                                                <input type="file" class="upload">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h3 class="box-title text-center m-t-20">Image 2</h3>
                                        <div class="product-img"> <img src="../assets/plugins/images/chair.jpg">
                                            <div class="pro-img-overlay">                                                
                                                <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a></div>
                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Change Image</span>
                                                <input type="file" class="upload">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h3 class="box-title text-center m-t-20">Image 3</h3>
                                        <div class="product-img"> <img src="../assets/plugins/images/chair.jpg">
                                            <div class="pro-img-overlay">                                                 
                                                <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a></div>
                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Change Image</span>
                                                <input type="file" class="upload">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h3 class="box-title text-center m-t-20">Image 4</h3>
                                        <div class="product-img"> <img src="../assets/plugins/images/chair.jpg">
                                            <div class="pro-img-overlay">                                                 
                                                <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a></div>
                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Change Image</span>
                                                <input type="file" class="upload">
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!-- /row -->
                            </div>
                            <div class="form-actions m-t-40">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.href='<?= base_url('product/edit')?>'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>