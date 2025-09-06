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
    public function nuevo(Request $request, Response $response): Response {
        $categorias = $this->model->listarCategorias();
    
        ob_start();
        include __DIR__ . '/../Views/cursos/nuevo.php';
        $html = ob_get_clean();
    
        $response->getBody()->write($html);
        return $response;
    }
    

    // 💾 Guardar curso nuevo
    public function guardar(Request $request, Response $response): Response {
        $p = (array)$request->getParsedBody();

        $categoriaId = (int)($p['categoria_id'] ?? 0);
        $nombre      = trim($p['nombre'] ?? '');
        $modalidad   = trim($p['modalidad'] ?? '');
        // Normaliza horas: quita todo lo que no sea dígito y convierte a int
        $horasStr    = trim($p['horas'] ?? '');
        $horas       = (int)preg_replace('/\D+/', '', $horasStr);
        $descripcion = trim($p['descripcion'] ?? '');

        if ($categoriaId <= 0 || $nombre === '' || $modalidad === '' || $horas <= 0) {
            $response->getBody()->write('Faltan datos obligatorios del curso (revisa categoría, nombre, modalidad y horas).');
            return $response->withStatus(400);
        }

        $model = new \App\Models\CursoModel();
        $ok = $model->insertar($categoriaId, $nombre, $modalidad, $horas, $descripcion);

        if (!$ok) {
            $response->getBody()->write('No se pudo guardar el curso.');
            return $response->withStatus(500);
        }

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
