<?php
class ObjetivosModel
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

			$stm = $this->pdo->prepare("SELECT * FROM objetivos");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Objetivos();

				$alm->__SET('idobjetivo', $r->idobjetivo);
				$alm->__SET('objetivo', $r->objetivo);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idobjetivo)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM objetivos WHERE idobjetivo = ?");
			          

			$stm->execute(array($idobjetivo));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Objetivos();

			$alm->__SET('idobjetivo', $r->idobjetivo);
			$alm->__SET('objetivo', $r->objetivo);
			

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idobjetivo)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM objetivos WHERE idobjetivo = ?");			          

			$stm->execute(array($idobjetivo));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Objetivos $data)
	{
		try 
		{
			$sql = "UPDATE objetivos SET 
						idobjetivo          = ?, 
						objetivo        = ?
						
				    WHERE idobjetivo = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('idobjetivo'), 
					$data->__GET('objetivo'),
					$data->__GET('idobjetivo')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Objetivos $data)
	{
		try 
		{
		$sql = "INSERT INTO objetivos (idobjetivo,objetivo) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idobjetivo'), 
				$data->__GET('objetivo') 
				
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>