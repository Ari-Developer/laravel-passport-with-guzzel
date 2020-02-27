<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body> 

<div class="container">
  <h2>User Registration</h2>
  @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
  @endif
  <form name="frm" action="{{ route('user.registration.save') }}" method="post">
  {{ csrf_field() }}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Name :</label>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label>Email-id :</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Password :</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Confirm Password :</label>
                <input type="password" name="c_password" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create Account">
                <a href="{{ route('user.login') }}" class="btn btn-success">Login</a>
            </div>
        </div>
        <div class="col-md-6">
        @if(Session::has('error'))
            <div class="alert alert-danger">{!! Session::get('error') !!}</div>
        @endif
        </div>
    </div>
  </form>
</div>

</body>
</html>
