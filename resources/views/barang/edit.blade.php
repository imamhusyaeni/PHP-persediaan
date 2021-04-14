@extends('layout/main')

@section('title', 'Ubah Data Barang / Tambah Stok')

@section('content')

<h3><span class="glyphicon glyphicon-briefcase"></span>  Ubah Data Barang / Tambah Stok</h3>
<a class="btn" href="/barang"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<br><br>

<form method="post" action="/barang/{{ $b->id_b }}">
  <div class="col-md-8">
    @method('patch')
    @csrf
    <div class="form-group {{ $errors->has('nama_b') ? 'has-error' : '' }}">
    <label for="nama_b" class="form-label">Nama Barang</label>
      <input type="text" class="form-control @error('nama_b') is-invalid @enderror" id="nama_b" placeholder="Nama Barang ..." name="nama_b" value="{{ $b->nama_b }}">
      @error('nama_b')
      <div class="invalid-feedback" style="color: red"> {{ $message }} </div>
      @enderror
    </div>
    <div class="form-group {{ $errors->has('brand') ? 'has-error' : '' }}">
    <label for="brand" class="form-label">Brand</label>
      <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" placeholder="Brand ..." value="{{ $b->brand }}">
      @error('brand')
      <div class="invalid-feedback" style="color: red"> {{ $message }} </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="pemasok" class="form-label">Pemasok</label>								
      <select class="form-control" name="pemasok" id="pemasok">
        @foreach ($pemasok as $p)
        <option value="{{ $p->nama_p }}">{{ $p->nama_p }}</option>
        @endforeach	
      </select>
    </div>
    <div class="form-group">
      <label class="form-label">Stok Awal Barang</label>
      <input name="jumlah" type="text" readonly class="form-control" value="{{ $b->jumlah }}">
    </div> 
    <div class="form-group">
      <label for="tambah" class="form-label">Barang Masuk</label>
      <input name="tambah" id="tambah" type="number" class="form-control">
    </div>
    <div class="form-group {{ $errors->has('tgl_m') ? 'has-error' : '' }}">
    <label for="tgl" class="form-label">Tanggal Barang Masuk</label>
      <input type="text" class="form-control @error('tgl_m') is-invalid @enderror" id="tgl" name="tgl_m" value="{{ \Carbon\Carbon::parse($b->tgl_m)->format('d-m-Y')}}" autocomplete="off">
      @error('tgl_m')
      <div class="invalid-feedback" style="color: red"> {{ $message }} </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-info">Simpan</button>
  </div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#tgl").datepicker({dateFormat : 'dd-mm-yy'});							
	});
</script>
@endsection