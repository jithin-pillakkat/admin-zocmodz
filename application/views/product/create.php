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
                <div class="panel-heading"> ADD PRODUCT <button type="button" class="btn btn-default pull-right" onclick="window.location.href='<?= base_url('product')?>'">BACK</button></div>
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
                                        <label>Product Description*</label>
                                            <textarea class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image 1 *</label>
                                            <div class="input-group">                                                
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image 2</label>
                                            <div class="input-group">                                                
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image 3</label>
                                            <div class="input-group">                                                
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image 4</label>
                                            <div class="input-group">                                                
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!-- /row -->                                
                            </div>
                            <div class="form-actions m-t-40">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.href='<?= base_url('product/create')?>'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>