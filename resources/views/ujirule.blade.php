@extends('layout/main')




@section('content')
<div class="container">
               
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-body text-center">
        <div class="table-responsive">
            <hr>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <h4>Data Uji</h4>
                <form action="{{ route('importDataUji') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                <button class="btn btn-success" href= >ImportExcel</button>
                </form>
                <br>
                <br>
                <a class="btn btn-success" href="hitungakurasi">Hitung Akurasi</a>
                <hr>
                <h3>Data Uji</h3>
                    <thead>
                        <tr>
                            
                            <th>Nomor Resi</th>
                            <th>Asuransi</th>
                            <th>YES*</th>
                            <th>Destinasi</th>
                            <th>Jumlah Kiriman</th>
                            <th>Jenis Kiriman</th>
                            <th>Isi Kiriman</th>
                            <th>Tepat Waktu</th>
                           
                          
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datauji as $p)
                        <tr>
                         <td>{{$p->resi}}</td>
                         <td>{{$p->asuransi}}</td>
                         <td>{{$p->yesstar}}</td>
                         <td>{{$p->destinasi}}</td>
                         <td>{{$p->jumlahkiriman}}</td>
                         <td>{{$p->jeniskiriman}}</td>
                         <td>{{$p->isikiriman}}</td>
                         <td>{{$p->tepatwaktu_asli}}</td>
                            
                            
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