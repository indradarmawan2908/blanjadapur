<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>{{ $title }}</title>
  </head>
  <body>

    <div class="container mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <strong>Reset Password</strong>
            </div>
            <div class="card-body">
              @if($respon['status'] == 200)
                <form action="{{ route('tokoku.reset') }}" method="post">
                  @csrf
                  <input type="hidden" name="s" value="{{ Request()->get('s') }}">
                  <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="rePassword" class="form-control" required>
                    <p class="text-help"></p>
                  </div>
                  <button type="submit" class="btn btn-success">Reset</button>
                </form>
              @else
                Link tidak aktif
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
      $('#rePassword').keyup(function(){
          //Store the field objects into variables ...
          var password = $('#password');
          var confirm  = $(this);
          
          if(password.val() == confirm.val()){
            confirm.next('p').addClass('text-success');
            confirm.next('p').removeClass('text-danger');
            confirm.next('p').text('Password cocok');
          }else {
            confirm.next('p').addClass('text-danger');
            confirm.next('p').removeClass('text-success');
            confirm.next('p').text('Password tidak cocok');
          }
      });
    </script>
  </body>
</html>