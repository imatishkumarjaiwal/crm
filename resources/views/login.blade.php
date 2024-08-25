<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Login | CRM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Pichforest" name="author" />
        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">
        <div class="account-pages">
            <div class="container" style="max-width: 1420px;">
                <div class="row justify-content-start">
                    <div class="col-md-4">
                        <div class="card overflow-hidden shadow border border-info">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="p-lg-4 p-2">
                                        <div class="text-center">
                                            <h5>Welcome Back!</h5>
                                            <p class="text-muted">Sign in to continue to CRM.</p>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                @foreach ($errors->all() as $error)
                                                    {{ $error }}
                                                @endforeach
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="mt-4 pt-3">
                                            <form action="{{ route('user.authentication') }}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="username" class="fw-semibold">Username</label>
                                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter username" value="{{ old('username') }}">
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 mb-4">
                                                    <label for="password" class="fw-semibold">Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password">
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-12">
                                                        <div class="text-end">
                                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- <div class="text-center mt-4">
                                            <p>Don't have an account? <a href="{{ url('/signup') }}" class="fw-semibold text-decoration-underline">Sign Up</a></p>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
