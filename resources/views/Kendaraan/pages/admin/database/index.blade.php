@extends('Packing-List.layout.main')


@section('title')
    Open Packing ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Database</h4>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">
                <a href="{{ Auth::user()->role == 0 ? route('Packing-List.admin.database.add') : route('Packing-List.pegawai.database.add') }}" 
                   class="badge badge-gradient-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan Database </a>
                {{-- <a href="{{ route('Form-Check.admin.crane.export') }}" 
                   class="badge badge-gradient-success" style="text-decoration: none; font-size: 15px">Export Excel</a> --}}
                   <form class="ml-2" action="{{route('Packing-List.admin.database.store.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="excel">
                    <button type="submit" class="badge badge-gradient-success">Save</button>
                   </form>
            </div>
        
            <form action="{{ route('Packing-List.admin.database') }}" method="GET" class="ml-2" style="display: inline;">
              <input type="text" name="search" placeholder="Search By Attribute" class="form-control d-inline" style="width: auto;" value="{{ request('search') }}">
              <input type="hidden" name="sort" value="{{ request('sort') }}">
              <input type="hidden" name="direction" value="{{ request('direction') }}">
              <button type="submit" style="border: none; padding: 0; cursor: pointer;"> 
                  <label class="badge badge-gradient-danger" style="text-decoration: none;">Search</label>
              </button>
          </form>
          
        </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th> No </th>
                  <th> Kode </th>
                  <th> Nama Produk </th>
                  <th> QTY </th>
                  <th> UOM </th>
                  <th> No Coil </th>
                  <th> Storage Bin </th>
                  <th> 
                    <a href="{{ route('Packing-List.admin.database', [
                        'sort' => 'date', 
                        'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 
                        'search' => request('search')  // Use request('search') directly here
                    ]) }}">
                        tanggal <i class="fa-solid fa-arrows-up-down"></i>
                        @if ($sort === 'date')
                            <i class="fa fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>  
                </th>
                
                  <th> Action </th>
                  <th> Pengirim </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$d->kode}} </td>
                    <td> {{$d->nama_produk}} </td>
                    <td> {{$d->qty}} </td>
                    <td> {{$d->uom}} </td>
                    <td>{{$d->attribute}}</td>
                    <td>{{$d->storage_bin}}</td>
                    <td>{{$d->date}}</td>
                    <td><a href="{{route('Packing-List.admin.database.edit',$d->id)}}">
                      <label class="badge badge-gradient-primary">
                        <i class="fas fa-edit"></i> Edit
                      </label></a>
                      <a href="{{route('Packing-List.admin.database.destroy',$d->id)}}">
                      <label class="badge badge-gradient-danger">
                        <i class="fas fa-trash"></i> delete
                      </label></a>
                      
                    </td>
                    <td>
                      @php
                        $name = \App\Models\User::where('id',$d->user_id)->value('name');
                      @endphp
                      {{$name}} 
                    </td>

                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
          </div>
                
                <div class="container">
                    <h2> Clear All Data ?</h2>
                    <p>Are you sure you want to clear all data? This action cannot be undone.</p>
                
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> This will remove all records permanently!
                    </div>
                
                    <form action="{{ route('Packing-List.admin.database.clear') }}" method="POST">
                        @csrf
                        @method('DELETE') <!-- Use DELETE method for destructive actions -->
                
                        <button type="submit" class="btn btn-danger">Yes, Clear All Data</button>
                    </form>
                </div>
        </div>
      </div>
    </div>
  </div>
@endsection