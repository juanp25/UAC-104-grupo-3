<?php
class TDocumentoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM t_documento");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Tdocumento();

				$alm->__SET('cod_doc', $r->cod_doc);
				$alm->__SET('nomDoc', $r->nomDoc);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($cod_doc)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM t_documento WHERE cod_doc = ?");
			          

			$stm->execute(array($cod_doc));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Tdocumento();

			$alm->__SET('cod_doc', $r->cod_doc);
			$alm->__SET('nomDoc', $r->nomDoc);
			

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($cod_doc)
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
public function Actualizar(Tdocumento $data)
	{
		try 
		{
			$sql = "UPDATE t_documento SET 
						cod_doc          = ?, 
						nomDoc        = ?
						
				    WHERE cod_doc = ?";

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

	public function Registrar(Tdocumento $data)
	{
		try 
		{
		$sql = "INSERT INTO t_documento (cod_doc,nomDoc) 
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