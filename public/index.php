<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// 1️⃣ Crear la aplicación
$app = AppFactory::create();

// 2️⃣ Agregar middlewares
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// 3️⃣ Cargar rutas
(require __DIR__ . '/../routes/web.php')($app);

// 4️⃣ Ejecutar la app
$app->run();
