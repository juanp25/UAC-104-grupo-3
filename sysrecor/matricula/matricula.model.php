<?php
class MatriculaModel
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

			$stm = $this->pdo->prepare("SELECT matricula.`idmatricula`, `matricula`.`fecha`, `matricula`.`valorMatr`, `matricula`.`NomAcudiente`, `matricula`.`telAcudiente`, `matricula`.`edadAlumno`, `matricula`.`estado`, `abonos`.`idabonos`, `datospersonales`.`Documento` 
FROM `matricula`
LEFT JOIN `abonos` ON `matricula`.`idabonos` = `abonos`.`idabonos`
LEFT JOIN `datospersonales` ON `matricula`.`Documento` = `datospersonales`.`Documento` 
 WHERE idmatricula is not null ");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$usu = new Matricula();

				$usu->__SET('idmatricula', $r->idmatricula);
				$usu->__SET('fecha', $r->fecha);
				$usu->__SET('valorMatr', $r->valorMatr);
				$usu->__SET('NomAcudiente', $r->NomAcudiente);
				$usu->__SET('telAcudiente', $r->telAcudiente);
				$usu->__SET('edadAlumno', $r->edadAlumno);
				$usu->__SET('estado', $r->estado);
				$usu->__SET('idabonos', $r->idabonos);
				$usu->__SET('Documento', $r->Documento);
				

				$result[] = $usu;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idmatricula)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM matricula WHERE idmatricula = ? and idabonos = ? and Documento = ?");
			          

			$stm->execute(array($idmatricula));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$usu = new Matricula();

				$usu->__SET('idmatricula', $r->idmatricula);
				$usu->__SET('fecha', $r->fecha);
				$usu->__SET('valorMatr', $r->valorMatr);
				$usu->__SET('NomAcudiente', $r->NomAcudiente);
				$usu->__SET('telAcudiente', $r->telAcudiente);
				$usu->__SET('edadAlumno', $r->edadAlumno);
				$usu->__SET('estado', $r->estado);
				$usu->__SET('idabonos', $r->idabonos);
				$usu->__SET('Documento', $r->Documento);
				$usu->__SET('idmatricula', $r->idmatricula);
			return $usu;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idmatricula)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM matricula WHERE idmatricula = ?");			          

			$stm->execute(array($idmatricula));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Matricula $data)
	{
		try 
		{
			$sql = "UPDATE matricula SET 
						idmatricula          = ?, 
						fecha        = ?, 
						valorMatr        = ?,
						NomAcudiente          = ?, 
						telAcudiente        = ?,
						edadAlumno       = ?,
						estado       = ?, 
						idabonos       = ?,
						Documento       = ? 
				    WHERE idmatricula = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('idmatricula'), 
					$data->__GET('fecha'), 
					$data->__GET('valorMatr'),
					$data->__GET('NomAcudiente'),
					$data->__GET('telAcudiente'),  
					$data->__GET('edadAlumno'),
					$data->__GET('estado'),
					$data->__GET('idabonos'),
					$data->__GET('Documento'),
					$data->__GET('idmatricula')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Matricula $data)
	{
		try 
		{

		

		$sql = "INSERT INTO matricula (idmatricula, fecha, valorMatr, NomAcudiente, telAcudiente, edadAlumno, estado, idabonos, Documento) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idmatricula'),
				$data->__GET('fecha'), 
				$data->__GET('valorMatr'), 
				$data->__GET('NomAcudiente'),
				$data->__GET('telAcudiente'),
				$data->__GET('edadAlumno'), 
				$data->__GET('estado'),
				$data->__GET('idabonos'),
				$data->__GET('Documento')
				
				)
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}