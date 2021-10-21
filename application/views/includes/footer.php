<footer class="footer text-center"> 2021 &copy; Admin ZocmodZ </footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
</div>
<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url('assets/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') ?>"></script>
<!--slimscroll JavaScript -->
<script src="<?= base_url('assets/js/jquery.slimscroll.js') ?>"></script>
<!--Wave Effects -->
<script src="<?= base_url('assets/js/waves.js') ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= base_url('assets/js/custom.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bower_components/datatables/datatables.min.js') ?>"></script>
<!-- Sweet-Alert  -->
<script src="<?= base_url('assets/plugins/bower_components/sweetalert/sweetalert.min.js') ?>"></script>
<script>
    $(function() {
        $('.logout').click(function() {
            swal({
                title: 'Are you sure?',
                text: "Do you want to logout from admin panel!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3ec396',
                confirmButtonText: 'Yes, Log out'
            }).then(function() {
                window.location.href = '<?= base_url('logout') ?>';
            });
        });
    })
</script>
</body>

</html>