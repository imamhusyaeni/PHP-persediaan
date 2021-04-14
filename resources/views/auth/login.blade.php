<!DOCTYPE html>
<html>
<head>
	<title>Klinik Beauty Facial Care By WN Family</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="/assets/js/jquery.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="/assets/js/jquery-ui/jquery-ui.js"></script>
	{{-- <?php include 'admin/config.php'; ?> --}}
	<style type="text/css">
	.kotak{	
		margin-top: 150px;
	}

	.kotak .input-group{
		margin-bottom: 20px;
	}
	</style>
</head>
<body>	
	<div class="container">

		@if (session('status'))
			<div style='margin-bottom:-55px; text-align: center;' class='alert alert-danger' role='alert'>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<span class='glyphicon glyphicon-exclamation-sign'></span>  {{ session('status') }}
			</div>
    @endif

		<div class="panel panel-default">
			<form action="/login" method="post">
				@csrf
				<div class="col-md-4 col-md-offset-4 kotak">
					<h3>Silahkan Login ...</h3>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" placeholder="Username" name="name">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" class="form-control" placeholder="Password" name="password">
					</div>
					<div class="input-group">			
						<input type="submit" class="btn btn-primary" value="Login">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>