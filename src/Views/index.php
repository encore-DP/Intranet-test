<h1>Lista de Alumnos</h1>
<a href="/alumnos/create">Registrar nuevo</a>
<table border="1">
    <tr><th>ID</th><th>DNI</th><th>Nombre</th><th>Apellido</th><th>Empresa</th><th>Acciones</th></tr>
    <?php foreach ($alumnos as $a): ?>
    <tr>
        <td><?= $a['alumno_id'] ?></td>
        <td><?= $a['dni'] ?></td>
        <td><?= $a['nombre'] ?></td>
        <td><?= $a['apellido'] ?></td>
        <td><?= $a['empresa'] ?></td>
        <td>
            <a href="/alumnos/edit/<?= $a['alumno_id'] ?>">Editar</a>
            <a href="/alumnos/delete/<?= $a['alumno_id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>
