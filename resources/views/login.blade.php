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

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        <div class="account-pages">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        @if(session('USER_LOGIN'))
                            <h1>Welcome, {{ session('USER_NAME') }}</h1>
                            <p>Your user ID is: {{ session('USER_ID') }}</p>
                        @else
                            <p>You are not logged in.</p>
                        @endif


                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif
                        <div class="card overflow-hidden shadow border border-info">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="p-lg-5 p-4">
                                        <div class="justify-content-center">
                                            <h5>Welcome Back Users Mahesh! ATISH</h5>
                                            <p class="text-muted">Sign in to continue to CRM.</p>
                                        </div>
                                    
                                        <div class="mt-4 pt-3">
                                            <form action="{{route('user.authentication')}}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="username" class="fw-semibold">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                                </div>
                        
                                                <div class="mb-3 mb-4">
                                                    <label for="password" class="fw-semibold">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                                </div>
    
                                                <div class="row align-items-center"> 
                                                    <div class="col-12">
                                                        <div class="text-end">
                                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                {{-- <div class="mt-4">
                                                    <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                                </div> --}}
                                            </form>
                                        </div>
                    
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- end card -->
                        <div class="mt-5 text-center">
                            <p>Don't have an account ? <a href="{{ url('/signup') }}" class="fw-semibold text-decoration-underline"> Sign Up </a> </p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end account page -->
        

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
