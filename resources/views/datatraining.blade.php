@extends('layout/main')




@section('content')
<div class="container">
               
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Input Data Training</h1>
        
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-body text-center">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
        <div class="table-responsive">
            <form method="POST" action='{{ url('datatraining') }}'>
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
                                <option value="Luar Pulau"><?= 'Luar Pulau';?></option>
                                <option value="Dalam Pulau"><?= 'Dalam Pulau';?></option>
                              </select>
                          </div>
                          @error('destinasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                          
                      </div>
                      <div class="mb-3">
                        <label class="small mb-1"> Jumlah Kiriman</label>
                        <input class="form-control" id="jumlahkiriman" type="text" placeholder="Masukan Jumlah Kiriman" aria-label="Default Select Sample" name="jumlahkiriman">
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
                            <option value="High Value"><?= 'High Value';?></option>
                            <option value="Dangerous Goods"><?= 'Dangerous Goods';?></option>
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

                    <div class="mb-3">
                        <label class="small mb-1"> Tepat Waktu</label>
                        <select class="form-control" id="tepatwaktu" type="text" placeholder="Masukan Isi Kiriman" aria-label="Default Select Sample" name="tepatwaktu">
                            <option selected disabled> Tepat Waktu :</option>
                            <option value="Ya"><?= 'Ya';?></option>
                            <option value="Tidak"><?= 'Tidak';?></option>
                          </select>
                    </div>
                    @error('tepatwaktu')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror

                   
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success" type="submit" >Tambah</button>
                    </div>
                       
                    
                </form>
            <hr>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <h4>Data Training</h4>
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                <button class="btn btn-success" href= >ImportExcel</button>
                </form>
                <hr>
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
                            <th>Aksi</th>
                          
                        
                        </tr>
                    </thead>
                    <tbody>
                   @foreach ($data_training as $p)
                       <tr>
                           <td>{{$p->resi}}</td>
                           <td>{{$p->asuransi}}</td>
                           <td>{{$p->yesstar}}</td>
                           <td>{{$p->destinasi}}</td>
                           <td>{{$p->jumlahkiriman}}</td>
                           <td>{{$p->jeniskiriman}}</td>
                           <td>{{$p->isikiriman}}</td>
                           <td>{{$p->tepatwaktu}}</td>
                           <td><a class='btn btn-success btn-sm' title='Update' href='{{url('tampildata/'.$p->id)}}' >Update</a>
                            <hr>
                             <button href='' class='btn btn-danger btn-sm' title='Hapus' data-popup='tooltip' data-placement='top'  data-toggle='modal' data-target='#deleteModal{{$p->id}}'>Hapus</i></a></td>
                           
                       </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--Update Modal-->
    @foreach ($data_training as $p)
    <div class="modal fade" id="deleteModal{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                        </div>
                            <div class="modal-body">
                                 Apa anda Yakin Menghapus data Training ini ?
                             </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <a href='{{url('destroy/'.$p->id)}}' type="button"  class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
    @endforeach

    

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