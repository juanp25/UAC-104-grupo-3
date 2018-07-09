<?php
class catetgoriaModel
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
	
	public function Listar_cat()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM catetgoria");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cat = new  tipocateg();

				$cat->__SET('nomCat', $r->nomCat);
				$cat->__SET('descr_cat', $r->descr_cat);
			

				$result[] = $cat;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener_cat($nomCat)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM catetgoria WHERE nomCat = ?");
			          

			$stm->execute(array($nomCat));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$cat = new  tipocateg();

				$cat->__SET('nomCat', $r->nomCat);
				$cat->__SET('descr_cat', $r->descr_cat);
				

			return $cat;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar_cat($nomCat)
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

	public function Actualizar_cat( tipocateg $data)
	{
		try 
		{

			$sql = "UPDATE catetgoria SET 
							nomCat        = ?, 
							descr_cat       = ? 
				    WHERE 	nomCat 		= ?";

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

	public function Guardar_cat( tipocateg $data)
	{
		try 
		{

		$sql = "INSERT INTO catetgoria (nomCat, descr_cat) 
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