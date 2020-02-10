<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/jQuery/jquery-ui.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
<!-- DataTables -->
   <script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });

  $(function () {
    var indexLastColumn = $("#Rangking").find('tr')[0].cells.length-1;
    $('#Rangking').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": false,
      "order":[[indexLastColumn,'desc']],
      "info": true,
      "autoWidth": true
    });
  });
  $(function () {
    $('#Perhitungan').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="bootstrap/js/main.js"></script>
</body>

</html>
