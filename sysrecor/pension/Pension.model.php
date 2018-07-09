<?php
class PensionModel
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

			$stm = $this->pdo->prepare("SELECT * FROM pension");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Pension();

				$alm->__SET('idpension', $r->idpension);
				$alm->__SET('mes', $r->mes);
				$alm->__SET('valor', $r->valor);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idpension)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM pension WHERE idpension = ?");
			          

			$stm->execute(array($idpension));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Pension();

			$alm->__SET('idpension', $r->idpension);
			$alm->__SET('mes', $r->mes);
			$alm->__SET('valor', $r->valor);
			

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idpension)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM pension WHERE idpension = ?");			          

			$stm->execute(array($idpension));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Pension $data)
	{
		try 
		{
			$sql = "UPDATE pension SET 
						idpension          = ?, 
						mes        = ?,
						valor            = ? 
						
				    WHERE idpension = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('idpension'), 
					$data->__GET('mes'), 
					$data->__GET('Sexo'),
					$data->__GET('idpension')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Pension $data)
	{
		try 
		{
		$sql = "INSERT INTO pension (idpension,mes,valor) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idpension'), 
				$data->__GET('mes'), 
				$data->__GET('valor')
				
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>