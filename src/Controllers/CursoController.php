<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\CursoModel;

class CursoController {
    private $model;

    public function __construct() {
        $this->model = new CursoModel();
    }

    // 📄 Listar cursos
    public function lista(Request $request, Response $response) {
        $cursos = $this->model->listar();
        ob_start();
        include __DIR__ . "/../Views/cursos/lista.php";
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // 📄 Formulario nuevo curso
    public function nuevo(Request $request, Response $response) {
        ob_start();
        include __DIR__ . "/../Views/cursos/nuevo.php";
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // 💾 Guardar curso nuevo
    public function guardar(Request $request, Response $response) {
        $params = (array) $request->getParsedBody();
        $this->model->insertar(
            $params['categoria_id'],
            $params['nombre'],
            $params['modalidad'],
            $params['horas'],
            $params['descripcion']
        );
        return $response->withHeader('Location', '/cursos/lista')->withStatus(302);
    }

    // 📄 Formulario editar curso
    public function editar(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $curso = $this->model->buscarPorId($id);
        ob_start();
        include __DIR__ . "/../Views/cursos/editar.php";
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // 💾 Actualizar curso
    public function actualizar(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $params = (array) $request->getParsedBody();
        $this->model->editar(
            $id,
            $params['categoria_id'],
            $params['nombre'],
            $params['modalidad'],
            $params['horas'],
            $params['descripcion']
        );
        return $response->withHeader('Location', '/cursos/lista')->withStatus(302);
    }

    // 🗑 Eliminar curso
    public function eliminar(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $this->model->eliminar($id);
        return $response->withHeader('Location', '/cursos/lista')->withStatus(302);
    }
}
