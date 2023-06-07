@extends('layout/main')




@section('content')
<div class="container">
               
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Data</h1>
        
    </div>

    <!-- Content Row -->
  
    <div class="card shadow mb-4">
        <div class="card-body text-center">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
        <div class="table-responsive">
            <form method="POST" action='{{url('update/'.$data->id)}}'>
                @csrf
                @method('GET')
                <div class="mb-3">
                    <label class="small mb-1"> Id Data</label>
                    <input class="form-control" readonly id="id" type="text" placeholder="Masukan Nomor Resi" aria-label="Default Select Sample" name="id" value="{{$data->id}}">    
                    </div>
                <div class="mb-3">
                <label class="small mb-1"> Nomor Resi</label>
                <input class="form-control" readonly id="resi" type="text" placeholder="Masukan Nomor Resi" aria-label="Default Select Sample" name="resi" value="{{$data->resi}}">    
                </div>

                <div class="row gx-3 input-group">
                    <div class="mb-3 col-md-6">
                        <label class="small mb-1"> Asuransi</label>
                              <select class="form-control" id="asuransi" type="text" placeholder="Asuransi" aria-label="Default Select Sample" name="asuransi">
                                  <option selected disabled >Asuransi</option>
                                  <option value="Ya" {{$data->asuransi == "Yes" ? "selected" : ''}}><?= 'Ya';?></option>
                                  <option value="Tidak"{{$data->asurnasi == "No" ? "selected" : ''}}><?= 'Tidak';?></option>
                                </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="small mb-1"> Destinasi</label>
                        <select class="form-control" id="destinasi" type="text" placeholder="Masukan Jenis Destinasi" aria-label="Default Select Sample" name="destinasi">
                            <option selected disabled> Destinasi :</option>
                            <option value="Jabodetabek" {{$data->destinasi == "Jabodetabek" ? "selected" : ''}}><?= 'Jabodetabek';?></option>
                            <option value="Luar Pulau" {{$data->destinasi == "Luar Pulau" ? "selected" : ''}} ><?= 'Luar Pulau';?></option>
                            <option value="Dalam Pulau" {{$data->destinasi == "Dalam Pulau" ? "selected" : ''}}><?= 'Dalam Pulau';?></option>
                          </select>
                      </div>   
                  </div>

                  <div class="mb-3">
                    <label class="small mb-1"> Jumlah Kiriman</label>
                    <input class="form-control" value="{{$data->jumlahkiriman}}" id="jumlahkiriman" type="text" placeholder="Masukan Jumlah Kiriman" aria-label="Default Select Sample" name="jumlahkiriman">
                  </div>

                  <div class="mb-3">
                    <label class="small mb-1"> YES*</label>
                    <select class="form-control" id="yesstar" type="text" placeholder="Masukan Jenis Kiriman" aria-label="Default Select Sample" name="yesstar">
                        <option selected disabled> Yes* :</option>
                        <option value="Ya" {{$data->yesstar == "Ya" ? "selected" : ''}}><?= 'Ya';?></option>
                        <option value="Tidak" {{$data->yesstar == "Tidak" ? "selected" : ''}}><?= 'Tidak';?></option>
                      </select>
                </div>
                  
                <div class="mb-3">
                    <label class="small mb-1"> Jenis Kiriman</label>
                    <select class="form-control" id="jeniskiriman" type="text" placeholder="Masukan Jenis Kiriman" aria-label="Default Select Sample" name="jeniskiriman">
                        <option selected disabled> Jenis Kiriman :</option>
                        <option value="High Value" {{$data->jeniskiriman == "High Value" ? "selected" : ''}}><?= 'High Value';?></option>
                        <option value="Dangerous Goods" {{$data->jeniskiriman == "Dangerous Goods" ? "selected" : ''}}><?= 'Dangerous Goods';?></option>
                        <option value="General" {{$data->jeniskiriman == "General" ? "selected" : ''}}><?= 'General';?></option>
                      </select>
                </div>

                <div class="mb-3">
                    <label class="small mb-1"> Isi Kiriman</label>
                    <select class="form-control" id="isikiriman" type="text" placeholder="Masukan Isi Kiriman" aria-label="Default Select Sample" name="isikiriman">
                        <option selected disabled> isi Kiriman:</option>
                        <option value="Dokumen" {{$data->isikiriman == "Dokumen" ? "selected" : ''}} > <?= 'Dokumen';?></option>
                        <option value="Paket" {{$data->isikiriman == "Paket" ? "selected" : ''}}> <?= 'Paket';?></option>
                      </select>
                </div>

                <div class="mb-3">
                    <label class="small mb-1"> Tepat Waktu</label>
                    <select class="form-control" id="tepatwaktu" type="text" placeholder="Masukan Isi Kiriman" aria-label="Default Select Sample" name="tepatwaktu">
                        <option selected disabled> Tepat Waktu:</option>
                        <option value="Ya" {{$data->tepatwaktu == "Ya" ? "selected" : ''}}><?= 'Ya';?></option>
                        <option value="Tidak" {{$data->tepatwaktu == "Tidak" ? "selected" : ''}}><?= 'Tidak';?></option>
                      </select>
                </div>  
               
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" type="submit" >Update</button>
                </div>
            </form>
            <hr>
               
            </div>
        </div>
    </div>


    <!--Update Modal-->
    

    

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