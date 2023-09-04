@extends('layout/main')




@section('content')
<div class="container">
               
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hasil Prediksi</h1>
        
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-body text-center">
           <h1> Hasil Prediksi </h1>
        <hr>
           <h2>Data Resi</h2>
            <p>Resi : {{$resi}}</p>
            <p>Asuransi : {{$asuransi}}</p> 
            <p>Yes* : {{$yesstar}}</p> 
            <p>Destinasi : {{$destinasi}}</p>
            <p>Jenis Kiriman : {{$jeniskiriman}}</p> 
            <p>Jumlah Kiriman : {{$jumlahkiriman}}</p>   
            <p>Isi Kiriman : {{$isikiriman}}</p>    
            <p> Rule yang terpilih adalah Rule = {{$rule}}</p>
            <h2> Prediksi Ketepatan Waktu Kiriman YES adalah {{$hasil}}<h2>
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