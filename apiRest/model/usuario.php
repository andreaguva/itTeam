<?php
require_once 'database.php';

class Usuario
{
	private $pdo;

	private $_suporttedFormats = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/PNG', 'image/JPEG', 'image/JPG'];
	public $id;
	public $nombre;
	public $apellido;
	public $edad;
	public $foto;
	public $tipo_documento;
	public $id_rol;

	public function __CONSTRUCT()
	{

		try {
			$this->pdo = Database::Conectar();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM usuario");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM usuario WHERE id = ?");


			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try {
			$stm = $this->pdo
				->prepare("DELETE FROM usuario WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try {
			$sql = "UPDATE usuario SET 
						nombre = ?, 
						apellido = ?,
						edad = ?, 
						foto = ?,
						tipo_documento = ?,
						id_rol = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->nombre,
						$data->apellido,
						$data->edad,
						$data->foto,
						$data->tipo_documento,
						$data->id_rol,
						$data->id
					)
				);
			return $data;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar($data)
	{
		try {
			$sql = "INSERT INTO usuario (nombre,apellido,edad,foto,tipo_documento,id_rol) 
		        VALUES (?, ?, ?, ?, ?, ?)";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->nombre,
						$data->apellido,
						$data->edad,
						$data->foto,
						$data->tipo_documento,
						$data->id_rol
					)

				);
			return true;
		} catch (Exception $e) {
			echo ($e->getMessage());
			die($e->getMessage());
		}
	}

	public function uploadFile($foto)
	{
		if (is_array($foto)) {

			if (in_array($foto['type'], $this->_suporttedFormats)) {
				move_uploaded_file($foto['tmp_name'], 'fotos/' . $foto['name']);
			} else {
				die('El archivo no es compatible');
			}
		} else {
			die('No se pudo subir el archivo');
		}
	}
}
