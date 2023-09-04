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
                            <th>No.</th>
                            <th>Nomor Resi</th>
                            <th>Asuransi</th>
                            <th>YES*</th>
                            <th>Destinasi</th>
                            <th>Jumlah Kiriman</th>
                            <th>Jenis Kiriman</th>
                            <th>Isi Kiriman</th>
                            <th>Tepat Waktu</th>
                            <th>Prediksi Tepat Waktu</th>
                            <th>Ketepatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datauji as $p)
                        <tr>
                            <td>{{$no++}}</td>   
                            <td>{{$p->resi}}</td>
                            <td>{{$p->asuransi}}</td>
                            <td>{{$p->yesstar}}</td>
                            <td>{{$p->destinasi}}</td>
                            <td>{{$p->jumlahkiriman}}</td>
                            <td>{{$p->jeniskiriman}}</td>
                            <td>{{$p->isikiriman}}</td>
                            <td>{{$p->tepatwaktu_asli}}</td>
                            <td>{{$p->tepatwaktu_prediksi}}</td>
                            <td>
                                @if ($p->tepatwaktu_asli != $p->tepatwaktu_prediksi)
                                    Salah
                                @else
                                    <b>Benar</b>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <hr>
                <h1>Perhitungan Confusion Matrix</h1>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="accuracy-chart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="sensitivity-chart"></canvas>
                    </div>
                </div>

                <h2>Akurasi = {{$akurasi}} %</h2>
                <h2>Error Rate = {{$laju_error}} %</h2>
                <h2>Recall = {{$sensitivitas}} %</h2>
                <h2>Presisi = {{$spesifisitas}} %</h2>  
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body text-center">
            <hr>
            <h1>Data Yang Digunakan</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="data-latih-chart"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="data-uji-chart"></canvas>
                </div>
            </div>
            <h2>Data Latih Yang digunakan: {{$jumlahDataLatih}}</h2>
            <h2>Data Uji Yang digunakan: {{$jumlahDataUji}}</h2>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accuracyData = {
            labels: ['Akurasi', 'Error Rate'],
            datasets: [{
                data: [{{$akurasi}}, {{$laju_error}}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        };

        const sensitivityData = {
            labels: ['Recall', 'Presisi'],
            datasets: [{
                data: [{{$sensitivitas}}, {{$spesifisitas}}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        };

        const dataLatihData = {
            labels: ['Data Latih'],
            datasets: [{
                data: [{{$jumlahDataLatih}}],
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const dataUjiData = {
            labels: ['Data Uji'],
            datasets: [{
                data: [{{$jumlahDataUji}}],
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        const options = {
            responsive: true,
            maintainAspectRatio: false
        };

        const accuracyChart = new Chart(document.getElementById('accuracy-chart').getContext('2d'), {
            type: 'pie',
            data: accuracyData,
            options: options
        });

        const sensitivityChart = new Chart(document.getElementById('sensitivity-chart').getContext('2d'), {
            type: 'pie',
            data: sensitivityData,
            options: options
        });

        const dataLatihChart = new Chart(document.getElementById('data-latih-chart').getContext('2d'), {
            type: 'bar',
            data: dataLatihData,
            options: options
        });

        const dataUjiChart = new Chart(document.getElementById('data-uji-chart').getContext('2d'), {
            type: 'bar',
            data: dataUjiData,
            options: options
        });
    });
</script>
@endsection
