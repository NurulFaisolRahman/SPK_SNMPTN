<div class="control-sidebar-bg"></div>
</div>
<script src="<?=base_url('Admin/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?=base_url('Admin/plugins/jQuery/jquery-ui.min.js') ?>"></script>
<script src="<?=base_url('Admin/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?=base_url('Admin/dist/js/app.min.js') ?>"></script>
<!-- DataTables -->
   <script>
  $(function () {
    $('#example1').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": true
    });
  });
</script>
<script src="<?=base_url('Admin/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('Admin/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?=base_url('Admin/bootstrap/js/main.js') ?>"></script>
</body>

</html>
