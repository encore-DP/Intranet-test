<?php
use Slim\App;
use App\Controllers\AlumnoController;
use App\Controllers\CursoController;

return function (App $app) {
    $app->get('/', function ($request, $response) {
        $response->getBody()->write("Bienvenido a la aplicación Slim");
        return $response;
    });

    // ==== GRUPO ALUMNOS ====
    $app->group('/alumnos', function ($group) {
        $group->get('/lista', [AlumnoController::class, 'lista']);
        $group->get('/nuevo', [AlumnoController::class, 'nuevo']);
        $group->post('/guardar', [AlumnoController::class, 'guardar']);
        $group->get('/editar/{id}', [AlumnoController::class, 'editar']);
        $group->post('/actualizar/{id}', [AlumnoController::class, 'actualizar']);
        $group->get('/eliminar/{id}', [AlumnoController::class, 'eliminar']);
    });

        // ==== GRUPO CURSOS ====
    $app->group('/cursos', function ($group) {
        $group->get('/lista', [CursoController::class, 'lista']);
        $group->get('/nuevo', [CursoController::class, 'nuevo']);
        $group->post('/guardar', [CursoController::class, 'guardar']);
        $group->get('/editar/{id}', [CursoController::class, 'editar']);
        $group->post('/actualizar/{id}', [CursoController::class, 'actualizar']);
        $group->get('/eliminar/{id}', [CursoController::class, 'eliminar']);
    });
};

