@extends('dashboard.layout.master')

@section('title')
<title>AdminLTE 3 | DataTables</title>
@endsection

@section('customstyles')
 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('custom-dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('custom-dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('custom-dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('custom-dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('custom-dashboard/dist/css/adminlte.min.css')}}">
 <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">  -->
  @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>National_id</th>
                    <th>Image</th>
                    <th>Action</th>

                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($receptionists as $recp)
                  <tr>
                    <td>{{$recp -> name }}</td>
                    <td>{{$recp -> email }}
                    </td>
                    <td>{{$recp -> national_id}}</td>
                    <td> <img src='{{ asset("uploads/receptionist/$recp->avatar_img") }}' width="80" height="80"></td>
                    <td>  
                   
                    <span> <a href="/editrecp/{{ $recp-> id }}" class="btn btn-primary">edit </a></span>
   
   
                  <form method="post" class="delete_form d-inline "  action="{{ route('receptionist.delete', ['id' => $recp->id]) }}">
                  @method('DELETE')
                   @csrf
                  <button type="submit" class="btn btn-danger">Delete</button>
</form> </td>
                     
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('custom-scripts')

<!-- jQuery -->
<script src="{{asset('custom-dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('custom-dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


<!-- DataTables  & Plugins -->
<script src="{{asset('custom-dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('custom-dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}')}}"></script>
<scrpit src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<!-- Page specific script -->
<!-- <script>
  $(document).ready( function () {
    $('#example2').DataTable();
} );
</script> -->
<script>

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>



@endsection