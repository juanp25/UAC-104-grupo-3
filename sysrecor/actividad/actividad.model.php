<?php
class ActividadModel
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


	// Funcion que permite mostrar o listar en una tabla los alumnos registrados//
	
	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT actividad.`idactividad`, `actividad`.`fecha`, `actividad`.`Comentario`, `actividad`.`duracion`, `catetgoria`.`nomCat`, `grafico`.`idgrafico`, `datospersonales`.`Documento`, `objetivos`.`idobjetivo`, `ejercicio`.`idejercicio` 
FROM `actividad`
LEFT JOIN `catetgoria` ON `catetgoria`.`nomCat` = `actividad`.`nomCat`
LEFT JOIN `grafico` ON `grafico`.`idgrafico` = `actividad`.`idgrafico` 
LEFT JOIN `datospersonales` ON `datospersonales`.`Documento` = `actividad`.`Documento`
LEFT JOIN `objetivos` ON `objetivos`.`idobjetivos` = `actividad`.`idobjetivos`
LEFT JOIN `ejercicio` ON `ejercicio`.`idejercicio` = `actividad`.`idejercicio`
 WHERE Documento is not null ");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$usu = new DatosPersonales();

				$usu->__SET('idactividad', $r->idactividad);
				$usu->__SET('fecha', $r->fecha);
				$usu->__SET('Comentario', $r->Comentario);
				$usu->__SET('duracion', $r->duracion);
				$usu->__SET('nomCat', $r->nomCat);
				$usu->__SET('idgrafico', $r->idgrafico);
				$usu->__SET('Documento', $r->Documento);
				$usu->__SET('idobjetivo', $r->idobjetivo);
				$usu->__SET('idejercicio', $r->idejercicio);
				
				

				$result[] = $usu;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idactividad)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM actividad WHERE idactividad = ?");
			          

			$stm->execute(array($Documento));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$usu = new Actividad();

				$usu->__SET('idactividad', $r->idactividad);
				$usu->__SET('fecha', $r->fecha);
				$usu->__SET('Comentario', $r->Comentario);
				$usu->__SET('duracion', $r->duracion);
				$usu->__SET('nomCat', $r->nomCat);
				$usu->__SET('idgrafico', $r->idgrafico);
				$usu->__SET('Documento', $r->Documento);
				$usu->__SET('idobjetivo', $r->idobjetivo);
				$usu->__SET('idejercicio', $r->idejercicio);

			return $usu;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idactividad)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM actividad WHERE idactividad = ?");			          

			$stm->execute(array($idactividad));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Actividad $data)
	{
		try 
		{
			$sql = "UPDATE actividad SET 
						fecha          = ?, 
						Comentario        = ?, 
						duracion        = ?,
						nomCat          = ?, 
						idgrafico        = ?,
						Documento       = ?,
						idobjetivo       = ?,
						idejercicio       = ? 
				    WHERE idactividad = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('fecha'), 
					$data->__GET('Comentario'), 
					$data->__GET('duracion'),
					$data->__GET('nomCat'),
					$data->__GET('idgrafico'),  
					$data->__GET('Documento'),
					$data->__GET('idobjetivo'),
					$data->__GET('idejercicio'),
					$data->__GET('idactividad')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Actividad $data)
	{
		try 
		{

		

		$sql = "INSERT INTO actividad (idactividad, fecha, Comentario, duracion, nomCat, idgrafico, Documento, idobjetivo, idejercicio) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idactividad'),
				$data->__GET('fecha'), 
				$data->__GET('Comentario'), 
				$data->__GET('duracion'),
				$data->__GET('nomCat'),
				$data->__GET('idgrafico'), 
				$data->__GET('Documento'),
				$data->__GET('idobjetivo'),
				$data->__GET('idejercicio')
				
				)
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}