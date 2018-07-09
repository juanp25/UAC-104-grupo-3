<?php
require_once 'matricula.control.php';
require_once 'matricula.model.php';
require_once '../database.php';

// Logica
$usu = new Matricula();
$model = new MatriculaModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$usu->__SET('idmatricula',            $_REQUEST['idmatricula']);
            $usu->__SET('fecha',            $_REQUEST['fecha']);
			$usu->__SET('valorMatr',          $_REQUEST['valorMatr']);
           	$usu->__SET('NomAcudiente',         $_REQUEST['NomAcudiente']);
            $usu->__SET('telAcudiente',             $_REQUEST['telAcudiente']);
            $usu->__SET('edadAlumno',              $_REQUEST['edadAlumno']);
            $usu->__SET('estado',               $_REQUEST['estado']);
            $usu->__SET('idabonos',              $_REQUEST['idabonos']);
            $usu->__SET('Documento',              $_REQUEST['Documento']);
			
			$model->Actualizar($usu);
			header('Location: matricula.vista.php');
			break;

		case 'registrar':
			$usu->__SET('idmatricula',            $_REQUEST['idmatricula']);
            $usu->__SET('fecha',            $_REQUEST['fecha']);
			$usu->__SET('valorMatr',          $_REQUEST['valorMatr']);
           	$usu->__SET('NomAcudiente',         $_REQUEST['NomAcudiente']);
            $usu->__SET('telAcudiente',             $_REQUEST['telAcudiente']);
            $usu->__SET('edadAlumno',              $_REQUEST['edadAlumno']);
            $usu->__SET('estado',               $_REQUEST['estado']);
            $usu->__SET('idabonos',              $_REQUEST['idabonos']);
            $usu->__SET('Documento',              $_REQUEST['Documento']);
			
			$model->Registrar($usu);
			header('Location: matricula.vista.php');
			break;

// Instancia la clase eliminar que se encuentra al final de cada registro//

		case 'eliminar':
			$model->Eliminar($_REQUEST['idmatricula']);
			header('Location: matricula.vista.php');
			break;

// Instancia la clase editar que se encuentra al final de cada registr
		case 'editar':
			$usu = $model->Obtener($_REQUEST['idmatricula']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>matriculas</title>
       
    <!-- CONEXION LOCAL BOOTSTRAP  -->

   <link rel="stylesheet" href=""> 
	</head>
    <body>
<div align="center">
     
        <h2>Matriculas</h2>
    
      <div class="panel-heading">FORMULARIO MATRICULAS</div>
           
                          
                <form action="" method="post" >

                    
                    
                    <table class="table table-striped">
                    <div class="form-group">
                        
                           
                        <tr>
                            <th>idmatricula</th>
                            <td><input type="number" name="idmatricula" value="<?php echo $usu->__GET('idmatricula'); ?>" class="form-control" placeholder="Inserte id de matricula" required></td>
                        </tr>

                        <tr>
                            <th>Fecha</th>
                            <td><input type="text" name="fecha" value="<?php echo $usu->__GET('fecha'); ?>" class="form-control" placeholder="dd/mm/aa" required></td>
                        </tr>
                        <tr>
                            <th>Valor Matricula</th>
                            <td><input type="number" name="valorMatr" value="<?php echo $usu->__GET('valorMatr'); ?>" class="form-control" placeholder="ingrese valor de matricula" ></td>
                        </tr>
                       
                        <tr>
                            <th>Nombre Acudiente</th>
                            <td><input type="text" name="NomAcudiente" value="<?php echo $usu->__GET('NomAcudiente'); ?>" class="form-control" placeholder="Ingrese nombre del acudiente" required></td>
                        </tr>

                        <tr>
                            <th>Telefono Acudiente</th>
                            <td><input type="number" name="telAcudiente" value="<?php echo $usu->__GET('telAcudiente'); ?>" class="form-control" placeholder="ingrese telefono del acudiente" ></td>
                        </tr>

                        <tr>
                            <th>Edad Alumno</th>
                            <td><input type="number" name="edadAlumno" value="<?php echo $usu->__GET('edadAlumno'); ?>" class="form-control" placeholder="INGRESE EDAD DEL ALUMNO" required></td>
                        </tr>

                         <tr>
                            <th>Estado</th>
                            <td>
                            	
                                <input type="radio" name="estado" value="1" checked>Activo
                                 <input type="radio" name="estado" value="0">Inactivo         

                            </td>
                        </tr>

                                            
                        <tr>
                          <th>Abono</th>
                           <td>
                           	<select class="form-control" name="idabonos" >
            <?php
                foreach ($db->query('SELECT * FROM abonos') as $row) 
                {
                     echo '<option value="'. $row['idabonos'] .'">'. $row['valorAbono'] . '</option>';;
                }
             ?>
             </select>

                           </td>
                        </tr>
                         <tr>
                          <th>Documento Alumno</th>
                           <td>
                           	<select class="form-control" name="Documento" >
            <?php
                foreach ($db->query('SELECT * FROM Datospersonales') as $row) 
                {
                     echo '<option value="'. $row['Documento'] .'">'. $row['Documento'] . '</option>';;
                }
             ?>
             </select>
                           	
                           </td>
                        </tr>
                       
                                               
                    
                  </table>
                    <input type="submit" class="btn btn-primary" value= "Guardar" onclick = "this.form.action = '?action=registrar';" />
                    <input type="submit" class="btn btn-success" value= "Actualizar" onclick = "this.form.action = '?action=actualizar';" />
                </form>
    
    <h2> CONSULTA - REGISTROS</h2>
                <table class="table table-striped">
                    <thead>
                        <tr class="info">
                            <th>idmatricula</th>
                            <th>fecha</th>
                            <th>Valor Matricula</th>
                            <th>Nombre del acudiente</th>
                            <th>Telefono del acudiente</th>
                            <th>Edad Alumno</th>
                            <th>Estado</th>
                            <th>Abono</th>
                            <th>Documento</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('idmatricula'); ?></td>
                            <td><?php echo $r->__GET('fecha'); ?></td>
                            <td><?php echo $r->__GET('valorMatr'); ?></td>
                            <td><?php echo $r->__GET('NomAcudiente'); ?></td>
                            <td><?php echo $r->__GET('telAcudiente'); ?></td>
                            <td><?php echo $r->__GET('edadAlumno'); ?></td>
                            <td><?php echo $r->__GET('estado'); ?></td>
                            <td><?php echo $r->__GET('idabonos'); ?></td>
                            <td><?php echo $r->__GET('Documento'); ?></td>
                            
                            <td>
                                <a href="?action=editar&idmatricula=<?php echo $r->idmatricula; ?>" class="btn btn-warning">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idmatricula=<?php echo $r->idmatricula; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar esta Matricula?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
    </div>
       

    </body>
</html>