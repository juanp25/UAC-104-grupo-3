<?php
class RolModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=ae', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM rol");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Rol();

				$alm->__SET('nomRol', $r->nomRol);
				$alm->__SET('descrRol', $r->descrRol);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($nomRol)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM rol WHERE nomRol = ?");
			          

			$stm->execute(array($nomRol));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Rol();

			$alm->__SET('nomRol', $r->nomRol);
			$alm->__SET('descrRol', $r->descrRol);
			

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($nomRol)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM rol WHERE nomRol = ?");			          

			$stm->execute(array($nomRol));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Rol $data)
	{
		try 
		{
			$sql = "UPDATE rol SET 
						nomRol          = ?, 
						descrRol        = ?
				    WHERE nomRol = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nomRol'), 
					$data->__GET('descrRol'),
					$data->__GET('nomRol')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Rol $data)
	{
		try 
		{
		$sql = "INSERT INTO rol (nomRol,descrRol) 
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
?>