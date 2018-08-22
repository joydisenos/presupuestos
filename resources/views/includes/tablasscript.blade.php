<!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
        
        $('.agregar').click(function(){
            $('.toggle').toggle('slow');
        });
    });
    </script>