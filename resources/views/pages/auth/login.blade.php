<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="{{ asset('/logo_tpp.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="{{ asset('/logo_tpp.png') }}" height="48" class='mb-4'>
                                {{-- <h3 class="text-start">Sign In</h3> --}}
                                <p>Please sign in to continue to Dashboard.</p>
                            </div>
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="username" name="username">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>

                                    </div>
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                        {{-- <a href="auth-forgot-password.html" class='float-end'>
                                            <small>Forgot password?</small>
                                        </a> --}}
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>

                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Submit</button>
                                </div>
                            </form>

                            </img>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="assets/js/feather-icons/feather.min.js"></script>
        <script src="assets/js/app.js"></script>

        <script src="assets/js/main.js"></script>
</body>

</html>
