@extends('auth.layouts.app-register')
@section('content')
    @include('sweetalert::alert')
    <div class="container">
    <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header bg-gradient-green">
                <h3 class="card-title">Daftar</h3>
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#daftar-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="daftar-part" id="daftar-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Daftar</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#form-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="form-part" id="form-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Form Pendaftaran</span>
                        
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#kajian-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="kajian-part" id="kajian-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                        
                        <span class="bs-stepper-label">Kajian Awal</span>
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <!-- your steps content here -->
                    <div id="daftar-part" class="content" role="tabpanel" aria-labelledby="daftar-part-trigger">
                      
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
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                    <div id="form-part" class="content" role="tabpanel" aria-labelledby="form-part-trigger">
                     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" id="nama" name="nama" placeholder="Nama Lengkap">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" id="nik" name="nik" placeholder="NIK" >
                                    @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir">
                                    @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                                    @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" id="alamat" name="alamat" placeholder="Alamat">
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_kk">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control @error('nama_kk') is-invalid @enderror" value="{{ old('nama_kk') }}" id="nama_kk" name="nama_kk" placeholder="Nama Kepala Keluarga">
                                    @error('nama_kk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select class="form-control "  id="jk" name="jk">
                                        <option>Jenis Kelamin</option>
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status Perkawinan</label>
                                    <select class="form-control "  id="status" name="status">
                                        <option>Status</option>
                                        <option>Belum Kawin</option>
                                        <option>Kawin</option>
                                        <option>Cerai Hidup</option>
                                        <option>Cerai Mati</option>
                                    </select>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" id="agama" name="agama">
                                        <option>Pilih Agama</option>
                                        <option>Budha</option>
                                        <option>Hindu</option>
                                        <option>Islam</option>
                                        <option>Kristen</option>
                                        <option>Katolik</option>
                                        <option>Konghucu</option>
                                    </select>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">No Telepon</label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" id="no_telp" name="no_telp" placeholder="No Telepon">
                                    @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan">
                                    @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" value="{{ old('pendidikan_terakhir') }}" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir">
                                    @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jaminan_asuransi">Jaminan Asuransi</label>
                                    <select class="form-control "  id="jaminan_asuransi" name="jaminan_asuransi">
                                        <option>Pilih Asuransi</option>
                                        <option>BPJS</option>
                                        <option>JKN</option>
                                        <option>Jamkesda</option>
                                        <option>Jamkesos</option>
                                        <option>Tidak Ada</option>
                                    </select>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="no_jaminan">No Jaminan</label>
                                    <input type="text" class="form-control @error('no_jaminan') is-invalid @enderror" value="{{ old('no_jaminan') }}" id="no_jaminan" name="no_asuransi" placeholder="No Jaminan">
                                    @error('no_jaminan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-check">
                                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div> --}}
                        
                    
                      <button class="btn btn-primary mr-2" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                    <div id="kajian-part" class="content" role="tabpanel" aria-labelledby="kajian-part-trigger">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status Di KK</label>
                                <select class="form-control" id="status" name="status">
                                    <option>Pilih Status</option>
                                    <option>Kepala Keluarga</option>
                                    <option>Suami</option>
                                    <option>Istri</option>
                                    <option>Anak</option>
                                    <option>orang Tua</option>
                                    <option>Menantu</option>
                                    <option>Pembantu</option>
                                    <option>Lain-lian</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="riwayat_penyakit_terdahulu">Riwayat Penyakit Terdahulu</label>
                                <input type="text" class="form-control" id="riwayat_penyakit_terdahulu" name="riwayat_penyakit_terdahulu" placeholder="Riwayat Penyakit Terdahulu">
                            </div>
                            <div class="form-group">
                                <label for="riwayat_penyakit_keluarga">Riwayat penyakit keluarga</label>
                                <input type="text" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" placeholder="Riwayat penyakit keluarga">
                            </div>
                            <div class="form-group">
                                <label for="pengkajian_psikologis">Pengkajian psikologis</label>
                                <input type="text" class="form-control" id="pengkajian_psikologis" name="pengkajian_psikologis" placeholder="Pengkajian psikologis">
                            </div>
                            <div class="form-group">
                                <label for="riwayat_gangguan_jiwa">Riwayat gangguan jiwa</label>
                                <input type="text" class="form-control" id="riwayat_gangguan_jiwa" name="riwayat_gangguan_jiwa" placeholder="Riwayat gangguan jiwa">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keluarga_gangguan_jiwa">Ada keluarga yang gangguan jiwa</label>
                                <input type="text" class="form-control" id="keluarga_gangguan_jiwa" name="keluarga_gangguan_jiwa" placeholder="Ada keluarga yang gangguan jiwa">
                            </div>
                            <div class="form-group">
                                <label for="tinggal_dengan">Tinggal dengan</label>
                                <input type="text" class="form-control" id="tinggal_dengan" name="tinggal_dengan" placeholder="Tinggal dengan">
                            </div>
                            <div class="form-group">
                                <label for="hambatan_bahasa">Hambatan Bahasa</label>
                                <input type="text" class="form-control" id="hambatan_bahasa" name="hambatan_bahasa" placeholder="Hambatan Bahasa">
                            </div>
                            <div class="form-group">
                                <label for="hambatan_budaya">Hambatan Budaya</label>
                                <input type="text" class="form-control" id="hambatan_budaya" name="hambatan_budaya" placeholder="Hambatan Budaya">
                            </div>
                            <div class="form-group">
                                <label for="hambatan_mobilitas">Hambatan Mobilitas Fisik</label>
                                <input type="text" class="form-control" id="hambatan_mobilitas" name="hambatan_mobilitas" placeholder="Hambatan Mobilitas Fisik">
                            </div>
                        </div>
                    </div>
                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
            <p>Sudah punya akun? <a href="/" class="text-center"> Silahkan login.</a></p>
              </div>
            </div>
            <!-- /.card -->
        
        </div>
        {{-- <div class="register-box ">
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
                    {{-- <div class="col-lg">
                      <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                    <!-- /.col -->
                  </div>
                  <br>
                </form>
                <p>Sudah punya akun? <a href="/" class="text-center"> Silahkan login.</a></p>
              </div> --}} 
              <!-- /.form-box -->
            {{-- </div><!-- /.card -->
          </div>
    {{-- </x-card> --}}
    </div>
    </div>
    @endsection