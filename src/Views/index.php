<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Alumnos | Certiperu - Sistema Intranet</title>
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

                        <!-- Start Monthly Sales -->
                        <div class="row">

                            <div class="col-xxl-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title text-dark mb-0">Tasks List</h5>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        <ul class="list-unstyled task-list-tab mb-0">
                                            <li>
                                                <div class="d-flex mb-2 pb-1">
                                                    <div class="form-check form-todo d-flex align-items-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck1">
                                                        <label class="form-check-label text-dark fw-medium fs-14" for="customCheck1">Plan Product Launch Event</label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="d-flex mb-2 pb-1">
                                                    <div class="form-check form-todo d-flex align-items-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck2">
                                                        <label class="form-check-label text-dark fw-medium fs-14" for="customCheck2">Prepare Monthly Sales Report</label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="d-flex mb-2 pb-1">
                                                    <div class="form-check form-todo d-flex align-items-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck2">
                                                        <label class="form-check-label text-dark fw-medium fs-14" for="customCheck2">Finalize Website Design</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex mb-2 pb-1">
                                                    <div class="form-check form-todo d-flex align-items-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck3">
                                                        <label class="form-check-label text-dark fw-medium fs-14" for="customCheck3">Prepare Marketing Strategy</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex mb-2 pb-1">
                                                    <div class="form-check form-todo d-flex align-items-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck4">
                                                        <label class="form-check-label text-dark fw-medium fs-14" for="customCheck4">Send Client Invoices</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex mb-2 pb-1">
                                                    <div class="form-check form-todo d-flex align-items-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck5">
                                                        <label class="form-check-label text-dark fw-medium fs-14" for="customCheck5">Organize Team Meeting</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex mb-2 pb-1">
                                                    <div class="form-check form-todo d-flex align-items-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck6">
                                                        <label class="form-check-label text-dark fw-medium fs-14" for="customCheck6">Review Project Budget</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex mb-0 pb-0">
                                                    <div class="form-check form-todo d-flex align-items-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck7">
                                                        <label class="form-check-label text-dark fw-medium fs-14" for="customCheck7">Update Sales Report</label>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>

                                        <div class="row g-2 mt-3">
                                            <div class="col mt-0">
                                                <input type="text" class="form-control" placeholder="Add Task Name">
                                            </div>
                                            <div class="col-auto mt-0">
                                                <a href="#!" class="btn btn-primary">+ Add Task</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-8">
                                <div class="card overflow-hidden">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title text-dark mb-0">Top Opportunities</h5>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">

                                        <div class="table-responsive mt-0">
                                            <table class="table table-custom mb-0">

                                                <thead>
                                                    <tr class="bg-light">
                                                        <th class="text-muted">Client</th>
                                                        <th class="text-muted">Stage</th>
                                                        <th class="text-muted">Close Date</th>
                                                        <th class="text-muted">Revenue</th>
                                                        <th class="text-muted">Owner</th>
                                                        <th class="text-muted">Close %</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td class="d-flex align-items-center gap-2">
                                                            <div class="rounded-circle p-2 bg-light">
                                                                <p class="mb-0 fw-medium fs-12">AC</p>
                                                            </div>
                                                            <h5 class="fs-14 fw-medium text-dark mb-0">John Hamilton</h5>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-secondary-subtle text-secondary fs-12 fw-normal">Negotiation</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Nov 20, 2024</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">$20000</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Jane Smith</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">80%</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex align-items-center gap-2">
                                                            <div class="rounded-circle p-2 bg-light">
                                                                <p class="mb-0 fw-medium fs-12">JS</p>
                                                            </div>
                                                            <h5 class="fs-14 fw-medium text-dark mb-0">Jessica Stone</h5>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-success-subtle text-success fs-12 fw-normal">Proposal</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Dec 01, 2024</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">$15000</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Mark Lee</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">65%</p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="d-flex align-items-center gap-2">
                                                            <div class="rounded-circle p-2 bg-light">
                                                                <p class="mb-0 fw-medium fs-12">RK</p>
                                                            </div>
                                                            <h5 class="fs-14 fw-medium text-dark mb-0">Rohit Kapoor</h5>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-warning-subtle text-warning fs-12 fw-normal">Pending</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Oct 18, 2024</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">$10500</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Alicia Wong</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">40%</p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="d-flex align-items-center gap-2">
                                                            <div class="rounded-circle p-2 bg-light">
                                                                <p class="mb-0 fw-medium fs-12">MT</p>
                                                            </div>
                                                            <h5 class="fs-14 fw-medium text-dark mb-0">Michael Thompson</h5>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-primary-subtle text-primary fs-12 fw-normal">Discussion</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Sep 30, 2024</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">$8900</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Natalie Cruz</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">55%</p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="d-flex align-items-center gap-2">
                                                            <div class="rounded-circle p-2 bg-light">
                                                                <p class="mb-0 fw-medium fs-12">AS</p>
                                                            </div>
                                                            <h5 class="fs-14 fw-medium text-dark mb-0">Amy Santiago</h5>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-danger-subtle text-danger fs-12 fw-normal">Delayed</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Nov 10, 2024</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">$12000</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Jake Peralta</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">30%</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <div class="rounded-circle p-2 bg-light me-2">
                                                                <p class="mb-0 fw-medium fs-12">CW</p>
                                                            </div>
                                                            <h5 class="fs-14 fw-medium text-dark mb-0">Clara Williams</h5>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-info-subtle text-info fs-12 fw-normal">In Review</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Dec 15, 2024</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">$17500</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">Oscar Hale</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fs-14 fw-medium">70%</p>
                                                        </td>
                                                    </tr>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- End Monthly Sales -->

                        <div class="row">

                            <div class="col-xl-8">
                                <div class="card overflow-hidden">

                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title text-dark mb-0">Leads Report</h5>
                                        </div>
                                    </div>

                                    <div class="card-body mt-0 p-0">
                                        <div class="table-responsive mt-0">
                                            <table class="table table-custom table-hover mb-0">

                                                <thead>
                                                    <tr class="bg-light">
                                                        <th class="text-muted">Lead</th>
                                                        <th class="text-muted">Email</th>
                                                        <th class="text-muted">Phone No</th>
                                                        <th class="text-muted">Campany</th>
                                                        <th class="text-muted">Status</th>
                                                        <th class="text-muted">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="assets/images/users/user-12.jpg" class="avatar-sm flex-shrink-0 images-radius me-3">
                                                            <h5 class="fs-14 fw-medium text-dark mb-0">John Hamilton</h5>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">johnehamilton@gmail.com</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">+48, 65610085</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">Mufti</p>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-primary-subtle text-primary">New Lead</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:pencil" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:trash" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="assets/images/users/user-13.jpg" class="avatar avatar-sm images-radius me-3">
                                                            <div>
                                                                <h6 class="fs-14 fw-medium text-dark mb-0">Janice Reese</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">janicecreese@gmail.com</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">+45, 32678972</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">Gucci</p>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-secondary-subtle text-secondary">In Progress</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:pencil" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:trash" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="assets/images/users/user-14.jpg" class="avatar avatar-sm images-radius me-3">
                                                            <div>
                                                                <h6 class="fs-14 fw-medium text-dark mb-0">Andrew Kim</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">andrewekim@gmail.com</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">+30, 84787124</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">Vans</p>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-danger-subtle text-danger">Loss</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:pencil" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:trash" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="assets/images/users/user-15.jpg" class="avatar avatar-sm images-radius me-3">
                                                            <div>
                                                                <h6 class="fs-14 fw-medium text-dark mb-0">Kathryn Sanchez</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">kathryntsanchez@gmail.com</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">+30, 23794209</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">Myntra</p>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-success-subtle text-success">Won</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:pencil" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:trash" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="assets/images/users/user-16.jpg" class="avatar avatar-sm images-radius me-3">
                                                            <div>
                                                                <h6 class="fs-14 fw-medium text-dark mb-0">Diane Richards</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">dianetrichards@gmail.com</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">+78, 37569176</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">HCLTech</p>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-warning-subtle text-warning">Converted</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:pencil" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:trash" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="assets/images/users/user-9.jpg" class="avatar avatar-sm images-radius me-3">
                                                            <div>
                                                                <h6 class="fs-14 fw-medium text-dark mb-0">Kit Richards</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">kitrichards@gmail.com</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">+78, 35698564</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">Muffi</p>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-primary-subtle text-primary">New Lead</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:pencil" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                                <a aria-label="anchor" class="btn btn-icon btn-sm rounded-circle bg-light" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="#">
                                                                    <iconify-icon icon="tabler:trash" class="align-middle fs-16 mb-0"></iconify-icon>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="align-items-center justify-content-between row text-center text-sm-start">
                                            <div class="col-sm">
                                                <div class="text-muted">
                                                    Showing <span class="fw-semibold">7</span> of <span class="fw-semibold">45</span> Results
                                                </div>
                                            </div>
                                            <div class="col-sm-auto mt-3 mt-sm-0">
                                                <ul class="pagination pagination-boxed mb-0 justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a href="#" class="page-link">
                                                            <i class="ti ti-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a href="#" class="page-link">1</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link"><i class="ti ti-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xxl-4">
                                <div class="card overflow-hidden">

                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title text-dark mb-0">Upcoming Schedule</h5>
                                        </div>
                                    </div>

                                    <div class="card-body mt-0">

                                        <table class="table table-borderless upcoming-table mb-0">
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-13 text-muted fw-medium">Mon, 24 March</span>
                                                            <span class="fs-14 text-dark">07:00 PM</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-0 text-dark fs-14">Marketing Policy Meeting</h6>
                                                            <div class="d-flex align-items-center">
                                                                <span class="fs-13 text-muted fw-medium me-2">Attendance</span>
                                                                <span class="fs-13 text-dark">Robert Downy</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <iconify-icon icon="tabler:arrow-right-dashed" class="align-middle text-primary fs-20"></iconify-icon>
                                                        </div>
                                                    </td>                                                    
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-13 text-muted fw-medium">Tue, 25 March</span>
                                                            <span class="fs-14 text-dark">09:00 AM</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-0 text-dark fs-14">Project Kickoff Meeting</h6>
                                                            <div class="d-flex align-items-center">
                                                                <span class="fs-13 text-muted fw-medium me-2">Attendance</span>
                                                                <span class="fs-13 text-dark">Emma Watson</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <iconify-icon icon="tabler:arrow-right-dashed" class="align-middle text-primary fs-20"></iconify-icon>
                                                        </div>
                                                    </td>                                                    
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-13 text-muted fw-medium">Wed, 26 March</span>
                                                            <span class="fs-14 text-dark">11:30 AM</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-0 text-dark fs-14">Design Review Session</h6>
                                                            <div class="d-flex align-items-center">
                                                                <span class="fs-13 text-muted fw-medium me-2">Attendance</span>
                                                                <span class="fs-13 text-dark">Chris Evans</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <iconify-icon icon="tabler:arrow-right-dashed" class="align-middle text-primary fs-20"></iconify-icon>
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-13 text-muted fw-medium">Thu, 27 March</span>
                                                            <span class="fs-14 text-dark">02:15 PM</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-0 text-dark fs-14">Client Feedback Round</h6>
                                                            <div class="d-flex align-items-center">
                                                                <span class="fs-13 text-muted fw-medium me-2">Attendance</span>
                                                                <span class="fs-13 text-dark">Natalie Portman</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <iconify-icon icon="tabler:arrow-right-dashed" class="align-middle text-primary fs-20"></iconify-icon>
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-13 text-muted fw-medium">Fri, 28 March</span>
                                                            <span class="fs-14 text-dark">04:45 PM</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-0 text-dark fs-14">Team Retrospective</h6>
                                                            <div class="d-flex align-items-center">
                                                                <span class="fs-13 text-muted fw-medium me-2">Attendance</span>
                                                                <span class="fs-13 text-dark">Tom Holland</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <iconify-icon icon="tabler:arrow-right-dashed" class="align-middle text-primary fs-20"></iconify-icon>
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-13 text-muted fw-medium">Sat, 29 March</span>
                                                            <span class="fs-14 text-dark">10:30 AM</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-0 text-dark fs-14">Budget Planning Discussion</h6>
                                                            <div class="d-flex align-items-center">
                                                                <span class="fs-13 text-muted fw-medium me-2">Attendance</span>
                                                                <span class="fs-13 text-dark">Scarlett Johansson</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <iconify-icon icon="tabler:arrow-right-dashed" class="align-middle text-primary fs-20"></iconify-icon>
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
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
