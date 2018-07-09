<?php
class AbonoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM abonos");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Abono();

				$alm->__SET('idabonos', $r->idabonos);
				$alm->__SET('valorAbono', $r->valorAbono);
				$alm->__SET('saldo', $r->saldo);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idabonos)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM abonos WHERE idabonos = ?");
			          

			$stm->execute(array($idabonos));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Abono();

			$alm->__SET('idabonos', $r->idabonos);
			$alm->__SET('valorAbono', $r->valorAbono);
			$alm->__SET('saldo', $r->saldo);
			


			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idabonos)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM abonos WHERE idabonos = ?");			          

			$stm->execute(array($idabonos));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Abono $data)
	{
		try 
		{
			$sql = "UPDATE abonos SET 
						idabonos          = ?, 
						valorAbono        = ?,
						saldo            = ?
						
				    WHERE idabonos = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('idabonos'), 
					$data->__GET('valorAbono'), 
					$data->__GET('saldo'),
					$data->__GET('idabonos')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Abono $data)
	{
		try 
		{
		$sql = "INSERT INTO abonos (idabonos,valorAbono,saldo) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idabonos'), 
				$data->__GET('valorAbono'), 
				$data->__GET('saldo')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>