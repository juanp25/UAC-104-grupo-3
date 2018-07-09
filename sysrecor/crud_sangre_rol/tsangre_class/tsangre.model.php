<?php
class tsangreModel
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
	
	public function Listar_tsangre()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tiposangre");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$tsangre = new tsangre();

				$tsangre->__SET('codTsangre', $r->codTsangre);
				$tsangre->__SET('nombreCompleto', $r->nombreCompleto);
			

				$result[] = $tsangre;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener_tsangre($codTsangre)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tiposangre WHERE codTsangre = ?");

			          

			$stm->execute(array($codTsangre));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$tsangre = new tsangre();

				$tsangre->__SET('codTsangre', $r->codTsangre);
				$tsangre->__SET('nombreCompleto', $r->nombreCompleto);
			

			return $tsangre;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar_tsangre($codTsangre)
	{

		try {
			$stm = $this->pdo
			->prepare("DELETE FROM tiposangre WHERE codTsangre = ?");			         
			$stm->execute(array($codTsangre));
		} 

		catch (Exception $e){
		die($e->getMessage());
		}
	}

	public function Actualizar_tsangre(tiposangre $data)
	{
		try 
		{
			$sql = "UPDATE tiposangre SET
						codTsangre           = ?, 
						nombreCompleto         = ? 
						
					
				    WHERE codTsangre 		= ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('codTsangre'), 
					$data->__GET('nombreCompleto')
			
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Guardar_tsangre(tiposangre $data)
	{
		try 
		{
		$sql = "INSERT INTO tiposangre ('codTsangre', 'nombreCompleto' ) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('codTsangre'),
				$data->__GET('nombreCompleto')
				
				
				)
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}