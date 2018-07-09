<?php
class RolModel
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


	// Funcion que permite mostrar o listar en una tabla los usuarios registrados//
	
	public function Listar_rol()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM rol");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$rol = new rol();

				$rol->__SET('nomRol', $r->nomRol);
				$rol->__SET('descrRol', $r->descrRol);
			

				$result[] = $rol;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener_rol($nomRol)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM rol WHERE nomRol = ?");

			          

			$stm->execute(array($nomRol));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$rol = new rol();

				$rol->__SET('nomRol', $r->nomRol);
				$rol->__SET('descrRol', $r->descrRol);
			

			return $rol;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar_rol($nomRol)
	{

		try {
			$stm = $this->pdo
			->prepare("DELETE FROM rol WHERE nomRol = ?");			         
			$stm->execute(array($nomRol));
		} 

		catch (Exception $e){
		die($e->getMessage());
		}
	}

	public function Actualizar_rol(rol $data)
	{
		try 
		{
			$sql = "UPDATE rol SET
						nomRol           = ?, 
						descrRol         = ? 
						
					
				    WHERE nomRol 		= ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('nomRol'), 
					$data->__GET('descrRol')
			
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Guardar_rol(rol $data)
	{
		try 
		{
		$sql = "INSERT INTO rol ('nomRol', 'descrRol' ) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nomRol'),
				$data->__GET('descrRol')
				
				
				)
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}