@extends('layout/main')

@section('title', 'Ubah Data Pemasok')

@section('content')

<h3><span class="glyphicon glyphicon-briefcase"></span>  Ubah Pemasok</h3>
<a class="btn" href="/pemasok"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<br><br>

<form method="post" action="/pemasok/{{ $b->id_p }}">
  <div class="col-md-8">
    @method('patch')
    @csrf
    <div class="form-group {{ $errors->has('nama_p') ? 'has-error' : '' }}">
    <label for="nama_p" class="form-label">Nama Pemasok</label>
      <input type="text" class="form-control @error('nama_p') is-invalid @enderror" id="nama_p" placeholder="Masukkan nama barang" name="nama_p" value="{{ $b->nama_p }}">
      @error('nama_p')
      <div class="invalid-feedback" style="color:red"> {{ $message }} </div>
      @enderror
    </div>
    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
    <label for="alamat" class="form-label">Alamat</label>
      <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" aria-describedby="basic-addon1" name="alamat" placeholder="5000" value="{{ $b->alamat }}">
      @error('alamat')
      <div class="invalid-feedback" style="color: red"> {{ $message }} </div>
      @enderror
    </div>
    <div class="form-group {{ $errors->has('no_telpon') ? 'has-error' : '' }}">
    <label for="no_telpon" class="form-label">No. Telpon</label>
      <input type="text" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telpon" aria-describedby="basic-addon1" name="no_telpon" placeholder="7500" value="{{ $b->no_telpon }}">
      @error('no_telpon')
      <div class="invalid-feedback" style="color: red"> {{ $message }} </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-info">Simpan</button>
  </div>
</form>
@endsection