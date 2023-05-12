<?php


require_once 'UsuariosController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$controller = new UsuariosController();
header('Content-Type: application/json');

// Comprobar el método de la solicitud y enrutar a la función correspondiente
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode($controller->Listar());
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requestBody = file_get_contents('php://input');
    $data = json_decode($requestBody);
    $controller->Registrar($data);
} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $requestBody = file_get_contents('php://input');
    $data = json_decode($requestBody);
    echo json_encode($controller->Actualizar($data));
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $controller->Eliminar($_SERVER['HTTP_ID']);
} else {
    // Método no permitido
    http_response_code(405);
    echo json_encode(array('mensaje' => 'Método no permitido'));
}
