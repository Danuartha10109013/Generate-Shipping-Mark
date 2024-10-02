@extends('Form-Check.layout.main')
@section('title')
    Form Forklift
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
          </span> Form forklift
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>
      @if (Auth::user()->role == 0)
      <a href="{{ route('Form-Check.admin.forklift.add') }}" class="badge badge-gradient-primary mb-3" style="text-decoration: none; font-size: 15px">Tambahkan response</a>
      @else
      <a href="{{ route('Form-Check.pegawai.forklift.add') }}" class="badge badge-gradient-primary mb-3" style="text-decoration: none; font-size: 15px">Tambahkan response</a>
      @endif
      <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Recent Response</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> No </th>
                        <th> NO TRAILER/DRIVER </th>
                        <th> Responden </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                      <tr>
                        <td>
                          {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                        </td>
                        <td> {{ $d->jenis_forklift }} </td>
                        <td>
                            @php
                                $nama = \App\Models\User::where('id', $d->user_id)->value('name');
                            @endphp
                            {{ $nama }}
                        </td>
                        
                        <td>
                          <div class="d-flex justify-content-start align-items-center">
                              @if (Auth::user()->role == 0)
                                  <a href="{{ route('Form-Check.admin.forklift.print', $d->id) }}">
                                      <label class="badge badge-gradient-success">Print</label>
                                  </a>
                                  <form action="{{ route('Form-Check.admin.forklift.destroy', $d->id) }}" method="POST" class="ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="badge badge-gradient-danger">Hapus</button>
                                </form>
                              @else
                                  <a href="{{ route('Form-Check.pegawai.forklift.print', $d->id) }}">
                                      <label class="badge badge-gradient-success">Print</label>
                                  </a>
                              @endif
                             
                          </div>
                      </td>
                      
                      
                      
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <!-- Pagination Links -->
                  {{ $data->links() }}
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
