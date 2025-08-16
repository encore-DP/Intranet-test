<!-- src/Views/alumnos/eliminar.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eliminar Alumno</title>
</head>
<body>
    <h1>Eliminar Alumno</h1>
    <p>¿Estás seguro que quieres eliminar al alumno <strong><?= htmlspecialchars($alumno['nombre']) ?> <?= htmlspecialchars($alumno['apellido']) ?></strong>?</p>
    <form method="POST" action="/alumnos/borrar/<?= $alumno['alumno_id'] ?>">
        <button type="submit">Sí, eliminar</button>
    </form>
    <p><a href="/alumnos/lista">⬅️ Cancelar</a></p>
</body>
</html>
