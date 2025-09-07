    <?php

    use Slim\App;
    use Slim\Routing\RouteCollectorProxy;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\Controllers\AlumnoController;
    use App\Controllers\CursoController;
    use App\Controllers\EmpresaController;
    use App\Controllers\CertificadoController;



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

            // Grupo de rutas: Empresa
        $app->group('/empresas', function (RouteCollectorProxy $group) {
            $group->get('/lista',  [EmpresaController::class, 'lista']);
            $group->get('/nuevo',  [EmpresaController::class, 'nuevo']);
            $group->post('',       [EmpresaController::class, 'guardar']);
            $group->get('/{id}/editar', [EmpresaController::class, 'editarVista']);
            $group->post('/{id}/editar', [EmpresaController::class, 'editar']);
            $group->post('/{id}/eliminar', [EmpresaController::class, 'eliminar']);
        });

                    // Grupo de rutas: Certificados
        $app->group('/certificados', function (RouteCollectorProxy $group) {
            $group->get('/lista',  [CertificadoController::class, 'lista']);
            $group->get('/nuevo',  [CertificadoController::class, 'nuevo']);
            $group->post('', [CertificadoController::class, 'guardar'])->setName('certificados.guardar');
        
            // (estos 3 pueden quedar por ahora sin implementar)
            $group->get('/{id}/editar', [CertificadoController::class, 'editarVista']);
            $group->post('/{id}/editar', [CertificadoController::class, 'editar']);
            $group->post('/{id}/eliminar', [CertificadoController::class, 'eliminar']);
            $group->post('/sync', [CertificadoController::class, 'sync'])->setName('certificados.sync');

        });
        
        
    };
