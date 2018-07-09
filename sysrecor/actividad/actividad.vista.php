<?php
require_once 'actividad.control.php';
require_once 'actividad.model.php';
require_once '../database.php';

// Logica
$usu = new Actividad();
$model = new ActividadModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$usu->__SET('idactividad',            $_REQUEST['idactividad']);
            $usu->__SET('fecha',            $_REQUEST['fecha']);
			$usu->__SET('Comentario',          $_REQUEST['Comentario']);
           	$usu->__SET('duracion',         $_REQUEST['duracion']);
            $usu->__SET('nomCat',             $_REQUEST['nomCat']);
            $usu->__SET('idgrafico',             $_REQUEST['idgrafico']);
            $usu->__SET('Documento',             $_REQUEST['Documento']);
            $usu->__SET('idobjetivo',              $_REQUEST['idobjetivo']);
            $usu->__SET('idejercicio',               $_REQUEST['idejercicio']);
           
           
			
			$model->Actualizar($usu);
			header('Location: actividad.vista.php');
			break;

		case 'registrar':
			$usu->__SET('idactividad',            $_REQUEST['idactividad']);
            $usu->__SET('fecha',            $_REQUEST['fecha']);
			$usu->__SET('Comentario',          $_REQUEST['Comentario']);
           	$usu->__SET('duracion',         $_REQUEST['duracion']);
            $usu->__SET('nomCat',             $_REQUEST['nomCat']);
            $usu->__SET('idgrafico',             $_REQUEST['idgrafico']);
            $usu->__SET('Documento',             $_REQUEST['Documento']);
            $usu->__SET('idobjetivo',              $_REQUEST['idobjetivo']);
            $usu->__SET('idejercicio',               $_REQUEST['idejercicio']);
           
			
			$model->Registrar($usu);
			header('Location: actividad.vista.php');
			break;

// Instancia la clase eliminar que se encuentra al final de cada registro//

		case 'eliminar':
			$model->Eliminar($_REQUEST['idactividad']);
			header('Location: actividad.vista.php');
			break;

// Instancia la clase editar que se encuentra al final de cada registr
		case 'editar':
			$usu = $model->Obtener($_REQUEST['idactividad']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Actividades</title>
       
    <!-- CONEXION LOCAL BOOTSTRAP  -->

   <link rel="stylesheet" href=""> 
	</head>
    <body>
<div align="center">
     
        <h2>Actividad</h2>
    
      <div class="panel-heading">FORMULARIO NUEVA ACTIVIDAD</div>
           
                          
                <form action="" method="post" >

                    
                    
                    <table class="table table-striped">
                    <div class="form-group">
                        
                           

                        <tr>
                            <th>Id Actividad</th>
                            <td><input type="number" name="idactividad" value="<?php echo $usu->__GET('idactividad'); ?>" class="form-control" placeholder="Inserte Id de actividad" required></td>
                        </tr>

                        <tr>
                            <th>Fecha Actividad</th>
                            <td><input type="text" name="fecha" value="<?php echo $usu->__GET('fecha'); ?>" class="form-control" placeholder="Ingrese fecha" required></td>
                        </tr>
                        <tr>
                            <th>Comentario </th>
                            <td><input type="text" name="Comentario" value="<?php echo $usu->__GET('Comentario'); ?>" class="form-control" placeholder="Ingrese comentario" ></td>
                        </tr>
                       
                        <tr>
                            <th>Duracion</th>
                            <td><input type="text" name="duracion" value="<?php echo $usu->__GET('duracion'); ?>" class="form-control" placeholder="Ingrese  duracion de la actividad" required></td>
                        </tr>

                        

                        <tr>
                        <th>Categoria</th>
                        <td>
                             <select class="form-control" name="nomCat" >
            <?php
                foreach ($db->query('SELECT * FROM catetgoria') as $row) 
                {
                     echo '<option value="'. $row['nomCat'] .'">'. $row['nomCat'] . '</option>';;
                }
             ?>
             </select>
                            </td>
                        </tr>

                        <tr>
                        <th>idGrafico</th>
                        <td>
                             <select class="form-control" name="idgrafico" >
            <?php
                foreach ($db->query('SELECT * FROM grafico') as $row) 
                {
                     echo '<option value="'. $row['idgrafico'] .'">'. $row['idgrafico'] . '</option>';;
                }
             ?>
             </select>
                            </td>
                        </tr>

                        <tr>
                        <th>Documento</th>
                        <td>
                             <select class="form-control" name="cod_doc" >
            <?php
                foreach ($db->query('SELECT * FROM datospersonales') as $row) 
                {
                     echo '<option value="'. $row['Documento'] .'">'. $row['Documento'] . '</option>';;
                }
             ?>
             </select>
                            </td>
                        </tr>

                        <tr>
                        <th>Id Objetivo</th>
                        <td>
                             <select class="form-control" name="idobjetivo" >
            <?php
                foreach ($db->query('SELECT * FROM objetivos') as $row) 
                {
                     echo '<option value="'. $row['idobjetivo'] .'">'. $row['idobjetivo'] . '</option>';;
                }
             ?>
             </select>
                            </td>
                        </tr>

                        <tr>
                        <th>id Ejercicio</th>
                        <td>
                             <select class="form-control" name="idejercicio" >
            <?php
                foreach ($db->query('SELECT * FROM ejercicio') as $row) 
                {
                     echo '<option value="'. $row['idejercicio'] .'">'. $row['nom_ejercicio'] . '</option>';;
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
                            <th>Fecha</th>
                            <th>Comentario</th>
                            <th>Duracion</th>
                            <th>Categoria</th>
                            <th>Grafico</th>
                            <th>Documento</th>
                            <th>Objetivo</th>
                            <th>Ejercicio</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('fecha'); ?></td>
                            <td><?php echo $r->__GET('Comentario'); ?></td>
                            <td><?php echo $r->__GET('duracion'); ?></td>
                            <td><?php echo $r->__GET('nomCat'); ?></td>
                            <td><?php echo $r->__GET('idGrafico'); ?></td>
                            <td><?php echo $r->__GET('Documento'); ?></td>
                            <td><?php echo $r->__GET('idobjetivo'); ?></td>
                            <td><?php echo $r->__GET('idejercicio'); ?></td>
                            
                            <td>
                                <a href="?action=editar&idactividad=<?php echo $r->idactividad; ?>" class="btn btn-warning">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idactividad=<?php echo $r->idactividad; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de borrar la actividad?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
    </div>
       

    </body>
</html>