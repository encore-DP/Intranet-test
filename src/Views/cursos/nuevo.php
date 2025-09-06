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
                                <h4 class="fs-18 fw-semibold m-0">Registro de Cursos</h4>
                            </div>

                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Cursos</a></li>
                                    <li class="breadcrumb-item active">Nuevo Curso</li>
                                </ol>
                            </div>
                        </div>

                        <!-- General Form -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Datos Generales</h5>
                                    </div><!-- end card header -->
                                    
                                    <div class="card-body">
                                        <form method="post" action="/cursos" class="row gy-2 gx-3 align-items-center">
                                            <div class="col-sm-5">
                                                <label for="simpleinput" class="form-label">Nombre del Cursos</label>
                                                <input type="text" name="nombre" id="autoSizingInput" class="form-control">
                                            </div>
                                            <div class="col-sm-5">
                                                <label for="simpleinput" class="form-label">Modalidad</label>
                                                <input type="text" name="modalidad" id="autoSizingInput" class="form-control">
                                            </div>
                                            <div class="col-sm-5">
                                                <label for="example-email" class="form-label">Horas</label>
                                                <input type="number" name="horas" class="form-control" min="1" step="1" required>
                                            </div>
                                            <div class="col-sm-5">
                                              <label for="categoria_id" class="form-label">Categoría</label>
                                              <select id="categoria_id" name="categoria_id" class="form-select" required>
                                                <option value="">— Selecciona —</option>
                                                <?php foreach ($categorias as $cat): ?>
                                                  <option value="<?= $cat['categoria_id'] ?>">
                                                    <?= htmlspecialchars($cat['nombre']) ?>
                                                  </option>
                                                <?php endforeach; ?>
                                              </select>
                                            </div>

                                            <div class="col-sm-10">
                                                <label for="example-email" class="form-label">Descripción</label>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="descripcion" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                                    <label for="floatingTextarea">Descripción del Cursos</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-primary">Registar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->
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
