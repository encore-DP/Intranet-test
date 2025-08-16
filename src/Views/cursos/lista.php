<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Cursos | Certiperu - Sistema Intranet</title>
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
    <?php include __DIR__ . '/../layouts/header.php'; ?>
        <!-- Header End -->  
            <!-- Left Sidebar Start -->
    <?php include __DIR__ . '/../layouts/sidebar.php'; ?>            
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
                                <h4 class="fs-18 fw-semibold m-0">Lista de Cursos</h4>
                            </div>
            
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Cursos</a></li>
                                    <li class="breadcrumb-item active">Lista</li>
                                </ol>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table datatable" id="datatable_1">
                                                <thead>
                                                  <tr>
                                                    <th>Curso</th>
                                                    <th>Categoria</th>
                                                    <th>Modalidad</th>
                                                    <th>Horas</th>
                                                    <th>Descripción</th>
                                                    <th>Acciones</th>
                                                  </tr>
                                                </thead>
                                                    <tbody>
                                                        <?php if (!empty($cursos)): ?>
                                                            <?php foreach ($cursos as $curso): ?>
                                                                <tr>
                                                                    <td class="ps-0">
                                                                        <p class="d-inline-block align-middle mb-0">
                                                                            <span><?= htmlspecialchars($curso['nombre']) ?></span>
                                                                        </p>
                                                                    </td>
                                                                    <td>
                                                                        <span><?= htmlspecialchars($curso['categoria']) ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?= htmlspecialchars($curso['modalidad']) ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?= htmlspecialchars($curso['horas']) ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?= htmlspecialchars($curso['descripcion']) ?></span>
                                                                    </td>
                                                                    <td class="text-end">
                                                                        <a href="curso_editar.php?id=<?= $curso['curso_id'] ?>"
                                                                        aria-label="Editar"
                                                                        class="btn btn-icon btn-sm border shadow-sm me-1"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Editar">
                                                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                                                        </a>
                                                                        <a href="curso_eliminar.php?id=<?= $curso['curso_id'] ?>"
                                                                        aria-label="Eliminar"
                                                                        class="btn btn-icon btn-sm border shadow-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Eliminar"
                                                                        onclick="return confirm('¿Seguro que deseas eliminar este curso?');">
                                                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="6" class="text-center">No hay cursos registrados</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - DESARROLLADO POR <span class="mdi mdi-heart text-danger"></span> <a href="#!" class="text-reset fw-semibold">Encore Digital</a> 
                            </div>
                        </div>
                    </div>
                </footer>
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
