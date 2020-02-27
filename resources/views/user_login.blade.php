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
  <h2>User Login</h2>
  @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
  @endif
  @if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
  @endif
  
    <div class="row">
        <div class="col-md-4">
            <h4>Normal Way</h4>
            <form name="frm" action="{{ route('user.login.process') }}" method="post">
            {{ csrf_field() }}
              <div class="form-group">
                  <label>Email-id :</label>
                  <input type="email" name="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                  <label>Password :</label>
                  <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Login">
                  <a href="{{ route('user.registration') }}" class="btn btn-success">Create Account</a>
              </div>
            </form>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
          <h4>Way2 - Grant type password</h4>
          <form name="frm" action="{{ route('user.login.granttype') }}" method="post">
            {{ csrf_field() }}
              <div class="form-group">
                  <label>Email-id :</label>
                  <input type="email" name="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                  <label>Password :</label>
                  <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Login">
                  <a href="{{ route('user.registration') }}" class="btn btn-success">Create Account</a>
              </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
