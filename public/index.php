<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use App\Controllers\CertificadoController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Si la app está en una subcarpeta, descomenta y ajusta:
// $app->setBasePath('/intranet-test/public');
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Cargar rutas
(require __DIR__ . '/../routes/web.php')($app);

$app->run();
