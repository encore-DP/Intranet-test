<?php
// --- Inicio: Sync Certificados (poner ANTES de cualquier salida HTML) ---
if (session_status() === PHP_SESSION_NONE) session_start();

// RUTAS: cámbialas por las tuyas reales
$SRC = '/home/delcorb/intranet.certiperu.com/CERTIF'; // origen
$DST = '/home/USUARIO/certiperu.com/certificados';          // destino
$ENABLE_MIRROR_DELETE = false; // true = espejar (borra en destino lo que no esté en origen)

if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));

function normalizePath($p){ return rtrim($p, DIRECTORY_SEPARATOR); }
function ensureDir($d){
  if (!is_dir($d)) { if (!mkdir($d, 0755, true) && !is_dir($d)) throw new RuntimeException("No se pudo crear: $d"); }
}
function listFilesRecursive($base){
  $base = normalizePath($base); $out = [];
  $it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($base, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
  );
  foreach ($it as $path => $info) {
    $rel = substr($path, strlen($base) + 1);
    $out[$rel] = ['is_dir'=>$info->isDir(), 'abs'=>$path];
  }
  return $out;
}
function copyIfNewer($src, $dst){
  $dstDir = dirname($dst);
  if (!is_dir($dstDir)) { if (!mkdir($dstDir, 0755, true) && !is_dir($dstDir)) throw new RuntimeException("No se pudo crear: $dstDir"); }
  if (!file_exists($dst) || filemtime($src) > @filemtime($dst) || filesize($src) !== @filesize($dst)) {
    if (!copy($src, $dst)) throw new RuntimeException("Fallo al copiar: $src -> $dst");
    @chmod($dst, 0644);
    return true;
  }
  return false;
}
function syncUpdateOnly($SRC,$DST,&$rep){
  $rep=['created_dirs'=>0,'copied_files'=>0,'skipped'=>0];
  $SRC=normalizePath($SRC); $DST=normalizePath($DST); ensureDir($DST);
  $srcMap = listFilesRecursive($SRC);
  foreach ($srcMap as $rel=>$meta){
    $src=$meta['abs']; $dst=$DST.DIRECTORY_SEPARATOR.$rel;
    if ($meta['is_dir']){
      if (!is_dir($dst)){ if (!mkdir($dst,0755,true) && !is_dir($dst)) throw new RuntimeException("No se pudo crear: $dst"); $rep['created_dirs']++; }
    } else {
      $did = copyIfNewer($src,$dst);
      $did ? $rep['copied_files']++ : $rep['skipped']++;
    }
  }
}
function mirrorDeleteExtras($SRC,$DST,&$rep){
  $rep['deleted_files']=0; $rep['deleted_dirs']=0;
  $srcMap=listFilesRecursive(normalizePath($SRC));
  $dstMap=listFilesRecursive(normalizePath($DST));
  $delF=[]; $delD=[];
  foreach ($dstMap as $rel=>$meta){
    if (!array_key_exists($rel,$srcMap)){
      $meta['is_dir'] ? $delD[]=$meta['abs'] : $delF[]=$meta['abs'];
    }
  }
  foreach ($delF as $f){ if (is_file($f) && @unlink($f)) $rep['deleted_files']++; }
  rsort($delD);
  foreach ($delD as $d){ @rmdir($d) && $rep['deleted_dirs']++; }
}

// Acción: al pulsar el botón
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['sync_cert_now'])) {
  try {
    if (empty($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) throw new RuntimeException('Solicitud inválida (CSRF).');
    @set_time_limit(300); @ini_set('memory_limit','512M');
    if (!is_dir($SRC)) throw new RuntimeException("Ruta origen no existe: $SRC");
    ensureDir($DST);
    $report=[];
    syncUpdateOnly($SRC,$DST,$report);
    if ($ENABLE_MIRROR_DELETE) mirrorDeleteExtras($SRC,$DST,$report);
    $_SESSION['flash_sync'] = ['ok'=>true,'msg'=>'Sincronización completada.','report'=>$report];
  } catch (Throwable $e) {
    $_SESSION['flash_sync'] = ['ok'=>false,'msg'=>$e->getMessage()];
  }
  // Redirigir para evitar repost en refresh
  header('Location: '.$_SERVER['REQUEST_URI']); exit;
}
// --- Fin: Sync Certificados ---
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Certificados | Certiperu - Sistema Intranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/assets/images/favicon.png" height="10" width="10">
    <link href="/assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <script src="/assets/js/head.js"></script>
  </head>
  <body data-menu-color="light" data-sidebar="default">
    <div id="app-layout">
      <?php include __DIR__ . '/../layouts/header.php'; ?>
      
            <?php if (!empty($_SESSION['flash_sync'])): $f = $_SESSION['flash_sync']; unset($_SESSION['flash_sync']); ?>
        <div style="margin:12px 20px;padding:12px 14px;border-radius:10px;<?=
          $f['ok'] ? 'background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0' : 'background:#fef2f2;color:#991b1b;border:1px solid #fecaca'
        ?>">
          <strong><?= $f['ok'] ? '✔ Éxito:' : '✖ Error:' ?></strong>
          <div><?= htmlspecialchars($f['msg']) ?></div>
          <?php if (!empty($f['report'])): $r=$f['report']; ?>
            <div style="margin-top:8px">
              Copiados: <b><?= (int)($r['copied_files']??0) ?></b> · Omitidos: <b><?= (int)($r['skipped']??0) ?></b> · Dir. creados: <b><?= (int)($r['created_dirs']??0) ?></b>
              <?php if (isset($r['deleted_files'])): ?> · Eliminados: <b><?= (int)$r['deleted_files'] ?></b> · Dirs. eliminados: <b><?= (int)$r['deleted_dirs'] ?></b><?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
              
      <?php include __DIR__ . '/../layouts/sidebar.php'; ?>

      <?php
        // basePath seguro si tu app está en subcarpeta
        $basePathRaw = dirname($_SERVER['SCRIPT_NAME']);
        $basePath = ($basePathRaw === '/' ? '' : rtrim($basePathRaw, '/'));
      ?>

      <div class="content-page">
        <div class="content">
          <div class="container-fluid">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Lista de Certificados</h4>
              </div>
              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="javascript:void(0);">Certificados</a></li>
                  <li class="breadcrumb-item active">Lista</li>
                </ol>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form method="post" style="display:inline" onsubmit="return confirm('¿Copiar ahora los Certificados al otro dominio?');">
                      <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                      <button type="submit" name="sync_cert_now" class="btn btn-dark">
                        Copiar Certificados ahora
                      </button>
                    </form>
                    <div class="table-responsive">
                      <table class="table datatable" id="datatable_cert">
                        <thead>
                          <tr>
                            <th>Código</th>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Fecha</th>
                            <th>URL</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (!empty($certificados)): ?>
                            <?php foreach ($certificados as $c): ?>
                              <tr>
                                <td><span class="badge bg-light text-dark"><?= htmlspecialchars($c['codigo_unico'] ?? '') ?></span></td>
                                <td><?= htmlspecialchars($c['alumno_completo'] ?? '') ?></td>
                                <td><?= htmlspecialchars($c['curso_nombre'] ?? '') ?></td>
                                <td>
                                  <?php
                                    $f = $c['fecha_emision'] ?? '';
                                    echo $f ? htmlspecialchars($f) : '—';
                                  ?>
                                </td>
                                <td>
                                  <?php
                                    $u = $c['certificado_url'] ?? '';
                                    if ($u === '' && !empty($c['codigo_unico'])) {
                                      // fallback por si el SP no devuelve la URL
                                      $u = $basePath . '/CERTIF/' . $c['codigo_unico'] . '.html';
                                    }
                                  ?>
                                  <?php if (!empty($u)): ?>
                                    <a href="<?= htmlspecialchars($u) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                      Abrir
                                    </a>
                                  <?php else: ?>
                                    —
                                  <?php endif; ?>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <tr><td colspan="5" class="text-center">No hay certificados</td></tr>
                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div><!-- table-responsive -->
                  </div><!-- card-body -->
                </div><!-- card -->
              </div><!-- col -->
            </div><!-- row -->

          </div><!-- container -->
        </div><!-- content -->

        <?php include __DIR__ . '/../layouts/footer.php'; ?>
      </div><!-- content-page -->
    </div><!-- app-layout -->

    <!-- Vendor -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/iconify-icon/iconify-icon.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>
    <script src="/assets/libs/feather-icons/feather.min.js"></script>
    <script src="/assets/libs/simple-datatables/simple-datatables.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const t = document.querySelector('#datatable_cert');
        if (t) new simpleDatatables.DataTable(t);
      });
    </script>

    <script src="/assets/js/app.js"></script>
  </body>
</html>
