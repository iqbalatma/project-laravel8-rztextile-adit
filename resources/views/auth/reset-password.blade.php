<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>{{ $title }}</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  @include('sweetalert::alert')
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                </div>
                <div class="card-body">
                  <x-alert></x-alert>

                  <div class="small mb-3 text-muted">Enter your new passowrd</div>
                  <form method="POST" action="{{ route('forgot.password.resetPassword') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="form-floating mb-3">
                      <input class="form-control" id="password" name="password" type="password" placeholder="Example : name@example.com" required />
                      <label for="password">New Password</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Example : name@example.com" required />
                      <label for="password_confirmation">Confirm New Passowrd</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                      <a class="small" href="{{ route('auth.login') }}">Return to login</a>
                      <button type="submit" class="btn btn-primary" href="login.html">Reset</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center py-3">
                  <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div id="layoutAuthentication_footer">
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2021</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/app-layout.js') }}"></script>

</body>

</html>