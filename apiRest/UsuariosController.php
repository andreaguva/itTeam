<?php

require_once './model/usuario.php';

class UsuariosController {

    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    public function Listar() {
        $result = $this->usuario->Listar();

        if ($result !== null) {
            http_response_code(200);
            return $result;
        } else {
            http_response_code(404);
            echo json_encode(array('mensaje' => 'No se encontraron usuario'));
        }
    }

    public function Registrar($data) {

        if (!empty($data ->nombre) && !empty($data-> apellido) 
        && !empty($data->edad) && !empty($data->foto)
         && !empty($data->tipo_documento) && !empty($data->id_rol)) {
            $result = $this->usuario->Registrar($data);

            if ($result ) {
                http_response_code(200);
                echo json_encode("Creado exitosamente");            
            } else {
                http_response_code(500);
                echo json_encode(array('mensaje' => 'Error al crear el usuario'));
            }
        } else {
            http_response_code(400);
            echo json_encode(array('mensaje' => 'Datos incompletos'));
        }
    }


    public function Actualizar($data) {
        if (!empty($data->id)) {
            $usuario = $this->usuario->Actualizar($data);

            if ($usuario !== null) {
                http_response_code(200);
                echo json_encode(array('mensaje' => 'Usuario actualizado exitosamente', 'usuario' => $usuario));
            } else {
                http_response_code(500);
                echo json_encode(array('mensaje' => 'Error al actualizar el usuario'));
            }
        } else {
            http_response_code(400);
            echo json_encode(array('mensaje'));
        }
    }


    public function Eliminar($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($id!=null) {
            $this->usuario->Eliminar($id);

        
                http_response_code(200);
                echo json_encode(array('mensaje' => 'Usuario eliminado exitosamente'));

        } else {
            http_response_code(400);
            echo json_encode(array('mensaje'));
        }
    }



}

?>
