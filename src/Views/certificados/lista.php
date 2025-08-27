<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Certificados | Certiperu - Sistema Intranet</title>
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
                <?php $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); ?>
                <form id="cert-form" class="row gy-2 gx-3 align-items-center" method="post" action="<?= $basePath ?>/certificados">               
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Registro de Certificados</h4>
                            </div>
            
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Certificados</a></li>
                                    <li class="breadcrumb-item active">Nuevo Certificados</li>
                                </ol>
                            </div>
                        </div>
                        <!-- General Form -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Seleccionar Alumno</h5>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                            <div class="col-sm-12">
                                                <select id="alumno_id" name="alumno_id" class="form-select" required>
                                                  <option value="">— Selecciona —</option>
                                                  <?php foreach ($alumnos as $a): ?>
                                                    <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nombre']) ?> (<?= htmlspecialchars($a['dni']) ?>)</option>
                                                  <?php endforeach; ?>
                                                </select>
                                            </div>
                                                    
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Datos del Alumno</h5>
                                    </div><!-- end card header -->
                                                    
                                    <div class="card-body">                                      
                                        
                                            <div class="row">
                                              <div class="col-lg-6">
                                                <label class="form-label">Nombres y Apellidos</label>
                                                <input type="text" id="alumno_nombre" class="form-control" readonly>
                                              </div>
                                              <div class="col-lg-3">
                                                <label class="form-label">DNI</label>
                                                <input type="text" id="alumno_dni" class="form-control" readonly>
                                              </div>
                                              <div class="col-lg-3">
                                                <label class="form-label">Empresa</label>
                                                <input type="text" id="alumno_empresa" class="form-control" readonly>
                                              </div>
                                            </div>                                               
                                        
                                    </div>                                  
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                              <div class="card">
                                <div class="card-header"><h5 class="card-title mb-0">Seleccionar Curso</h5></div>
                                <div class="card-body">
                                  <select id="curso_id" name="curso_id" class="form-select" required>
                                    <option value="">— Selecciona —</option>
                                    <?php foreach ($cursos as $c): ?>
                                      <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Datos del Curso</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                  <label class="form-label">Categoría</label>
                                                  <input type="text" id="curso_categoria" class="form-control" readonly>
                                                </div>
                                                <div class="col-lg-4">
                                                  <label class="form-label">Modalidad</label>
                                                  <input type="text" id="curso_modalidad" class="form-control" readonly>
                                                </div>
                                                <div class="col-lg-4">
                                                  <label class="form-label">Horas</label>
                                                  <input type="text" id="curso_horas" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-large" class="form-label">Descipción</label>
                                                          <textarea id="curso_descripcion" class="form-control" rows="2" readonly></textarea>
                                            </div>                                                                                            
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Fecha de Emisión de Certificado</h5>
                                    </div><!-- end card header -->
                                    <div class="card-body">

                                            <div class="mb-3">
                                                <label for="example-date" class="form-label">Fecha</label>
                                                <input type="date" id="fecha" name="fecha" class="form-control" required>
                                            </div>                                                                                      
                                            <button type="submit" class="btn btn-primary">enviar</button>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div> <!-- container-fluid -->

                </div> <!-- content -->
                </form>
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

        <script>
        (() => {
          const alumnos = <?= json_encode($alumnos ?? []) ?>;
          const cursos  = <?= json_encode($cursos ?? []) ?>;
        
          const findBy = (arr, key, val) => arr.find(x => String(x[key]) === String(val)) || null;
        
          document.getElementById('alumno_id')?.addEventListener('change', e => {
            const a = findBy(alumnos, 'alumno_id', e.target.value) || findBy(alumnos, 'id', e.target.value);
            document.getElementById('alumno_nombre').value  = a ? [a.nombre ?? '', a.apellido ?? ''].join(' ').trim() : '';
            document.getElementById('alumno_dni').value     = a ? (a.dni ?? '') : '';
            document.getElementById('alumno_empresa').value = a ? (a.empresa_nombre ?? a.empresa ?? '') : '';
          });
      
          document.getElementById('curso_id')?.addEventListener('change', e => {
            const c = findBy(cursos, 'curso_id', e.target.value) || findBy(cursos, 'id', e.target.value);
            document.getElementById('curso_categoria').value   = c ? (c.categoria ?? '')   : '';
            document.getElementById('curso_modalidad').value   = c ? (c.modalidad ?? '')   : '';
            document.getElementById('curso_horas').value       = c ? (c.horas ?? '')       : '';
            document.getElementById('curso_descripcion').value = c ? (c.descripcion ?? '') : '';
          });
        })();
        </script>

    </body>
</html>
