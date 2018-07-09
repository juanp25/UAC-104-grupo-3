<?php
class CategoriaModel
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

			$stm = $this->pdo->prepare("SELECT * FROM catetgoria");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Categoria();

				$alm->__SET('nomCat', $r->nomCat);
				$alm->__SET('descr_cat', $r->descr_cat);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($nomCat)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM catetgoria WHERE nomCat = ?");
			          

			$stm->execute(array($nomCat));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Categoria();

			$alm->__SET('nomCat', $r->nomCat);
			$alm->__SET('descr_cat', $r->descr_cat);
			

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($nomCat)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM catetgoria WHERE nomCat = ?");			          

			$stm->execute(array($nomCat));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Categoria $data)
	{
		try 
		{
			$sql = "UPDATE catetgoria SET 
						nomCat          = ?, 
						descr_cat        = ?
				    WHERE nomCat = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nomCat'), 
					$data->__GET('descr_cat'),
					$data->__GET('nomCat')
					
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Categoria $data)
	{
		try 
		{
		$sql = "INSERT INTO catetgoria (nomCat,descr_cat) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nomCat'), 
				$data->__GET('descr_cat')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>