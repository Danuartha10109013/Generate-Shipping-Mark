@extends('Form-Check.layout.main')
@section('title')
    Form Submission Crane
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="col-md-12 container-fluid">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> Add Submission Crane
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>

      <div class="row stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">From Daily Checklist Crane</h4>
                <p class="card-description"> FORMULIR CRANE <br>
                    PENGISIAN FORMULIR DILAKUKAN AWAL SHIFT/SEBELUM DIGUNAKAN </p>
        @if (Auth::user()->role == 0)
            <form action="{{route('Form-Check.admin.crane.create')}}" method="POST">
        @else
            <form action="{{route('Form-Check.pegawai.crane.create')}}" method="POST">
        @endif
                @method('POST')
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputUsername1">NAMA OPERATOR CHEKLIST CRANE <small style="color: red;">*</small></label>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->name }}" readonly>
                      </div>

                      <div class="mb-3">
                        <label for="atribute" class="form-label">Team Lead<small style="color: red;">*</small></label>
                        <select type="text" name="shift_leader" id="team" class="form-control" required>
                          <option value="" selected disabled>--Pilih Shift Leader--</option>
                          <option value="Panggah S">Panggah S</option>
                          <option value="Danu">Danu</option>
                          <option value="Riyan H">Riyan H</option>
                          <option value="Freddy">Freddy</option>
                          <option value="Dika">Dika</option>
                          <option value="Alex (PRD)">Alex (PRD)</option>
                          <option value="Ary (PRD)">Ary (PRD)</option>
                          <option value="Arsy (PRD)">Arsy (PRD)</option>
                          <option value="Ahmed (PRD)">Ahmed (PRD)</option>
                          <option value="other">Other</option> <!-- Add this option -->
                      </select>
                    </div>
                  
                  <!-- Input field for custom keterangan -->
                  <div class="mb-3" id="other-keterangan-container" style="display: none;">
                      <label for="other-keterangan" class="form-label">Please specify<small style="color: red;">*</small></label>
                      <input type="text" name="other_sift_leader" id="other-keterangan" class="form-control" placeholder="Enter new Shift Leader">
                  </div>
                  <script>
                      document.getElementById('team').addEventListener('change', function() {
                          var otherKeteranganContainer = document.getElementById('other-keterangan-container');
                          if (this.value === 'other') {
                              otherKeteranganContainer.style.display = 'block'; // Show the custom input field
                          } else {
                              otherKeteranganContainer.style.display = 'none'; // Hide the custom input field
                          }
                      });
                  </script>
                    <div class="form-group">
                        <label for="label">KAPASITAS/AREA CRANE<small style="color: red;">*</small>
                        </label>
                        <select class="form-control" name="jenis_crane" id="exampleSelectOption" required>
                            <option value="" selected disabled>--Pilih Kapasistas Crane--</option>
                            <option value="30 Ton" {{ old('jenis_crane') == '30 Ton' ? 'selected' : '' }}>30 Ton</option>
                            <option value="10 Ton" {{ old('jenis_crane') == '10 Ton' ? 'selected' : '' }}>10 Ton</option>
                            <option value="5 Ton L8 (No. 1)" {{ old('jenis_crane') == '5 Ton L8 (No. 1)' ? 'selected' : '' }}>5 Ton L8 (No. 1)</option>
                            <option value="5 Ton L8 (No. 2)" {{ old('jenis_crane') == '5 Ton L8 (No. 2)' ? 'selected' : '' }}>5 Ton L8 (No. 2)</option>
                            <option value="30 Ton Entry (PRD)" {{ old('jenis_crane') == '30 Ton Entry (PRD)' ? 'selected' : '' }}>30 Ton Entry (PRD)</option>
                            <option value="7,5 Ton Center (PRD)" {{ old('jenis_crane') == '7,5 Ton Center (PRD)' ? 'selected' : '' }}>7,5 Ton Center (PRD)</option>
                            <option value="10 Ton POT (PRD)" {{ old('jenis_crane') == '10 Ton POT (PRD)' ? 'selected' : '' }}>10 Ton POT (PRD)</option>
                            <option value="15 Ton APC (PRD)" {{ old('jenis_crane') == '15 Ton APC (PRD)' ? 'selected' : '' }}>15 Ton APC (PRD)</option>
                            <option value="15 Ton Exit (PRD)" {{ old('jenis_crane') == '15 Ton Exit (PRD)' ? 'selected' : '' }}>15 Ton Exit (PRD)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label">SHIFT<small style="color: red;">*</small>
                        </label>
                        <select class="form-control" name="shift" id="exampleSelectOption" required>
                            <option value="" selected disabled>--Pilih Sift--</option>
                            <option value="1" {{ old('jenis_crane') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('jenis_crane') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('jenis_crane') == '3' ? 'selected' : '' }}>3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hari / Tanggal<small style="color: red;">*</small></label>
                        <input type="Date" class="form-control" name="date" id="exampleInputEmail1" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jam Checklist Crane<small style="color: red;">*</small></label>
                        <input type="time" class="form-control" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                      </div>
                </div>
                <p class="card-description"> JIKA KETERANGAN (X,O) HARAP SEGERA INFORMASI KE MAINTENANCE  </p>
                <p>KETERANGAN: <br>
                    <b>V</b>: KONDISI BAIK <br>
                    <b>X</b>: KONDISI TIDAK BAIK DAN CRANE TIDAK BISA DIGUNAKAN <br>
                    <b>O</b>: KONDISI TIDAK BAIK NAMUN MASIH BISA DIGUNAKAN</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Start <small style="color: red;">*</small> <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="start" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="start" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="start" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tombol Start</label>
                            <input type="text" class="form-control" name="ket_start" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <hr>
                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Switch On-Off <small style="color: red;">*</small> <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="switch" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="switch" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="switch" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tombol Switch On-Off</label>
                            <input type="text" class="form-control" name="ket_switch" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Up <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="up" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="up" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="up" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tombol Up</label>
                            <input type="text" class="form-control" name="ket_up" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Down <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="down" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="down" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="down" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tombol Down</label>
                            <input type="text" class="form-control" name="ket_down" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Cross Travel <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="ctravel" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ctravel" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ctravel" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tombol Cross Travel</label>
                            <input type="text" class="form-control" name="ket_ctravel" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Long Travel <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="ltravel" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ltravel" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ltravel" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tombol Long Travel</label>
                            <input type="text" class="form-control" name="ket_ltravel" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Emergency <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="emergency" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="emergency" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="emergency" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label for="exampleInputPassword1">Pengecekan Tombol Emergency</label>
                            <input type="text" class="form-control" name="ket_emergency" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Speed 1 <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="speed1" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="speed1" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="speed1" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tombol Speed 1</label>
                            <input type="text" class="form-control" name="ket_speed1" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tombol Speed 2 <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="speed2" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="speed2" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="speed2" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tombol Speed 2</label>
                            <input type="text" class="form-control" name="ket_speed2" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Pully Bottom Block <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="block" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="block" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="block" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Pully Bottom Block</label>
                            <input type="text" class="form-control" name="ket_block" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Lifting Hook Lockert <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="lockert" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="lockert" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="lockert" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Wire Rope</label>
                            <input type="text" class="form-control" name="ket_lockert" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                    </div>

                    
                    <div class="col-md-6">
                        
                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Wire Rope <small style="color: red;">*</small> <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="wire" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="wire" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="wire" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Wire Rope</label>
                            <input type="text" class="form-control" name="ket_wire" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Lampu Sirine Long Travel <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="sltravel" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="sltravel" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="sltravel" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Lampu Sirine Long Travel</label>
                            <input type="text" class="form-control" name="ket_sltravel" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Sirine Long Travel <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="sirinelt" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="sirinelt" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="sirinelt" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Sirine Long Travel</label>
                            <input type="text" class="form-control" name="ket_sirinelt" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake Long Travel Saat Tidak Membawa Beban <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="brakeno" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="brakeno" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="brakeno" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Brake Long Travel Saat Tidak Membawa Beban</label>
                            <input type="text" class="form-control" name="ket_brakeno" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake Long Travel Saat Membawa Beban <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="brakeya" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="brakeya" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="brakeya" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Brake Long Travel Saat Membawa Beban</label>
                            <input type="text" class="form-control" name="ket_brakeya" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake Cross Travel Saat Tidak Membawa Beban <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="bcno" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="bcno" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="bcno" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Brake Cross Travel Saat Tidak Membawa Beban</label>
                            <input type="text" class="form-control" name="ket_bcno" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake Cross Travel Saat Membawa Beban <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="bcya" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="bcya" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="bcya" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Brake Cross Travel Saat Membawa Beban</label>
                            <input type="text" class="form-control" name="ket_bcya" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake Up-Down Saat Tidak Membawa Beban <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="updno" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="updno" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="updno" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Brake Up-Down Saat Tidak Membawa Beban</label>
                            <input type="text" class="form-control" name="ket_updno" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake Up-Down saat Membawa Beban <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="updya" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="updya" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="updya" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Brake Up-Down saat Membawa Beban</label>
                            <input type="text" class="form-control" name="ket_updya" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Cable/roda Roller untuk Cross Travel <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="crcros" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="crcros" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="crcros" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Cable/roda Roller untuk Cross Travel</label>
                            <input type="text" class="form-control" name="ket_crcros" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1">CATATAN</label>
                            <input type="text" class="form-control" name="catatan" id="exampleInputPassword1" placeholder="Masukan catatan jika ada">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama MTC yang bertugas<small style="color: red;">*</small></label>
                            <input type="text" class="form-control" name="mtc" id="exampleInputPassword1" placeholder="Masukan MTC ">
                        </div>
                        
                    </div>
                </div>

                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    
            </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection