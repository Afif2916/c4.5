@extends('layout/main')




@section('content')
<div class="container">
               
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Prediksi</h1>
        
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-body text-center">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
        <div class="table-responsive">
            <form method="POST" action='/prediksi'>
                @csrf
                <div class="mb-3">
                   
                    <label class="small mb-1"> Nomor Resi</label>
                    <input class="form-control" id="resi" type="text" placeholder="Masukan Nomor Resi" aria-label="Default Select Sample" name="resi">    
                    </div>
                    <div class="row gx-3 input-group">
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1"> Asuransi</label>
                                  <select class="form-control" id="asuransi" type="text" placeholder="Asuransi" aria-label="Default Select Sample" name="asuransi">
                                      <option selected disabled> Asuransi :</option>
                                      <option value="Ya"><?= 'Ya';?></option>
                                      <option value="Tidak"><?= 'Tidak';?></option>
                                    </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="small mb-1"> Destinasi</label>
                            <select class="form-control" id="destinasi" type="text" placeholder="Masukan Jenis Destinasi" aria-label="Default Select Sample" name="destinasi">
                                <option selected disabled> Destinasi :</option>
                                <option value="Jabodetabek"><?= 'Jabodetabek';?></option>
                                <option value="LuarPulau"><?= 'Luar Pulau';?></option>
                                <option value="DalamPulau"><?= 'Dalam Pulau';?></option>
                              </select>
                          </div>
                          @error('destinasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                          
                      </div>
                      <div class="mb-3">
                        <label class="small mb-1"> Jumlah Kiriman</label>
                        <select class="form-control" id="jumlahkiriman" type="text" placeholder="Masukan Jumlah Kiriman" aria-label="Default Select Sample" name="jumlahkiriman">
                        <option selected disabled> Jumlah Kiriman :</option>
                        <option value="Satu"><?= 'Satu';?></option>
                        <option value="Lebihdarisatu"><?= 'Lebihdarisatu';?></option>
                        </select>
                      </div>
                      @error('jumlahkiriman')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror

                      <div class="mb-3">
                        <label class="small mb-1"> YES*</label>
                        <select class="form-control" id="yesstar" type="text" placeholder="Masukan Jenis Kiriman" aria-label="Default Select Sample" name="yesstar">
                            <option selected disabled> YES* :</option>
                            <option value="Ya"><?= 'Ya';?></option>
                            <option value="Tidak"><?= 'Tidak';?></option>
                          </select>
                    </div>
                    @error('yesstar')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      
                    <div class="mb-3">
                        <label class="small mb-1"> Jenis Kiriman</label>
                        <select class="form-control" id="jeniskiriman" type="text" placeholder="Masukan Jenis Kiriman" aria-label="Default Select Sample" name="jeniskiriman">
                            <option selected disabled> Jenis Kiriman :</option>
                            <option value="HighValue"><?= 'High Value';?></option>
                            <option value="DangerousGoods"><?= 'Dangerous Goods';?></option>
                            <option value="General"><?= 'General';?></option>
                          </select>
                    </div>
                    @error('jeniskiriman')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror

                    <div class="mb-3">
                        <label class="small mb-1"> Isi Kiriman</label>
                        <select class="form-control" id="isikiriman" type="text" placeholder="Masukan Isi Kiriman" aria-label="Default Select Sample" name="isikiriman">
                            <option selected disabled> Isi Kiriman :</option>
                            <option value="Dokumen"><?= 'Dokumen';?></option>
                            <option value="Paket"><?= 'Paket';?></option>
                          </select>
                    </div>
                    @error('isikiriman')
                            <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    

                   
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success" type="submit" >Prediksi</button>
                    </div>
                       
                    
                </form>
          
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