<?php
class GraficoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM grafico");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Grafico();

				$alm->__SET('idgrafico', $r->idgrafico);
				$alm->__SET('nomGragico', $r->nomGragico);
				$alm->__SET('imagen', $r->imagen);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idgrafico)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM grafico WHERE idgrafico = ?");
			          

			$stm->execute(array($idgrafico));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Grafico();

			$alm->__SET('idgrafico', $r->idgrafico);
			$alm->__SET('nomGragico', $r->nomGragico);
			$alm->__SET('imagen', $r->imagen);
			

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idgrafico)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM grafico WHERE idgrafico = ?");			          

			$stm->execute(array($idgrafico));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Grafico $data)
	{
		try 
		{
			$sql = "UPDATE grafico SET 
						idgrafico          = ?, 
						nomGragico        = ?,
						imagen            = ? 
						
				    WHERE idgrafico = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('idgrafico'), 
					$data->__GET('nomGragico'), 
					$data->__GET('imagen'),					
					$data->__GET('idgrafico')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Grafico $data)
	{
		try 
		{
		$sql = "INSERT INTO grafico (idgrafico,nomGragico,imagen) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idgrafico'), 
				$data->__GET('nomGragico'), 
				$data->__GET('imagen')
				
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>