<!-- src/Views/alumnos/editar.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
</head>
<body>
    <h1>Editar Alumno</h1>
    <form method="POST" action="/alumnos/actualizar/<?= $alumno['alumno_id'] ?>">
        <label>DNI:</label><br>
        <input type="text" name="dni" maxlength="8" value="<?= htmlspecialchars($alumno['dni']) ?>" required><br><br>

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($alumno['nombre']) ?>" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" value="<?= htmlspecialchars($alumno['apellido']) ?>" required><br><br>

        <label>Empresa ID:</label><br>
        <input type="number" name="empresa_id" value="<?= htmlspecialchars($alumno['empresa_id']) ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>
    <p><a href="/alumnos/lista">⬅️ Volver a la lista</a></p>
</body>
</html>
