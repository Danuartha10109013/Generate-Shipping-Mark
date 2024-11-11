@extends('Packing-List.layout.main')

@section('title')
    Add New GM ||
    @if(Auth::user()->role == 0)
        Admin
    @elseif(Auth::user()->role == 1)
        Pegawai
    @else
        Unknown
    @endif
@endsection

@section('content')
<div class="container">
    <h2>Add New Product GM</h2>
    <form action="{{route('Packing-List.admin.gm.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" name="kode" class="form-control" id="kode" placeholder="Enter product code" required>
        </div>

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Enter product name" required>
        </div>

        <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="text" name="qty" class="form-control" id="qty" placeholder="Enter quantity" required>
        </div>

        <div class="form-group">
            <label for="panjang">Panjang</label>
            <input type="text" name="panjang" class="form-control" id="panjang" placeholder="Enter panjang" required>
        </div>

        <div class="form-group">
            <label for="attribute">Attribute</label>
            <input type="text" name="attribute" class="form-control" id="attribute" placeholder="Enter product attribute" required>
        </div>

        <div class="form-group">
            <label for="storage_bin">Storage Bin</label>
            <input type="text" name="storage_bin" class="form-control" id="storage_bin" placeholder="Enter storage bin" required>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" id="date" required>
        </div>

        <div class="form-group">
            <label for="satuan">Satuan</label>
            <select type="text" name="uom" class="form-control" id="satuan" required>
                <option value="" selected disabled>--Pilih Satuan Berat--</option>
                <option value="kg">KG</option>
                <option value="mt">MT</option>
                <option value="lbs">LBS</option>
            </select>
        </div>
        

        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="number" name="user_id" class="form-control" id="user_id" placeholder="Enter your user ID" value="{{ Auth::user()->id }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
@endsection
