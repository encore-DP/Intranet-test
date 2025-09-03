<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Editar Alumnos | Certiperu - Sistema Intranet</title>
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
                                <h4 class="fs-18 fw-semibold m-0">Lista de Alumnos</h4>
                            </div>
            
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Alumnos</a></li>
                                    <li class="breadcrumb-item active">Lista</li>
                                </ol>
                            </div>
                        </div>

                        <?php $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Editar Alumno</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <form method="post" 
                                              action="/alumnos/<?= (int)$alumno['alumno_id'] ?>/editar">

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre</label>
                                                        <input type="text" name="nombre" class="form-control"
                                                               value="<?= htmlspecialchars($alumno['nombre']) ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Apellido</label>
                                                        <input type="text" name="apellido" class="form-control"
                                                               value="<?= htmlspecialchars($alumno['apellido']) ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">DNI</label>
                                                        <input type="text" name="dni" class="form-control"
                                                               value="<?= htmlspecialchars($alumno['dni']) ?>" maxlength="8" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Empresa</label>
                                                        <select name="empresa_id" class="form-select" required>
                                                            <option value="">— Selecciona empresa —</option>
                                                            <?php foreach ($empresas as $e): ?>
                                                                <?php
                                                                  $id  = $e['empresa_id'] ?? $e['id'] ?? null;
                                                                  $nom = $e['nombre'] ?? '';
                                                                  $sel = ((int)$alumno['empresa_id'] === (int)$id) ? 'selected' : '';
                                                                ?>
                                                                <option value="<?= (int)$id ?>" <?= $sel ?>>
                                                                    <?= htmlspecialchars($nom) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                                            
                                            <div class="mt-3">
                                                <a href="/alumnos/lista" class="btn btn-light">Cancelar</a>
                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                            </div>
                                                            
                                        </form>
                                    </div><!-- end card body -->
                                                            
                                </div><!-- end card -->
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer Start -->
                 <?php include __DIR__ . '/../layouts/footer.php'; ?>
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
