<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Certiperu - Sistema Intranet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Intranet Certiperu Consultores"/>
        <meta name="author" content="Encore Digital"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.png" height="10" width="10">

        <link href="/assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <script src="/assets/js/head.js"></script>

    </head>
    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <!-- Start Begin page -->
        <div id="app-layout">
        <!-- Header Start -->            
    <?php include __DIR__ . '/layouts/header.php'; ?>
        <!-- Header End -->  
            <!-- Left Sidebar Start -->
    <?php include __DIR__ . '/layouts/sidebar.php'; ?>            
            <!-- Left Sidebar End -->
            
            <!-- -------------------------------------------------------------- -->
            <!-- Start Page Content here -->
            <!-- -------------------------------------------------------------- -->
        
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                            </div>
                        </div>

                        <!-- Start Main Widgets -->
                        <div class="row">
                            <div class="col-md-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget-first">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle bg-secondary-subtle p-2 me-2">
                                                    <iconify-icon icon="tabler:currency-dollar" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                                                </div>
                                                <p class="mb-0 text-dark fs-16">Total Revenue</p>
                                            </div>

                                            
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h3 class="fs-24 fw-medium text-dark mb-0 me-3">$50,457</h3>
                                                
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2 rounded-2 badge fs-12 badge-soft-success fw-medium">
                                                        <i class="mdi mdi-trending-up fs-14"></i> +1.31%
                                                    </span>
                                                    <p class="text-muted fs-14 mb-0 text-center">vs last month</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget-first">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle bg-primary-subtle p-2 me-2">
                                                    <iconify-icon icon="tabler:user-share" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                                                </div>
                                                <p class="mb-0 text-dark fs-16">New Leads Added</p>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <h3 class="fs-24 fw-medium text-dark mb-0 me-3">150</h3>

                                                <div class="d-flex align-items-center">
                                                    <span class="me-2 rounded-2 badge fs-12 badge-soft-danger fw-medium">
                                                        <i class="mdi mdi-trending-down fs-14"></i> -5.35%
                                                    </span>
                                                    <p class="text-muted fs-14 mb-0">vs last month</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget-first">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle bg-success-subtle p-2 me-2">
                                                    <iconify-icon icon="tabler:users" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                                                </div>
                                                <p class="mb-0 text-dark fs-16">Conversion Rate</p>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <h3 class="fs-24 fw-medium text-dark mb-0 me-3">25%</h3>
                                                
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2 rounded-2 badge fs-12 badge-soft-success fw-medium">
                                                        <i class="mdi mdi-trending-up fs-14"></i> +2.37%
                                                    </span>
                                                    <p class="text-muted text-center fs-14 mb-0">vs last month</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget-first">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle bg-danger-subtle p-2 me-2">
                                                    <iconify-icon icon="tabler:circle-check" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                                                </div>
                                                <p class="mb-0 text-dark fs-16">Total Deals Closed</p>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <h3 class="fs-24 fw-medium text-dark mb-0 me-3">30</h3>
                                                
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2 rounded-2 badge fs-12 badge-soft-success fw-medium">
                                                        <i class="mdi mdi-trending-up fs-14"></i> +3.28%
                                                    </span>
                                                    <p class="text-muted text-center fs-14 mb-0">vs last month</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Main Widgets -->

                        <!-- start row -->
                        <div class="row">
                            <div class="col-md-12 col-xl-9">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title text-dark mb-0">Overview</h5>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="p-2">
                                            <div id="overview" class="apex-charts"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xxl-3 col-md-6">
                                                <div class="card mb-lg-0">
                                                    <div class="card-body p-2">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="bg-light p-2 rounded-2">
                                                                <iconify-icon icon="tabler:garden-cart" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                                            </div>
                                                            <div class="text-end">
                                                                <h5 class="text-dark fs-14 mb-1">Sales</h5>
                                                                <h6 class="text-muted fw-medium mb-0 fs-16">$540k</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-md-6">
                                                <div class="card mb-lg-0">
                                                    <div class="card-body p-2">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="bg-light p-2 rounded-2">
                                                                <iconify-icon icon="tabler:chart-column" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                                            </div>
                                                            <div class="text-end">
                                                                <h5 class="text-dark fs-14 mb-1">Income</h5>
                                                                <h6 class="text-muted fw-medium mb-0 fs-16">$200k</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-md-6">
                                                <div class="card mb-lg-0">
                                                    <div class="card-body p-2">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="bg-light p-2 rounded-2">
                                                                <iconify-icon icon="tabler:stairs-up" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                                            </div>
                                                            <div class="text-end">
                                                                <h5 class="text-dark fs-14 mb-1">Profit</h5>
                                                                <h6 class="text-muted fw-medium mb-0 fs-16">$265k</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-md-6">
                                                <div class="card mb-lg-0">
                                                    <div class="card-body p-2">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="bg-light p-2 rounded-2">
                                                                <iconify-icon icon="tabler:stairs-down" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                                            </div>
                                                            <div class="text-end">
                                                                <h5 class="text-dark fs-14 mb-1">Expenses</h5>
                                                                <h6 class="text-muted fw-medium mb-0 fs-16">$485k</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-3">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title text-dark mb-0">Lead Sources</h5>
                                            <div class="ms-auto"> 
                                                <button class="btn btn-sm bg-light text-muted dropdown-toggle fw-semibold border" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Weekly<i class="mdi mdi-chevron-down ms-1 fs-14"></i></button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div id="leadChart" class="apex-charts"></div>

                                        <div class="row mt-3">
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                                    <div>
                                                        <i class="mdi mdi-circle fs-13 align-middle me-1" style="color: #008080;"></i>
                                                        <span class="align-middle fs-13 fw-semibold">Social Media</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end fs-13">50.24%</span>
                                                </div>
                                            </div>

                                            <div class="col mb-2">
                                                <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                                    <div>
                                                        <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #66b2b2;"></i>
                                                        <span class="align-middle fs-13 fw-semibold">Website</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end fs-13">5.23%</span>
                                                </div>
                                            </div>

                                            <div class="col mb-2">
                                                <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                                    <div>
                                                        <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #99cccc;"></i>
                                                        <span class="align-middle fs-13 fw-semibold">Email</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end fs-13">15.18%</span>
                                                </div>
                                            </div>

                                            <div class="col mb-0">
                                                <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                                    <div>
                                                        <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #cce5e5;"></i>
                                                        <span class="align-middle fs-13 fw-semibold">Affiliates</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end fs-13">20.02%</span>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                                    <div>
                                                        <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #e6f2f2;"></i>
                                                        <span class="align-middle fs-13 fw-semibold">Direct</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end fs-13">45.48%</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end start -->
                    </div> <!-- container-fluid -->
                </div> <!-- content -->

                <!-- Footer Start -->
                 <?php include __DIR__ . '/layouts/footer.php'; ?>
                <!-- end Footer -->

            </div>
            
            <!-- -------------------------------------------------------------- -->
            <!-- End Page content -->
            <!-- -------------------------------------------------------------- -->

        </div>
        <!-- End Begin page -->

        <!-- Vendor -->
        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/iconify-icon/iconify-icon.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>
        <script src="/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="/assets/libs/feather-icons/feather.min.js"></script>

        <!-- Apexcharts JS -->
        <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Widgets Init Js -->
        <script src="/assets/js/pages/crm-dashboard.init.js"></script>

        <!-- App js-->
        <script src="/assets/js/app.js"></script>

    </body>
</html>
