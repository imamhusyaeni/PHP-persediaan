<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="/assets/js/jquery.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="/assets/js/jquery-ui/jquery-ui.js"></script>
	<link rel="shortcut icon" href="/assets/logo.png"/>

	<title>@yield('title')</title>
</head>

<body>
	<div class="container-fluid">
		<div class="navbar navbar-default">
			<div class="container-fluid" style="background-color: #17ba9c">
				<div class="navbar-header">
					<a style="color: white" href="{{ url('/dashboard') }}" class="navbar-brand">Klinik Beauty Facial Care By WN Family</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a style="color: white" id="notif" href="#" data-toggle="modal" data-target="#modalnotif"><span class='glyphicon glyphicon-bell'></span></a></li>
						<li><a style="color: red; display: none" id="notif1" href="#" data-toggle="modal" data-target="#modalnotif"><span class='glyphicon glyphicon-exclamation-sign'></span></a></li>
						<li>
							<a style="color: white" class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Hy , {{ auth()->user()->name }} <span class="glyphicon glyphicon-user"></span></a>
							<ul class="dropdown-menu">
								<li role="separator" class="divider"></li>
								<li><a style="color: #17ba9c" href="/gantipassword"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
								<li role="separator" class="divider"></li>
								<li><a style="color: #17ba9c" href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>

				<!-- modal input -->
			<div id="modalnotif" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Pesan Pemberitahuan</h4>
						</div>
						<div class="modal-body" id="pesan">
							@foreach ($barang as $b)
							<?php 
							if ($b->jumlah <= 10) {
								echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-exclamation-sign'></span> Stok  <a style='color:rgba(255, 0, 0, 0.897)'>" . $b->nama_b . "</a> tersisa " . $b->jumlah . ". silahkan pesan lagi !!</div>
								<script>
								$(document).ready(function() {
										$('#notif').hide();
										$('#notif1').show();
									});
								</script>";
							}
							?>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-2">
			<div class="row">
				<div class="col-xs-6 col-md-12">
					<a class="thumbnail">
						<img class="img-responsive" src="/assets/logo.png">
					</a>
				</div>
			</div>

			<style type="text/css">
				.nav-pills>li.active>a,
				.nav-pills>li.active>a:hover,
				.nav-pills>li.active>a:focus {
					background-color: #17ba9c !important;
				}
			</style>

			<div class="row"></div>
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="{{ url('/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
				<li><a style="color: #17ba9c" href="{{ url('/pemasok') }}"><span class="glyphicon glyphicon-pencil"></span> Data Pemasok</a></li>
				<li><a style="color: #17ba9c" href="{{ url('/barang') }}"><span class="glyphicon glyphicon-briefcase"></span> Data Barang</a></li>
				<li><a style="color: #17ba9c" href="{{ url('/barangkeluar') }}"><span class="glyphicon glyphicon-picture"></span> Barang Keluar</a></li>
				{{-- <li><a style="color: #17ba9c" href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
				<li><a style="color: #17ba9c" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> --}}
			</ul>
		</div>

		<div class="col-md-10">
			@yield('content')
		</div>
	</div>

</body>
</html>



