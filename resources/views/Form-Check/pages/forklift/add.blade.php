@extends('Form-Check.layout.main')
@section('title')
    Form Submission Forklift
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
          </span> Add Submission Forklift
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
                <h4 class="card-title">From Daily Checklist Forklift</h4>
                <p class="card-description"> FORMULIR FORKLIFT <br>
                    PENGISIAN FORMULIR DILAKUKAN AWAL SHIFT/SEBELUM DIGUNAKAN </p>
            @if (Auth::user()->role == 0)
            <form action="{{route('Form-Check.admin.forklift.create')}}" method="POST">
            @else
            <form action="{{route('Form-Check.pegawai.forklift.create')}}" method="POST">
            @endif
                @method('POST')
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputUsername1">NAMA OPERATOR CHEKLIST FORKLIFT</label>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->name }}" readonly>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NAMA SHIFT LEADER BERTUGAS</label>
                        <input type="text" class="form-control" name="shift_leader" id="exampleInputUsername1" required>
                      </div>
                    <div class="form-group">
                        <label for="label">NO/TYPE FORKLIFT
                        </label>
                        <select class="form-control" name="jenis_forklift" id="exampleSelectOption" required>
                            <option value="5 Ton No.3 (EUP)" {{ old('jenis_forklift') == '5 Ton No.3 (EUP)' ? 'selected' : '' }}>5 Ton No.3 (EUP)</option>
                            <option value="5 Ton No.4 (STUFING EXPORT)" {{ old('jenis_forklift') == '5 Ton No.4 (STUFING EXPORT)' ? 'selected' : '' }}>5 Ton No.4 (STUFING EXPORT)</option>
                            <option value="5 Ton No.5 (DELIVERY L3)" {{ old('jenis_forklift') == '5 Ton No.5 (DELIVERY L3)' ? 'selected' : '' }}>5 Ton No.5 (DELIVERY L3)</option>
                            <option value="5 Ton No.6 (PACKING EXPORT)" {{ old('jenis_forklift') == '5 Ton No.6 (PACKING EXPORT)' ? 'selected' : '' }}>5 Ton No.6 (PACKING EXPORT)</option>
                            <option value="10 Ton" {{ old('jenis_forklift') == '10 Ton' ? 'selected' : '' }}>10 Ton</option>
                            <option value="23 Ton" {{ old('jenis_forklift') == '23 Ton' ? 'selected' : '' }}>23 Ton</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label">SHIFT
                        </label>
                        <select class="form-control" name="shift" id="exampleSelectOption" required>
                            <option value="1" {{ old('shift') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('shift') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('shift') == '3' ? 'selected' : '' }}>3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hari / Tanggal</label>
                        <input type="Date" class="form-control" name="date" id="exampleInputEmail1" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jam Checklist Forklift</label>
                        <input type="time" class="form-control" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                      </div>
                </div>
                <p class="card-description"> JIKA KETERANGAN (X,O) HARAP SEGERA INFORMASI KE MAINTENANCE  </p>
                <p>KETERANGAN: <br>
                    <b>V</b>: KONDISI BAIK <br>
                    <b>X</b>: KONDISI TIDAK BAIK DAN FORKLIFT TIDAK BISA DIGUNAKAN <br>
                    <b>O</b>: KONDISI TIDAK BAIK NAMUN MASIH BISA DIGUNAKAN</p>
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                Pengecekan Hour Meter <br>
                                 
                                <b>AWAL SHIFT</b> <br>
                                KETERANGAN: <br>
                                <b>ISI DENGAN HOUR METER SEBELUM DIGUNAKAN</b>
                            </label>
                            <input type="text" class="form-control" name="awal" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                Keterangan Pengecekan Hour Meter 
                                 
                            </label>
                            <input type="text" class="form-control" name="ket_awal" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Horn <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="horn" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="horn" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="horn" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Horn</label>
                            <input type="text" class="form-control" name="ket_horn" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Alarm Mundur <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="mundur" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="mundur" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="mundur" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Alarm Mundur</label>
                            <input type="text" class="form-control" name="ket_mundur" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Lampu Sein <br>
                                <b>MENYALA</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="sein" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="sein" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="sein" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Lampu Sein</label>
                            <input type="text" class="form-control" name="ket_sein" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Lampu Rotating <br>
                                <b>ADA DAN MENYALA</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="rotating" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="rotating" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="rotating" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Lampu Rotating</label>
                            <input type="text" class="form-control" name="ket_rotating" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Lampu Stop <br>
                                <b>MENYALA KANAN DAN KIRI</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="stop" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="stop" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="stop" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Lampu Stop</label>
                            <input type="text" class="form-control" name="ket_stop" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Lampu Utama <br>
                                <b>MENYALA KANAN DAN KIRI</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="utama" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="utama" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="utama" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label for="exampleInputPassword1">Pengecekan Pengecekan Lampu Utama</label>
                            <input type="text" class="form-control" name="ket_utama" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Battery Connector <br>
                                <b>KONTEKTOR HARUS KENCANG</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="connector" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="connector" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="connector" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Battery Connector</label>
                            <input type="text" class="form-control" name="ket_connector" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Level Air Accu (H/L) <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="accu" id="startX" value="h" {{ old('accu') == 'h' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    H
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="accu" id="startV" value="l" {{ old('accu') == 'l' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    L
                                </label>
                            </div>
                            
                        </div>                       
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Level Air Accu (H/L)</label>
                            <input type="text" class="form-control" name="ket_accu" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Brake Parking<br>
                                <b>LEVEL HARUS DIATAS L</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="parking" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="parking" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="parking" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Brake Parking</label>
                            <input type="text" class="form-control" name="ket_parking" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Brake <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="brake" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="brake" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="brake" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Brake</label>
                            <input type="text" class="form-control" name="ket_brake" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="exampleInputPassword1">
                                    Pengecekan Hour Meter <br>
                                     
                                    <b>AKHIR SHIFT</b> <br>
                                    KETERANGAN: <br>
                                    <b>ISI DENGAN HOUR METER SETEAH DIGUNAKAN</b>
                                </label>
                                <input type="text" class="form-control" name="akhir" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">
                                    Keterangan Pengecekan Hour Meter <b>Akhir</b>
                                     
                                </label>
                                <input type="text" class="form-control" name="ket_akhir" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                            </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Engine Oil Level (H/L) <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="oil" id="startX" value="h" {{ old('start') == 'h' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    H
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="oil" id="startV" value="l" {{ old('start') == 'l' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    L
                                </label>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Engine Oil Level (H/L)</label>
                            <input type="text" class="form-control" name="ket_oil" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Hydraulic Oil Level (H/L) <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="raulic" id="startX" value="h" {{ old('start') == 'h' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    H
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="raulic" id="startV" value="l" {{ old('raulic') == 'l' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    L
                                </label>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Hydraulic Oil Level (H/L)</label>
                            <input type="text" class="form-control" name="ket_raulic" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Grease di Chain <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="chain" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="chain" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="chain" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Grease di Chain</label>
                            <input type="text" class="form-control" name="ket_chain" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Kebocoran Oli (All Hose) <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="allhose" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="allhose" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="allhose" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Kebocoran Oli (All Hose)</label>
                            <input type="text" class="form-control" name="ket_allhose" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Power Steering <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="steering" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="steering" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="steering" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Power Steering</label>
                            <input type="text" class="form-control" name="ket_steering" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Kondisi Belts Engine <br>
                                <b>TIDAK ADA YANG RETAK/PUTUS</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="belts" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="belts" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="belts" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Kondisi Belts Engine</label>
                            <input type="text" class="form-control" name="ket_belts" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Level Cooland (H/L) <br>
                                <b>LEVEL HARUS DIATAS L</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="cooland" id="startX" value="h" {{ old('start') == 'h' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    H
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="cooland" id="startV" value="l" {{ old('start') == 'l' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    L
                                </label>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Level Cooland (H/L)</label>
                            <input type="text" class="form-control" name="ket_cooland" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Level Oli Transmisi (H/L) <br>
                                <b>LEVEL HARUS DIATAS L</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="transmisi" id="startX" value="h" {{ old('start') == 'h' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    H
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="transmisi" id="startV" value="l" {{ old('start') == 'l' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    L
                                </label>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Level Oli Transmisi (H/L)</label>
                            <input type="text" class="form-control" name="ket_transmisi" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Kondisi Ban <br>
                                <b>MASIH TERDAPAT KEMBANGAN DAN TIDAK RETAK</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="ban" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ban" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ban" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Cable/roda Roller untuk Cross Travel</label>
                            <input type="text" class="form-control" name="ket_ban" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Hydraulic Fork <br>
                                <b>MASIH TERDAPAT KEMBANGAN DAN TIDAK RETAK</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="fork" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="fork" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="fork" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Hydraulic Fork</label>
                            <input type="text" class="form-control" name="ket_fork" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pengecekan Tekanan Ban (Forklift 25 Ton) <br>
                                <b>900 KPA (KGF/CM2)</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="teba" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="teba" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="teba" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Tekanan Ban (Forklift 25 Ton)</label>
                            <input type="text" class="form-control" name="ket_teba" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1">CATATAN</label>
                            <input type="text" class="form-control" name="catatan" id="exampleInputPassword1" placeholder="Masukan catatan jika ada">
                        </div>
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                NAMA MTC YANG BERTUGAS <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="mtc" id="startX" value="x" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    X
                                </label>
                            </div>

                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="mtc" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
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