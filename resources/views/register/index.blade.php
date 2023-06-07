<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>{{$tittle}} </title>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="logo1.png"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif  
        
        <form action="{{ url('register') }}" method="post">
          @csrf

          <!-- Nama input -->
          <div class="form-outline mb-4">
            <input type="text"  class="form-control form-control-lg "
              placeholder="Masukan Nama Anda" autofocus required value="{{old('name')}}" id="name" name="name">
            <label class="form-label" for="name" >Nama</label>
            @error('name')
            <div class="invalid-feedback">Tolong Isi Dengan Nama anda</div>
            @enderror
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email"  class="form-control form-control-lg "
              placeholder="Masukan Alamat Email" autofocus required value="{{old('email')}}" id="email" name="email">
            <label class="form-label" for="email" name="email" >Email</label>
            @error('email')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Masukan Password" required name="password">
            <label class="form-label" for="form3Example4" >Password</label>
          </div>

         

          <div class="text-center text-lg-start mt-4 pt-2">
            <a href="/login" class="btn text-white me-4 btn-lg" style="background-color: #7a9bb0">Kembali</a>  
            
            <button type="submit" class="btn text-white me-4 btn-lg" style="background-color: #5fbff9">Daftar</button>

     
          </div>
        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-info">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © Afif Bangkit Nur Rahmaan 2023. All rights reserved.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
  <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</section>
</body>
</html>