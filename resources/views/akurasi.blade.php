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
             
                <a class="btn btn-success">Lihat Pohon Keputusan</a>
                <hr>
                <h3>Perhitungan Akurasi Menggunakan Data Uji</h3>
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
                            <th>Prediksi tepat Waktu</th>
                            <th>ID RULE TERPILIH</th>
                            <th>Ketepatan</th>
                           
                          
                        
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
                         <td>{{$p->tepatwaktu_prediksi}}</td>
                         <td>{{$id_rule[0]}}</td>
                         @if($ketepatan == 'Salah')
                         <td>{{$ketepatan}}</td>
                         @else
                         <td>{{$ketepatan}}</td>
                         @endif   
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h1>Akurasi = {{$akurasi}} %</h1>
                <h1>Error Rate = {{$laju_error}} %</h1>
                <h1>Sensitivitas = {{$sensitivitas}}</h1>
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