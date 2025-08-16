<?php
use Slim\App;
use App\Controllers\AlumnoController;
use App\Controllers\CursoController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    // Ruta principal modificada para cargar Views/index.php
    $app->get('/', function (Request $request, Response $response) {
        // Verificar conexión a BD primero
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=delcorbc_certiperu_intranet', 'delcorbc_encore', 'EncoreDP2025$$');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo = null; // Cerramos conexión después de verificar
            
            // Capturar el contenido de la vista
            ob_start();
            include __DIR__ . '/../src/Views/index.php';
            $html = ob_get_clean();
            
            $response->getBody()->write($html);
            return $response;
            
        } catch (PDOException $e) {
            $response->getBody()->write("Error de conexión a la base de datos");
            return $response->withStatus(500);
        }
    });

    // ==== GRUPO ALUMNOS ==== (Manteniendo todo igual)
    $app->group('/alumnos', function ($group) {
        $group->get('/lista', [AlumnoController::class, 'lista']);
        $group->get('/nuevo', [AlumnoController::class, 'nuevo']);
        $group->post('/guardar', [AlumnoController::class, 'guardar']);
        $group->get('/editar/{id}', [AlumnoController::class, 'editar']);
        $group->post('/actualizar/{id}', [AlumnoController::class, 'actualizar']);
        $group->get('/eliminar/{id}', [AlumnoController::class, 'eliminar']);
    });

    // ==== GRUPO CURSOS ==== (Manteniendo todo igual)
    $app->group('/cursos', function ($group) {
        $group->get('/lista', [CursoController::class, 'lista']);
        $group->get('/nuevo', [CursoController::class, 'nuevo']);
        $group->post('/guardar', [CursoController::class, 'guardar']);
        $group->get('/editar/{id}', [CursoController::class, 'editar']);
        $group->post('/actualizar/{id}', [CursoController::class, 'actualizar']);
        $group->get('/eliminar/{id}', [CursoController::class, 'eliminar']);
    });
};