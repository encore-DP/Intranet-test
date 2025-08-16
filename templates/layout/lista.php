<?php require __DIR__ . '../layout/header.php'; ?>

<!-- Contenido específico -->
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <h4 class="fs-18 fw-semibold m-0">Lista de Alumnos</h4>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table datatable">
                    <!-- Tabla de alumnos (mantener tu lógica original) -->
                    <?php foreach ($alumnos as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['nombre']) ?></td>
                        <!-- Resto de columnas -->
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>