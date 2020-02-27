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
  <h2>User Account</h2>
  @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
  @endif
  @if(isset($userInfo) && !empty($userInfo))
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <td>Name:</td>
                    <td>{{ $userInfo->name }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $userInfo->email }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            <a href="{{ route('user.logout') }}" class="btn btn-danger pull-right">Logout</a>
        </div>
    </div>
  @endif
</div>

</body>
</html>
