<?php

namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\EmpresaModel;

class EmpresaController {
    private $model;

    public function __construct() {
        $this->model = new EmpresaModel();
    }

    /** GET /empresas/lista */
    public function lista(Request $request, Response $response): Response {
        $empresas = $this->model->listar();

        ob_start();
        // Render sencillo (ajusta a tu motor de vistas si usas uno)
        include __DIR__ . '/../Views/empresas/lista.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    /** GET /empresas/nuevo */
    public function nuevo(Request $request, Response $response): Response {
        ob_start();
        include __DIR__ . '/../Views/empresas/nuevo.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    /** POST /empresas  (crear) */
    public function guardar(Request $request, Response $response): Response {
        $params = (array) $request->getParsedBody();
        $nombre = trim($params['nombre'] ?? '');
        $ruc    = trim($params['ruc'] ?? '');

        $this->model->insertar($nombre, $ruc);
        return $response->withHeader('Location', '/empresas/lista')->withStatus(302);
    }

    /** GET /empresas/{id}/editar (form) */
    public function editarVista(Request $request, Response $response, array $args): Response {
        $id = (int)$args['id'];
        $empresa = $this->model->buscarPorId($id);

        if (!$empresa) {
            $response->getBody()->write('Empresa no encontrada');
            return $response->withStatus(404);
        }

        ob_start();
        include __DIR__ . '/../Views/empresas/editar.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    /** POST /empresas/{id}/editar */
    public function editar(Request $request, Response $response, array $args): Response {
        $id = (int)$args['id'];
        $params = (array) $request->getParsedBody();
        $nombre = trim($params['nombre'] ?? '');
        $ruc    = trim($params['ruc'] ?? '');

        $this->model->editar($id, $nombre, $ruc);
        return $response->withHeader('Location', '/empresas/lista')->withStatus(302);
    }

    /** POST /empresas/{id}/eliminar */
    public function eliminar(Request $request, Response $response, array $args): Response {
        $id = (int)$args['id'];
        $this->model->eliminar($id);
        return $response->withHeader('Location', '/empresas/lista')->withStatus(302);
    }

}
?>