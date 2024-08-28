@extends('layout')
@section('page-title', 'Dashboard')
@section('page-content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-semibold">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <div class="avatar-sm mx-auto mb-4">
                        <span class="avatar-title rounded-circle bg-light font-size-24">
                            <i class="mdi mdi-cash-multiple text-primary"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <p class="text-muted text-uppercase fw-semibold font-size-13">Total Revenue</p>
                    <h4 class="mb-1 mt-1">$<span class="counter-value" data-target="58425">0</span></h4>
                </div>
                <p class="text-muted mt-3 mb-0"><span class="badge bg-success-subtle text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>2.65%</span> since last week
                </p>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <div class="avatar-sm mx-auto mb-4">
                        <span class="avatar-title rounded-circle bg-light font-size-24">
                            <i class="mdi mdi-refresh-circle text-success"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <p class="text-muted text-uppercase fw-semibold font-size-13">Total Refunds</p>
                    <h4 class="mb-1 mt-1">$<span class="counter-value" data-target="2568">0</span></h4>
                </div>
                <p class="text-muted mt-3 mb-0"><span class="badge bg-danger-subtle text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>4.58%</span> since last week
                </p>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <div class="avatar-sm mx-auto mb-4">
                        <span class="avatar-title rounded-circle bg-light font-size-24">
                            <i class="mdi mdi-account-group text-primary"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <p class="text-muted text-uppercase fw-semibold font-size-13">Active Users</p>
                    <h4 class="mb-1 mt-1"><span class="counter-value" data-target="258410">0</span></h4>
                </div>
                <p class="text-muted mt-3 mb-0"><span class="badge bg-success-subtle text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>14.33%</span> since last week
                </p>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <div class="avatar-sm mx-auto mb-4">
                        <span class="avatar-title rounded-circle bg-light font-size-24">
                            <i class="mdi mdi-cart-check text-success"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <p class="text-muted text-uppercase fw-semibold font-size-13">All Time Orders</p>
                    <h4 class="mb-1 mt-1"><span class="counter-value" data-target="9582">0</span></h4>
                </div>
                <p class="text-muted mt-3 mb-0"><span class="badge bg-warning-subtle text-warning me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>0.55%</span> since last week
                </p>
            </div>
        </div>
    </div> <!-- end col-->
</div> <!-- end row-->
@endsection