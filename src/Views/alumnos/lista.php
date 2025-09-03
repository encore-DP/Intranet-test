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
    <?php include __DIR__ . '/../layouts/header.php'; ?>
        <!-- Header End -->  
            <!-- Left Sidebar Start -->
    <?php include __DIR__ . '/../layouts/sidebar.php'; ?>            
            <!-- Left Sidebar End -->
<?php
  // base path seguro (por si tu app no está en /)
  $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
  // flash simple por query
  $ok = $_GET['ok'] ?? null;
?>            
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
                        <?php if ($ok === 'deleted'): ?>
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Alumno eliminado correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                          </div>
                        <?php elseif ($ok === 'updated'): ?>
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Alumno actualizado correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                          </div>
                        <?php endif; ?>
                        

                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="table-responsive">
                                <table class="table datatable" id="datatable_1">
                                    <thead>
                                        <tr>
                                            <th>Alumno</th>
                                            <th>DNI</th>
                                            <th>Empresa</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($alumnos)): ?>
                                            <?php foreach ($alumnos as $a): ?>
                                                <tr>
                                                    <td class="ps-0">
                                                        <p class="d-inline-block align-middle mb-0">
                                                            <span><?= htmlspecialchars($a['nombre'] . " " . $a['apellido']) ?></span>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <span><?= htmlspecialchars($a['dni']) ?></span>
                                                    </td>
                                                    <td><?= htmlspecialchars($a['empresa']) ?></td>

                                                    <td class="text-end">
                                                      <a href="/alumnos/<?= (int)$a['alumno_id'] ?>/editar"
                                                         aria-label="Editar"
                                                         class="btn btn-icon btn-sm border shadow-sm me-1"
                                                         data-bs-toggle="tooltip"
                                                         title="Editar">
                                                        <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                                      </a>
                                                     <!-- ESTA POR DEFINIRSE                                            
                                                      <button type="button"
                                                              aria-label="Eliminar"
                                                              class="btn btn-icon btn-sm border shadow-sm"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#confirmDelete"
                                                              data-id="<?= (int)$a['alumno_id'] ?>"
                                                              data-name="<?= htmlspecialchars($a['nombre'].' '.$a['apellido']) ?>"
                                                              title="Eliminar">
                                                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                      </button>
                                                      -->
                                                    </td>
                                                                                                
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No hay alumnos registrados</td>
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
                 <?php include __DIR__ . '/../layouts/footer.php'; ?>
                <!-- end Footer -->

            </div>
            
            <!-- -------------------------------------------------------------- -->
            <!-- End Page content -->
            <!-- -------------------------------------------------------------- -->

            <!-- Modal: Confirmar eliminación -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <form method="post" class="modal-content" id="deleteForm">
                  <div class="modal-header">
                    <h5 class="modal-title">Eliminar alumno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>
                  <div class="modal-body">
                    <p>¿Seguro que deseas eliminar a <strong id="delName">—</strong>?</p>
                    <p class="text-muted mb-0">Esta acción no se puede deshacer.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                  </div>
                </form>
              </div>
            </div>           

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

        <!-- Modal: Confirmar eliminación -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
          const modalEl = document.getElementById('confirmDelete');
          if (!modalEl) return;
        
          modalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;              // el botón que abrió el modal
            if (!button) return;
        
            const id   = button.getAttribute('data-id') || '';
            const name = button.getAttribute('data-name') || '—';
        
            // pinta el nombre en el modal
            const delNameEl = document.getElementById('delName');
            if (delNameEl) delNameEl.textContent = name;
        
            // arma la acción del form (POST)
            const form = document.getElementById('deleteForm');
            if (form) {
              // si tu app está en la raíz:
              form.action = '/alumnos/' + id + '/eliminar';
            
              // si usas subcarpeta, usa basePath:
              // const basePath = '<?= ($basePathRaw = dirname($_SERVER['SCRIPT_NAME'])) === "/" ? "" : rtrim($basePathRaw, "/") ?>';
              // form.action = basePath + '/alumnos/' + id + '/eliminar';
            }
          });
        });
        </script>

        

    </body>
</html>
