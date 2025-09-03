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
    public function editarVista(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $alumno = $this->model->buscarPorId($id); // 🔹 Necesitamos agregar este método en el modelo
        $empresas = (new \App\Models\EmpresaModel())->listar();
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
        return $response->withHeader('Location', '/alumnos/lista?ok=updated')->withStatus(302);
    }

    // 🗑 Eliminar alumno
    public function eliminar(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $this->model->eliminar($id);
        return $response->withHeader('Location', '/alumnos/lista?ok=deleted')->withStatus(302);
    }

        /** POST /alumnos/{id}/editar */
    public function editar(Request $request, Response $response, array $args): Response
    {
        $id = (int)($args['id'] ?? 0);
        $p  = (array)$request->getParsedBody();

        $dni       = trim($p['dni'] ?? '');
        $nombre    = trim($p['nombre'] ?? '');
        $apellido  = trim($p['apellido'] ?? '');
        $empresaId = isset($p['empresa_id']) && $p['empresa_id'] !== '' ? (int)$p['empresa_id'] : 0;

        if ($id <= 0 || $dni === '' || $nombre === '' || $apellido === '' || $empresaId <= 0) {
            $response->getBody()->write('Faltan datos obligatorios');
            return $response->withStatus(400);
        }

        // usa tu SP editar_alumno
        $ok = $this->model->editar($id, $dni, $nombre, $apellido, $empresaId);
        if (!$ok) {
            $response->getBody()->write('No se pudo actualizar el alumno');
            return $response->withStatus(500);
        }

        // vuelve a la lista con flash por query
        return $response
            ->withHeader('Location', '/alumnos/lista?ok=updated')
            ->withStatus(302);
    }

}

