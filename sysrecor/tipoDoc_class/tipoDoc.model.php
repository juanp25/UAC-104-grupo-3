<?php
class tipoDocModel
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
	
	public function Listar_tdoc()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM t_documento");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$tdoc = new tipoDoc();

				$tdoc->__SET('cod_doc', $r->cod_doc);
				$tdoc->__SET('nomDoc', $r->nomDoc);
			

				$result[] = $tdoc;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener_tdoc($cod_doc)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM t_documento WHERE cod_doc = ?");
			          

			$stm->execute(array($cod_doc));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$tdoc = new tipoDoc();

				$tdoc->__SET('cod_doc', $r->cod_doc);
				$tdoc->__SET('nomDoc', $r->nomDoc);
				

			return $tdoc;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar_tdoc($cod_doc)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM t_documento WHERE cod_doc = ?");			          

			$stm->execute(array($cod_doc));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar_tdoc(tipoDoc $data)
	{
		try 
		{

			$sql = "UPDATE t_documento SET 
							cod_doc        = ?, 
							nomDoc       = ? 
				    WHERE 	cod_doc 		= ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
				
					$data->__GET('cod_doc'),
					$data->__GET('nomDoc'),
					$data->__GET('cod_doc')
					
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Guardar_tdoc(tipoDoc $data)
	{
		try 
		{

		$sql = "INSERT INTO t_documento (cod_doc, nomDoc) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
			
				$data->__GET('cod_doc'),
				$data->__GET('nomDoc')
				
				)
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}


