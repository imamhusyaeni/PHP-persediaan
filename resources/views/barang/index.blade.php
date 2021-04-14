@extends('layout/main')

@section('title', 'Data Barang')

@section('content')
<script src="/assets/js/script/barang.js"></script>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Barang</button>


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
	
	{{-- <a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak Semua Barang</a>
	<a style="margin-bottom:10px" href="lap_barang_min.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak Stok Barang <= 20</a> --}}
</div>

<style>
	#tabel {
		text-align: center;
	}
	#tabel th{
		text-align: center;
	}
</style>

<section id="tabel">
	@include('barang.tabel')
</section>
	
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#17ba9c;color:#fff">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Data Stok Barang</h4>
			</div>
			
			<div class="modal-body">
				<form action="/barang" method="post" id="main_form">
					@csrf
					<div class="form-group {{ $errors->has('nama_b') ? 'has-error' : '' }}" >
						<label>Nama Barang</label>
						<input name="nama_b" type="text" class="form-control" placeholder="Nama Barang ..." @error('nama_b') is-invalid @enderror" value="{{ old('nama_b') }}">
						<span class="text-danger error-text nama_b_error"></span>
						{{-- @error('nama_b')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
					</div>
					<div class="form-group {{ $errors->has('brand') ? 'has-error' : '' }}" >
						<label>Brand</label>
						<input name="brand" type="text" class="form-control" placeholder="Brand ..." @error('brand') is-invalid @enderror" value="{{ old('brand') }}">
						<span class="text-danger error-text brand_error"></span>
						{{-- @error('brand')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
					</div>	
					<div class="form-group">
						<label>Pemasok</label>								
						<select class="form-control" name="pemasok">
							@foreach ($pemasok as $p)
							<option value="{{ $p->nama_p }}">{{ $p->nama_p }}</option>
							@endforeach	
						</select>
					</div>
					<div class="form-group {{ $errors->has('jumlah') ? 'has-error' : '' }}" >
						<label>Jumlah</label>
						<input name="jumlah" type="number" class="form-control" placeholder="Jumlah ..." @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}">
						<span class="text-danger error-text jumlah_error"></span>
						{{-- @error('jumlah')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
					</div>
					<div class="form-group {{ $errors->has('tgl_m') ? 'has-error' : '' }}">
						<label>Tanggal Masuk</label>
						<input name="tgl_m" type="text" class="form-control" id="tgl" placeholder="Tanggal Barang Masuk .." @error('tgl_m') is-invalid @enderror" value="{{ old('tgl_m') }}" autocomplete="off">
						<span class="text-danger error-text tgl_m_error"></span>
						{{-- @error('tgl_m')
						<div class="invalid-feedback" style="color: red"> {{ $message }} </div>
						@enderror --}}
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

<script type="text/javascript">
	$(document).ready(function(){
		$("#tgl").datepicker({dateFormat : 'dd/mm/yy'});							
	});
</script>
@endsection