
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('plugins/dt/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/dt/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>

<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--Toaster-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('plugins/menu-editor/jquery-menu-editor.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js')}}"></script>
<script src="{{asset('custom/js/admin.js')}}"></script>
{{--//Custom js page wise--}}
<script src="{{asset('pages/js/'.Request::segment(1).'.js')}}"></script>
{{--//yajra data table--}}
@switch(Request::segment(1))
    @case('user-list')
    <script>
        $(function () {
            $("#user_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
    @break
    @case('role-list')
    <script>
        $(function () {
            $("#role_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('role-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
    @break
    @case('permission-list')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $("#permission_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('permission-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
    @break

@endswitch
