@extends('layout/main')

@section('title', 'Data Pemasok')

@section('content')
<script src="/assets/js/script/pemasok.js"></script>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Pemasok</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Pemasok</button>

@if (session('status'))
	<div class="col-md-4 col-md-offset-2">
    <div class="alert alert-success" style="margin-top:-20px; text-align: center">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
      {{ session('status') }}
    </div>
	</div>
	@endif
<br><br><br>

<div class="col-md-12">
	<div class="col-md-5">
		<div class="form-group">
			<div class="input-group" style="margin-left:-7%">
				<input type="text" id="search" class="form-control"   placeholder="masukkan nama pemasok..." style="border-right: none">
				<div class="input-group-addon" style="background: white; border-left: none"><span class="glyphicon glyphicon-search"></span></div>
			</div>
		</div>
	</div>
	{{-- <a style="margin-bottom:10px" href="lap_pemasok.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a> --}}
</div>
<br>

<style>
	#tabel {
		text-align: center;
	}
	#tabel th{
		text-align: center;
	}
</style>

<section id="tabel">
	@include('pemasok.tabel')
</section>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#17ba9c;color:#fff">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Pemasok  </h4>
			</div>

			<div class="modal-body">
				<form action="/pemasok" method="post" id="main_form">
					@csrf
					<div class="form-group {{ $errors->has('nama_p') ? 'has-error' : '' }}" >
						<label>Nama Pemasok</label>
						<input name="nama_p" type="text" class="form-control" placeholder="Nama Pemasok ..." @error('nama_p') is-invalid @enderror" value="{{ old('nama_p') }}">
						<span class="text-danger error-text nama_p_error"></span>
						{{-- @error('nama_p')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
					</div>
					<div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}" >
						<label>Alamat</label>
						<input name="alamat" type="text" class="form-control" placeholder="Alamat ..." @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
						{{-- @error('alamat')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
						<span class="text-danger error-text alamat_error"></span>
					</div>
					<div class="form-group {{ $errors->has('no_telpon') ? 'has-error' : '' }}" >
						<label>No Telpon</label>
						<input name="no_telpon" type="tel" class="form-control" placeholder="No Telpon ..." @error('no_telpon') is-invalid @enderror" value="{{ old('no_telpon') }}">
						{{-- @error('no_telpon')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
						<span class="text-danger error-text no_telpon_error"></span>
					</div>																
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>

			</form>

		</div>
	</div>
</div>
@endsection