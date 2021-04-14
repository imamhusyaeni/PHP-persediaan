@extends('layout/main')

@section('title', 'Barang Keluar')

@section('content')
<script src="/assets/js/script/barangkeluar.js"></script>

<h3><span class="glyphicon glyphicon-briefcase"></span> Data Barang Keluar</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Barang Keluar</button>

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
				<input type="text" id="search" class="form-control"   placeholder="masukkan nama barang..." style="border-right: none">
				<div class="input-group-addon" style="background: white; border-left: none"><span class="glyphicon glyphicon-search"></span></div>
			</div>
		</div>
	</div> 
	{{-- <a style="margin-bottom:10px" href="lap_keluar.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a> --}}
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
	@include('barangkeluar.tabel')
</section>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#17ba9c;color:#fff">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Data Barang Keluar
			</div>

			<div class="modal-body">				
				<form action="/barangkeluar" method="post" id="main_form">
					@csrf
					<div class="form-group">
						<label>Nama Barang - Stok</label>								
						<select class="form-control" name="nama_bk">
							@foreach ($barang as $b)
							<option value="{{ $b['nama_b'].'|'.$b['jumlah'] }}"> {{ $b['nama_b'].' - '.$b['jumlah'] }}</option>
							@endforeach	
						</select>
					</div>
					<div class="form-group {{ $errors->has('jumlah') ? 'has-error' : '' }}">
						<label>Jumlah Keluar</label>
						<input name="jumlah" type="number" class="form-control" placeholder="Jumlah Keluar ..." @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}">
						<span class="text-danger error-text jumlah_error"></span>
						{{-- @error('jumlah')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
					</div>
					<div class="form-group {{ $errors->has('tgl_k') ? 'has-error' : '' }}">
						<label>Tanggal Barang Keluar</label>
						<input name="tgl_k" type="text" class="form-control" id="tgl" placeholder="Tanggal Barang Keluar .." @error('tgl_k') is-invalid @enderror" value="{{ old('tgl_k') }}" autocomplete="off">
						<span class="text-danger error-text tgl_k_error"></span>
						{{-- @error('tgl_k')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
					</div>
					<div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
						<label>Keterangan</label>
						<textarea class="form-control"  name="keterangan" @error('keterangan') is-invalid @enderror></textarea>
						<span class="text-danger error-text keterangan_error"></span>
						{{-- @error('keterangan')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="reset" class="btn btn-danger" value="Reset">												
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>

			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#tgl").datepicker({dateFormat : 'dd-mm-yy'});							
	});
</script>
@endsection