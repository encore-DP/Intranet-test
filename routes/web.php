<?php
declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Controllers\AlumnoController;

return function (App $app): void {

    // Home: carga una vista
    $app->get('/', function (Request $request, Response $response) {
        ob_start();
        // ajusta si tu index de vistas está en otro sitio
        include __DIR__ . '/../src/Views/index.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    });

    // Grupo de rutas: Alumnos
    $app->group('/alumnos', function (RouteCollectorProxy $group) {
        $group->get('/lista',  [AlumnoController::class, 'lista']);
        $group->get('/nuevo',  [AlumnoController::class, 'nuevo']);
        $group->post('',       [AlumnoController::class, 'guardar']);
        $group->get('/{id}/editar', [AlumnoController::class, 'editarVista']);
        $group->post('/{id}/editar', [AlumnoController::class, 'editar']);
        $group->post('/{id}/eliminar', [AlumnoController::class, 'eliminar']);
    });

        // Grupo de rutas: Cursos
    $app->group('/cursos', function (RouteCollectorProxy $group) {
        $group->get('/lista',  [CursoController::class, 'lista']);
        $group->get('/nuevo',  [CursoController::class, 'nuevo']);
        $group->post('',       [CursoController::class, 'guardar']);
        $group->get('/{id}/editar', [CursoController::class, 'editarVista']);
        $group->post('/{id}/editar', [CursoController::class, 'editar']);
        $group->post('/{id}/eliminar', [CursoController::class, 'eliminar']);
    });
};
