<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Product</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard')?>">Dashboard</a></li>
                <li class="active">Product</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-30">PRODUCT <a href="<?= base_url('product/create')?>" class="btn btn-info pull-right">ADD</a></h3>

                <div class="table-responsive">
                    <table id="myTable" class="table table-hover color-bordered-table info-bordered-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>CATEGORY</th>
                                <th>SUBCATEGORY</th>
                                <th>PRODUCT</th>
                                <th>IMAGE</th>
                                <th>STATUS</th>
                                <th>CREATED DATE</th>
                                <th>MANAGE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 20; $i++) : ?>
                                <tr>
                                    <td>1</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>Tiger Nixon</td> 
                                    <td>Tiger Nixon</td>                                    
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a href="<?= base_url('product/edit')?>" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="ti-pencil-alt"></i></a>
                                        <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="icon-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endfor ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#myTable').DataTable();
    });
</script>