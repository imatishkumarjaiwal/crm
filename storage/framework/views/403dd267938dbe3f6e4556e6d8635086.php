<!doctype html>
<html lang="en">
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
            <div class="container" style="max-width: 1420px;">
                <div class="row justify-content-start">
                    <div class="col-md-4">
                        <div class="card overflow-hidden shadow border border-info">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="p-lg-4 p-2">
                                        <div class="text-center">
                                            <h5>Register account</h5>
                                            <p class="text-muted">Get your free Samply account now.</p>
                                        </div>
                                        <div class="mt-4 pt-3">
                                            <form action="<?php echo e(url('/signup')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="mb-3">
                                                    <label for="username" class="fw-semibold">Username</label>
                                                    <input type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="username" name="username" placeholder="Enter username">
                                                </div>
                                                <div class="mb-3 mb-4">
                                                    <label for="password" class="fw-semibold">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-12">
                                                        <div class="text-end">
                                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Register</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="text-center mt-4">
                                            <p>Already have an account ? <a href="<?php echo e(url('/')); ?>" class="fw-semibold text-decoration-underline"> Login </a> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
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
</html>
<?php /**PATH C:\xampp\htdocs\crm\resources\views/register.blade.php ENDPATH**/ ?>