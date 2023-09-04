@extends('layout/main')




@section('content')
<div class="container">
               
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pohon Keputusan</h1>
        
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-5">
        <div class="card-body text-center">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
        <div class="table-responsive">
            <hr>
           
                <table class="table table-bordered" id="dataTable" width="200%" cellspacing="0">
                <h4>Pohon Keputusan</h4>
                <hr>
                <a class="btn btn-success" href=/ujirule >Uji Rule</a> 
                <a> </a>
                <a class="btn btn-success" href=/bentuktree >Bentuk Tree</a>
                <a> </a>
                <a class="btn btn-danger" href=/hapuspohon >Hapus Pohon Keputusan</a>
                <br><hr>
                <thead>
                    <tr>  
                        <th>Id Pohon Keputusan</th>
                        <th>Pohon Keputusan</th>
                       
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($rule as $r)
                    <tr>
                       <td>{{$r->id}}</td>
                       <td>IF{{$r->parent}} AND {{$r->akar}} THEN tepatwaktu = {{$r->keputusan}} </td>
                    </tr>
                    @endforeach
                </tbody>    
            </table>
            
          

                
            </div>
        </div>
    </div>

    

     <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



</div>
<!-- End of Content Wrapper -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
    <div class="copyright text-center my-auto">
        <span>Copyright &copy; Afif Bangkit Nur Rahmaan</span>
    </div>
</div>
</footer>
@endsection