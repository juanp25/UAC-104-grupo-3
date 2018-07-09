<?php
class UsuarioModel
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

			$stm = $this->pdo->prepare("SELECT usuario.`correo`, `usuario`.`clave`, `rol`.`nomRol`, `datospersonales`.`Documento`
FROM `usuario`
LEFT JOIN `rol` ON `rol`.`nomRol` = `usuario`.`nomRol` 
LEFT JOIN `datospersonales` ON `datospersonales`.`Documento` = `usuario`.`Documento`
 WHERE correo is not null ");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$usu = new Usuario();

				$usu->__SET('correo', $r->correo);
				$usu->__SET('clave', $r->clave);
				$usu->__SET('nomRol', $r->nomRol);
				$usu->__SET('Documento', $r->Documento);
				
				

				$result[] = $usu;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($correo)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuario WHERE correo = ?");
			          

			$stm->execute(array($correo));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$usu = new Usuario();

				$usu->__SET('correo', $r->correo);
				$usu->__SET('clave', $r->clave);
				$usu->__SET('nomRol', $r->nomRol);
				$usu->__SET('Documento', $r->Documento);

			return $usu;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($correo)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM usuario WHERE correo = ?");			          

			$stm->execute(array($correo));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Usuario $data)
	{
		try 
		{
			$sql = "UPDATE usuario SET 
						correo          = ?, 
						clave        = ?, 
						nomRol        = ?,
						Documento          = ?
				    WHERE correo = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('correo'), 
					$data->__GET('clave'), 
					$data->__GET('nomRol'),
					$data->__GET('Documento'),
					$data->__GET('correo')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
		try 
		{

		

		$sql = "INSERT INTO usuario (correo, clave, nomRol, Documento) 
               VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('correo'),
				$data->__GET('clave'), 
				$data->__GET('nomRol'), 
				$data->__GET('Documento')
				
				)
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}