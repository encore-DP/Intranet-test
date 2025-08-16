<?php
use Slim\App;
use App\Controllers\AlumnoController;


return function (App $app) {
    // Ruta principal modificada para cargar Views/index.php
    $app->get('/', function (Request $request, Response $response) {
        // Verificar conexi¨®n a BD primero
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=delcorbc_certiperu_intranet', 'delcorbc_encore', 'EncoreDP2025$$');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo = null; // Cerramos conexi¨®n despu¨¦s de verificar
            
            // Capturar el contenido de la vista
            ob_start();
            include __DIR__ . '/../src/Views/index.php';
            $html = ob_get_clean();
            
            $response->getBody()->write($html);
            return $response;
            
        } catch (PDOException $e) {
            $response->getBody()->write("Error de conexi¨®n a la base de datos");
            return $response->withStatus(500);
        }
    });

    // ==== GRUPO ALUMNOS ==== (Manteniendo todo igual)
    $app->group('/alumnos', function ($group) {
        $group->get('/lista', [AlumnoController::class, 'lista']);
    });


};