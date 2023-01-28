<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
						<strong>Login Admin Toko</strong>
					</div>
					<div class="card-body">
						<div class="alert alert-{{ $respon['status'] }}" role="alert">
							{{ $respon['pesan'] }}
						</div>
						<a href="#" data-toggle="modal" data-target="#lupaPassword">Kirim ulang</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="lupaPassword">
		<form action="{{ route('tokoku.lupas') }}" method="post">
		@csrf
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Lupa Password</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <div class="form-group">
		        	<label>Email</label>
		        	<input type="email" name="email" placeholder="example@example.com" class="form-control" required>
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-success">Reset</button>
		      </div>
		    </div>
		  </div>
	  	</form>
	</div>

</body>
</html>