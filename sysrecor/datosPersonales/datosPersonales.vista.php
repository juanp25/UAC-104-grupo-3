<?php
require_once 'datosPersonales.control.php';
require_once 'datosPersonales.model.php';
require_once '../database.php';

// Logica
$usu = new DatosPersonales();
$model = new DatosPersonalesModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$usu->__SET('Documento',            $_REQUEST['Documento']);
            $usu->__SET('PrimerNombre',            $_REQUEST['PrimerNombre']);
			$usu->__SET('SegundoNombre',          $_REQUEST['SegundoNombre']);
           	$usu->__SET('P_apellido',         $_REQUEST['P_apellido']);
            $usu->__SET('S_apellido',             $_REQUEST['S_apellido']);
            $usu->__SET('direccion',              $_REQUEST['direccion']);
            $usu->__SET('telefono',               $_REQUEST['telefono']);
            $usu->__SET('cod_doc',              $_REQUEST['cod_doc']);
           
			
			$model->Actualizar($usu);
			header('Location: datosPersonales.vista.php');
			break;

		case 'registrar':
			$usu->__SET('Documento',            $_REQUEST['Documento']);
            $usu->__SET('PrimerNombre',            $_REQUEST['PrimerNombre']);
			$usu->__SET('SegundoNombre',          $_REQUEST['SegundoNombre']);
           	$usu->__SET('P_apellido',         $_REQUEST['P_apellido']);
            $usu->__SET('S_apellido',             $_REQUEST['S_apellido']);
            $usu->__SET('direccion',              $_REQUEST['direccion']);
            $usu->__SET('telefono',               $_REQUEST['telefono']);
            $usu->__SET('cod_doc',              $_REQUEST['cod_doc']);
			
			$model->Registrar($usu);
			header('Location: datosPersonales.vista.php');
			break;

// Instancia la clase eliminar que se encuentra al final de cada registro//

		case 'eliminar':
			$model->Eliminar($_REQUEST['Documento']);
			header('Location: datosPersonales.vista.php');
			break;

// Instancia la clase editar que se encuentra al final de cada registr
		case 'editar':
			$usu = $model->Obtener($_REQUEST['Documento']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>datos Personales</title>
       
    <!-- CONEXION LOCAL BOOTSTRAP  -->

   <link rel="stylesheet" href=""> 
	</head>
    <body>
    <p><a href="../sesiones/entrenador.php">Regresar</a></p>
<div align="center">
     
        <h2>datos Personales</h2>
    
      <div class="panel-heading">FORMULARIO NUEVO USUARIO</div>
           
                          
                <form action="" method="post" >

                    
                    
                    <table class="table table-striped">
                    <div class="form-group">
                        
                           <tr>
                        <th>Tipo de Identificacion</th>
                        <td>
                             <select class="form-control" name="cod_doc" >
            <?php
                foreach ($db->query('SELECT * FROM t_documento') as $row) 
                {
                     echo '<option value="'. $row['cod_doc'] .'">'. $row['nomDoc'] . '</option>';;
                }
             ?>
             </select>
                            </td>
                        </tr>

                        <tr>
                            <th>Identificación</th>
                            <td><input type="number" name="Documento" value="<?php echo $usu->__GET('Documento'); ?>" class="form-control" placeholder="Inserte Identificación" required></td>
                        </tr>

                        <tr>
                            <th>Primer Nombre</th>
                            <td><input type="text" name="PrimerNombre" value="<?php echo $usu->__GET('PrimerNombre'); ?>" class="form-control" placeholder="Inserte Primer Nombre" required></td>
                        </tr>
                        <tr>
                            <th>Segundo Nombre</th>
                            <td><input type="text" name="SegundoNombre" value="<?php echo $usu->__GET('SegundoNombre'); ?>" class="form-control" placeholder="Inserte Segundo nombre" ></td>
                        </tr>
                       
                        <tr>
                            <th>Primer Apellido</th>
                            <td><input type="text" name="P_apellido" value="<?php echo $usu->__GET('P_apellido'); ?>" class="form-control" placeholder="Inserte Primer apellido" required></td>
                        </tr>

                        <tr>
                            <th>Segundo Apellido</th>
                            <td><input type="text" name="S_apellido" value="<?php echo $usu->__GET('S_apellido'); ?>" class="form-control" placeholder="Inserte Segundo apellido" ></td>
                        </tr>

                        <tr>
                            <th>Direccion</th>
                            <td><input type="text" name="direccion" value="<?php echo $usu->__GET('direccion'); ?>" class="form-control" placeholder="Inserte Direccion" required></td>
                        </tr>

                                            
                        <tr>
                          <th>Telefono</th>
                           <td><input type="text" name="telefono" value="<?php echo $usu->__GET('telefono'); ?>" class="form-control" placeholder="Inserte telefono" required></td>
                        </tr>
                       
                                               
                    
                  </table>
                    <input type="submit" class="btn btn-primary" value= "Guardar" onclick = "this.form.action = '?action=registrar';" />
                    <input type="submit" class="btn btn-success" value= "Actualizar" onclick = "this.form.action = '?action=actualizar';" />
                </form>
    
    <h2> CONSULTA - REGISTROS</h2>
                <table class="table table-striped">
                    <thead>
                        <tr class="info">
                            <th>Tipo_Identificación</th>
                            <th>Documento</th>
                            <th>Primer Nombre</th>
                            <th>Segundo Nombre</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('cod_doc'); ?></td>
                            <td><?php echo $r->__GET('Documento'); ?></td>
                            <td><?php echo $r->__GET('PrimerNombre'); ?></td>
                            <td><?php echo $r->__GET('SegundoNombre'); ?></td>
                            <td><?php echo $r->__GET('P_apellido'); ?></td>
                            <td><?php echo $r->__GET('S_apellido'); ?></td>
                            <td><?php echo $r->__GET('direccion'); ?></td>
                            <td><?php echo $r->__GET('telefono'); ?></td>
                            
                            <td>
                                <a href="?action=editar&Documento=<?php echo $r->Documento; ?>" class="btn btn-warning">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&Documento=<?php echo $r->Documento; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
    </div>
       

    </body>
</html>