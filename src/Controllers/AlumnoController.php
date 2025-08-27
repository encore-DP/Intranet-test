<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\AlumnoModel;
use App\Models\EmpresaModel;

class AlumnoController {
    private $model;

    public function __construct() {
        $this->model = new AlumnoModel();
    }

    // 📄 Listar alumnos
    public function lista(Request $request, Response $response, array $args = []): Response {
    $alumnos = $this->model->listar();
    ob_start();
    include __DIR__ . "/../Views/alumnos/lista.php";
    $html = ob_get_clean();
    $response->getBody()->write($html);
    return $response;
    }
    
    // 📄 Formulario nuevo alumno
    public function nuevo(Request $request, Response $response): Response {
        $empresas = (new EmpresaModel())->listar();   // <- reusa tu modelo
        $basePath = rtrim(dirname($request->getUri()->getPath()), '/');

        ob_start();
        include __DIR__ . '/../Views/alumnos/nuevo.php'; // la vista verá $empresas
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    // 💾 Guardar alumno nuevo
    public function guardar(Request $request, Response $response) {
        $params = (array) $request->getParsedBody();
        $this->model->insertar($params['dni'], $params['nombre'], $params['apellido'], $params['empresa_id']);
        return $response->withHeader('Location', '/alumnos/lista')->withStatus(302);
    }

    // 📄 Formulario editar alumno
    public function editar(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $alumno = $this->model->buscarPorId($id); // 🔹 Necesitamos agregar este método en el modelo
        ob_start();
        include __DIR__ . "/../Views/alumnos/editar.php";
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // 💾 Actualizar alumno
    public function actualizar(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $params = (array) $request->getParsedBody();
        $this->model->editar($id, $params['dni'], $params['nombre'], $params['apellido'], $params['empresa_id']);
        return $response->withHeader('Location', '/alumnos/lista')->withStatus(302);
    }

    // 🗑 Eliminar alumno
    public function eliminar(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $this->model->eliminar($id);
        return $response->withHeader('Location', '/alumnos/lista')->withStatus(302);
    }
}

