<!-- src/Views/alumnos/nuevo.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuevo Alumno</title>
</head>
<body>
    <h1>Nuevo Alumno</h1>
    <form method="POST" action="/alumnos/guardar">
        <label>DNI:</label><br>
        <input type="text" name="dni" maxlength="8" required><br><br>

        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" required><br><br>

        <label>Empresa ID:</label><br>
        <input type="number" name="empresa_id" required><br><br>

        <button type="submit">Guardar</button>
    </form>
    <p><a href="/alumnos/lista">⬅️ Volver a la lista</a></p>
</body>
</html>
