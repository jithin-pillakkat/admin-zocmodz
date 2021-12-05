<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Newsletter</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="active">Newsletter</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-30">Newsletter</h3>

                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover color-bordered-table info-bordered-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>EMAIL</th>                               
                                <th>STATUS</th>
                                <th>CREATED DATE</th>
                                <th>MANAGE</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        // data table
        var dataTable = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= base_url("newsletter/table"); ?>",
                type: "GET",
                headers: {
                    'CSRFToken': "<?= $this->security->get_csrf_token_name(); ?>"
                }
            },
            "columnDefs": [{
                "targets": [0, 2, 4],
                "orderable": false
            }]
        });

        // destroy
        $("#dataTable tbody").on('click', '.deleteButton', function() {
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
                        url: "<?= base_url('newsletter/destroy') ?>",
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
                                    heading: response.status,
                                    text: response.message,
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 3700
                                });
                                dataTable.ajax.reload();
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

        // change status
        $("#dataTable tbody").on('change', '.changeStatus', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');


            $.ajax({
                method: "GET",
                url: "<?= base_url('newsletter/changeStatus') ?>",
                dataType: 'json',
                data: {
                    id: id,
                    status: status
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
                    }else if(response.status == 'deactive'){
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
                    dataTable.ajax.reload();
                }
            })
        });



    });
</script>