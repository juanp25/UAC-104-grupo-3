<?php
class TEjercicioModel
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

			$stm = $this->pdo->prepare("SELECT * FROM t_ejercicio");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new TEjercicio();

				$alm->__SET('nom_tip', $r->nom_tip);
				$alm->__SET('descrEjer', $r->descrEjer);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($nom_tip)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM t_ejercicio WHERE nom_tip = ?");
			          

			$stm->execute(array($nom_tip));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new TEjercicio();

			$alm->__SET('nom_tip', $r->nom_tip);
			$alm->__SET('descrEjer', $r->descrEjer);
			

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($nom_tip)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM t_ejercicio WHERE nom_tip = ?");			          

			$stm->execute(array($nom_tip));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(TEjercicio $data)
	{
		try 
		{
			$sql = "UPDATE t_ejercicio SET 
						nom_tip          = ?, 
						escrEjer        = ?
												
				    WHERE nom_tip = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nom_tip'), 
					$data->__GET('escrEjer'),
					$data->__GET('nom_tip')

					
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(TEjercicio $data)
	{
		try 
		{
		$sql = "INSERT INTO t_ejercicio (nom_tip,descrEjer) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nom_tip'), 
				$data->__GET('descrEjer')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>