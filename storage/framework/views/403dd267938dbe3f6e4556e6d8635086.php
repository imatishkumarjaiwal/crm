<!doctype html>
<html lang="en">

    
<!-- Mirrored from www.preview.pichforest.com/samply/layouts/auth-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Jul 2024 03:41:40 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>Register | CRM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Pichforest" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                        <div class="card overflow-hidden shadow border border-info">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="p-lg-5 p-4">

                                        <div>
                                            <h5>Register account</h5>
                                            <p class="text-muted">Get your free Samply account now.</p>
                                        </div>
                                    
                                        <div class="mt-4 pt-3">
                                            <form action="<?php echo e(url('/signup')); ?>">
                                                <div class="mb-3">
                                                    <label class="fw-semibold" for="username">Username</label>
                                                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                                                </div>
                        
                                                <div class="mb-3">
                                                    <label class="fw-semibold" for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" placeholder="Enter password">        
                                                </div>
                        
                                                <div class="mt-4 text-end">
                                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                                </div>

                                            </form>
                                        </div>
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                        <div class="mt-5 text-center">
                            <p>Already have an account ? <a href="<?php echo e(url('/')); ?>" class="fw-semibold text-decoration-underline"> Login </a> </p>
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
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>

<!-- Mirrored from www.preview.pichforest.com/samply/layouts/auth-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Jul 2024 03:41:40 GMT -->
</html>
<?php /**PATH C:\xampp\htdocs\crm\resources\views/register.blade.php ENDPATH**/ ?>