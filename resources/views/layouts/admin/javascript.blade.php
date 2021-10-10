<!-- jQuery -->
<script src="{{ URL::asset('template/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::asset('template/admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('template/admin/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




<script>
  $(function () {

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"

			}
    });
  });
</script>

<!-- AdminLTE App -->
<script src="{{ URL::asset('template/admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ URL::asset('template/admin/laravel.js') }}"></script>

<!-- Mes scripts -->
{{-- <script src="{{ URL::asset('template/admin/dist/js/script/religion.js') }}"></script>
<script src="{{ URL::asset('template/admin/dist/js/script/repertoire.js') }}"></script>
<script src="{{ URL::asset('template/admin/dist/js/script/contact.js') }}"></script>
<script src="{{ URL::asset('template/admin/dist/js/script/ville.js') }}"></script>
<script src="{{ URL::asset('template/admin/dist/js/script/genre.js') }}"></script> --}}
<script src="{{ URL::asset('template/admin/dist/js/script/calendrier_pour_date.js') }}"></script>
