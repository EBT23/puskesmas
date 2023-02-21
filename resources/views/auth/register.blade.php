@extends('auth.layouts.app-login')
@section('content')
    @include('sweetalert::alert')
    <div class="container">
    <div class="col-md-6">
    {{-- <x-card title="Register" subtitle="Create new account"> --}}
        <div class="register-box ">
            <div class="card card-outline card-primary">
              <div class="card-header text-center">
                <a href="#" class="h1"><b>PUSKESMAS</b> <br> SEWON</a>
              </div>
              <div class="card-body col-lg">
                <p class="login-box-msg">Daftar Akun</p>
          
                <form action="{{ route('register') }}" method="post">
                  @csrf
                  <div class="input-group mb-3">
                    <input type="text"  class="form-control @error('full_name') is-invalid @enderror"  id="full_name" name="full_name" placeholder="Nama Lengkap">
                    
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                    </div>
                    @error('full_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                  <div class="input-group mb-3">
                    <input type="email"  class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                    @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                  <div class="input-group mb-3">
                    <input type="password"  class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="input-group mb-3">
                    <input type="password"  class="form-control" name="password" placeholder="Ulangi password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    {{-- <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                         I agree to the <a href="#">terms</a>
                        </label>
                      </div>
                    </div> --}}
                    <!-- /.col -->
                    <div class="col-lg">
                      <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                    <!-- /.col -->
                  </div>
                  <br>
                </form>
                <p>Sudah punya akun? <a href="/" class="text-center"> Silahkan login.</a></p>
              </div>
              <!-- /.form-box -->
            </div><!-- /.card -->
          </div>
    {{-- </x-card> --}}
    </div>
    </div>
    @endsection