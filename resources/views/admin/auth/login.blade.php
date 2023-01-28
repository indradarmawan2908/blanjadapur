<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

	<style type="text/css">
	body { 
		background-color: #F9F9F9;
	}

	.container{
		margin-top: 5%;
	}

	.card-header {
        padding: 5px 15px;
	}

    .profile-img {
        width: 96px;
		height: 96px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }
	</style>
</head>
<body>

	<div class="">
		<div class="container d-flex justify-content-center">
			<div class="row">
				<div class="card">
					<div class="card-header">
						<strong>Login Admin</strong>
					</div>
					<div class="card-body">
						<form name="login" id="login" method="post" action="{{ route('admin.index') }}">
						@csrf
							<div class="row">
								<div class="col">
									<span class="profile-img">
										<i class='fas fa-user-circle' style='font-size:120px'></i>
									</span>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<hr> <!-- other content  -->
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class='fas fa-user-shield'></i>
												</span>
											</div>
											<input class="form-control" placeholder="Username" id="username" name="username" type="text" autofocus>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class='fas fa-user-secret'></i>
												</span>
											</div>
											<input class="form-control" placeholder="Password" id="loginPassword" name="password" type="password">
										</div>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-sm btn-success btn-block submit" id="login_m"  value="Login">
									</div>
								</div>
							</div>
						<!-- <a href="#" onClick="">I forgot my password!</a> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>