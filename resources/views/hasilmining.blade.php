@extends('layout/main')




@section('content')
<div class="container">
               
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-5">
        <div class="card-body text-center">
        <div class="table-responsive">
            <hr>
           
                <table class="table table-bordered" id="dataTable" width="200%" cellspacing="0">
                <h4>Hasil Data Training untuk node awal</h4>
                <hr>
                <h3>Attribut Yang terpilih sebagai node awal adalah {{$maxgain}}, Dengan Nilai {{$gain}}</h3>
                <hr>
                <thead>
                    <tr>  
                        <th>Atribut</th>
                        <th>Jumlah</th>
                        <th>Tepatwaktu</th>
                        <th>Tidak</th>
                        <th>Entropy</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total</td>
                     
                        <td>{{$AllAttr}}</td>
                        <td>{{$AllAttrYa}}</td>
                        <td>{{$AllAttrTidak}}</td>
                        <td>{{$AllEntropy}}</td>
                       </tr>
                </tbody>    
            </table>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>  
                            <th>Atribut</th>
                            <th></th>
                            <th>Jumlah</th>
                            <th>Tepatwaktu</th>
                            <th>Tidak</th>
                            <th>Entropy</th>
                            <th>Gain</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                        <td rowspan="2">Asuransi</td>
                        <td>Ya</td>
                        <td>{{$asuransiYa}}</td>
                        <td>{{$asuransiYa1}}</td>
                        <td>{{$asuransiYa2}}</td>
                        <td>{{$entropy}}</td>
                        <td rowspan="2">{{$asuransiGain}}</td>
                       </tr>
                       <tr>
                        <td>Tidak</td>
                        <td>{{$asuransiTidak}}</td>
                        <td>{{$asuransiTidak1}}</td>
                        <td>{{$asuransiTidak2}}</td>
                        <td>{{$entropyTidak}}</td>
                       </tr>

                       <tr>
                        <td rowspan="2">Yes*</td>
                        <td>Ya</td>
                        <td>{{$yesstarYa}}</td>
                        <td>{{$yesstarYa1}}</td>
                        <td>{{$yesstarYa2}}</td>
                        <td>{{$entropyYesstar}}</td>
                        <td rowspan="2">{{$yesstarGain}}</td>
                       </tr>

                       <tr>
                        <td>Tidak</td>
                        <td>{{$yesstarTidak}}</td>
                        <td>{{$yesstarTidak1}}</td>
                        <td>{{$yesstarTidak2}}</td>
                        <td>{{$entropyYesstarTidak}}</td>
                       </tr>


                       <tr>
                        <td rowspan="3">Destinasi</td>
                        <td>Jabodetabek</td>
                        <td>{{$attrJabodetabek}}</td>
                        <td>{{$attrJabodetabekYa}}</td>
                        <td>{{$attrbJabodetabekTidak}}</td>
                        <td>{{$entropyJabodetabek}}</td>
                        <td rowspan="3">{{$destinasiGain}}</td>
                       </tr>

                       <tr>
                        <td>Luar Pulau</td>
                        <td>{{$attrLuarPulau}}</td>
                        <td>{{$attrLuarPulauYa}}</td>
                        <td>{{$attrLuarPulauTidak}}</td>
                        <td>{{$entropyLuarPulau}}</td>
                       </tr>

                       <tr>
                        <td>Dalam Pulau</td>
                        <td>{{$attrDalamPulau}}</td>
                        <td>{{$attrDalamPulauYa}}</td>
                        <td>{{$attrDalamPulauTidak}}</td>
                        <td>{{$entropyDalamPulau}}</td>
                       </tr>

                       <tr>
                        <td rowspan="2">Jumlah Kiriman</td>
                        <td>Jumlah Kiriman = 1</td>
                        <td>{{$attrJumlahKiriman1}}</td>
                        <td>{{$attrJumlahKirimanYa1}}</td>
                        <td>{{$attrJumlahKirimanTidak1}}</td>
                        <td>{{$entropyJumlahKiriman1}}</td>
                        <td rowspan="2">{{$jumlahKirimangain}}</td>
                       </tr>
                       <tr>
                        <td>Lebih Dari 1</td>
                        <td>{{$attrJumlahKiriman2}}</td>
                        <td>{{$attrJumlahKirimanYa2}}</td>
                        <td>{{$attrJumlahKirimanTidak2}}</td>
                        <td>{{$entropyJumlahKiriman2}}</td>
                       </tr>


                       <tr>
                        <td rowspan="3">Jenis Kiriman</td>
                        <td>General</td>
                        <td>{{$attrGeneral}}</td>
                        <td>{{$attrGeneralYa}}</td>
                        <td>{{$attrGeneralTidak}}</td>
                        <td>{{$entropyGeneral}}</td>
                        <td rowspan="3">{{$jenisKirimanGain}}</td>
                       </tr>

                       <tr>
                        <td>High Value</td>
                        <td>{{$attrHighValue}}</td>
                        <td>{{$attrHighValueYa}}</td>
                        <td>{{$attrHighValueTidak}}</td>
                        <td>{{$entropyHighValue}}</td>
                       </tr>

                       <tr>
                        <td>Dangerous goods</td>
                        <td>{{$attrDangerousGoods}}</td>
                        <td>{{$attrDangerousGoodsYa}}</td>
                        <td>{{$attrDangerousGoodsTidak}}</td>
                        <td>{{$entropyDangerousGoods}}</td>
                       </tr>

                       <tr>
                        <td rowspan="2">Isi Kiriman</td>
                        <td>Dokumen</td>
                        <td>{{$attrDokumen}}</td>
                        <td>{{$attrDokumenYa}}</td>
                        <td>{{$attrDokumenTidak}}</td>
                        <td>{{$entropyDokumen}}</td>
                        <td rowspan="2">{{$isiKirimangain}}</td>
                       </tr>
                       <tr>
                        <td>Paket</td>
                        <td>{{$attrPaket}}</td>
                        <td>{{$attrPaketYa}}</td>
                        <td>{{$attrPaketTidak}}</td>
                        <td>{{$entropyPaket}}</td>
                       </tr>
                    </tbody>
                </table>

                <div>
                    
                </div>

                
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