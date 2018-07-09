<?php
class DatosPersonalesModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
try {
          $this->pdo= database::conectar();    
        } catch (Exception $ex) {
            die($e->getMessage());
        }
  	}


	// Funcion que permite mostrar o listar en una tabla los alumnos registrados//
	
	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT t_documento.`cod_doc`, `datospersonales`.`Documento`, `datospersonales`.`PrimerNombre`, `datospersonales`.`SegundoNombre`, `datospersonales`.`P_apellido`, `datospersonales`.`S_apellido`, `datospersonales`.`direccion`, `datospersonales`.`telefono`
FROM `t_documento`
LEFT JOIN `datospersonales` ON `t_documento`.`cod_doc` = `datospersonales`.`cod_doc` 
 WHERE Documento is not null ");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$usu = new DatosPersonales();

				$usu->__SET('cod_doc', $r->cod_doc);
				$usu->__SET('Documento', $r->Documento);
				$usu->__SET('PrimerNombre', $r->PrimerNombre);
				$usu->__SET('SegundoNombre', $r->SegundoNombre);
				$usu->__SET('P_apellido', $r->P_apellido);
				$usu->__SET('S_apellido', $r->S_apellido);
				$usu->__SET('direccion', $r->direccion);
				$usu->__SET('telefono', $r->telefono);
				

				$result[] = $usu;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($Documento)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM datosPersonales WHERE Documento = ?");
			          

			$stm->execute(array($Documento));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$usu = new DatosPersonales();

				$usu->__SET('cod_doc', $r->cod_doc);
				$usu->__SET('Documento', $r->Documento);
				$usu->__SET('PrimerNombre', $r->PrimerNombre);
				$usu->__SET('SegundoNombre', $r->SegundoNombre);
				$usu->__SET('P_apellido', $r->P_apellido);
				$usu->__SET('S_apellido', $r->S_apellido);
				$usu->__SET('direccion', $r->direccion);
				$usu->__SET('telefono', $r->telefono);
				$usu->__SET('cod_doc', $r->cod_doc);

			return $usu;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($Documento)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM datospersonales WHERE Documento = ?");			          

			$stm->execute(array($Documento));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(DatosPersonales $data)
	{
		try 
		{
			$sql = "UPDATE datospersonales SET 
						PrimerNombre          = ?, 
						SegundoNombre        = ?, 
						P_apellido        = ?,
						S_apellido          = ?, 
						direccion        = ?,
						telefono       = ?,
						cod_doc       = ? 
				    WHERE Documento = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('PrimerNombre'), 
					$data->__GET('SegundoNombre'), 
					$data->__GET('P_apellido'),
					$data->__GET('S_apellido'),
					$data->__GET('direccion'),  
					$data->__GET('telefono'),
					$data->__GET('cod_doc'),
					$data->__GET('Documento')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(DatosPersonales $data)
	{
		try 
		{

		

		$sql = "INSERT INTO datospersonales (Documento, PrimerNombre, SegundoNombre, P_apellido, S_apellido, direccion, telefono, cod_doc) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Documento'),
				$data->__GET('PrimerNombre'), 
				$data->__GET('SegundoNombre'), 
				$data->__GET('P_apellido'),
				$data->__GET('S_apellido'),
				$data->__GET('direccion'), 
				$data->__GET('telefono'),
				$data->__GET('cod_doc')
				
				)
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}