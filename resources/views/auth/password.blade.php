@extends('layout/main')

@section('title', 'Ganti Password')

@section('content')

<h3><span class="glyphicon glyphicon-briefcase"></span>  Password</h3>
@if (session('status'))
	<div class="col-md-5 col-md-offset-3">
    <div class="alert alert-success" style="margin-top:-20px; text-align: center">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
      {{ session('status') }}
    </div>
	</div>
	@endif
<br><br><br>

@foreach ($errors->all() as $error)
  <p class="text-danger">{{ $error }}</p>
@endforeach 

<div class="col-md-5 col-md-offset-3">
	<form action="/gantipassword" method="post">
		@csrf
		<div class="form-group">
			<label>Password Lama</label>
			<input name="lama" type="password" class="form-control" placeholder="Password Lama ..">
		</div>
		<div class="form-group">
			<label>Password Baru</label>
			<input name="baru" type="password" class="form-control" placeholder="Password Baru ..">
		</div>
		<div class="form-group">
			<label>Ulangi Password</label>
			<input name="ulang" type="password" class="form-control" placeholder="Ulangi Password ..">
		</div>	
		<div class="form-group">
			<label></label>
			<input type="submit" class="btn btn-info" value="Simpan">
			<input type="reset" class="btn btn-danger" value="reset">
		</div>																	
	</form>
</div>
@endsection