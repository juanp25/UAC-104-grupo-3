<?php
require_once 'rol.control.php';
require_once 'rol.model.php';
require_once '../database.php';


// Logica
$rol = new rol();
$model = new RolModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'Actualizar':
			$rol->__SET('nomRol',            $_REQUEST['nomRol']);
            $rol->__SET('descrRol',              $_REQUEST['descrRol']);
			
			$model->Actualizar_rol($rol);
			header('Location: rol.vista.php');
			break;

		case 'Guardar':
			$rol->__SET('nomRol',            $_REQUEST['nomRol']);
            $rol->__SET('descrRol',              $_REQUEST['descrRol']);
			
			$model->Guardar_rol($rol);
			header('Location: rol.vista.php');
			break;

// Instancia la clase eliminar que se encuentra al final de cada registro//

		case 'Eliminar':
			$model->Eliminar_rol($_REQUEST['nomRol']);
			header('Location: rol.vista.php');
			break;

// Instancia la clase editar que se encuentra al final de cada registr
		case 'Editar':
			$rol = $model->Obtener_rol($_REQUEST['nomRol']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Roles de Alianza Elite</title>
       
    <!-- CONEXION LOCAL BOOTSTRAP  -->

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"> 
	</head>
    <body>

<div class="container">
        <h2>Roles de Alianza Elite</h2>
    <div class="panel panel-primary">
      <div class="panel-heading">Formulario de Roles de Alianza Elite</div>
        <div class="panel-body">                   
                
<form action="" method="post">                
                                          

    

    <div class="form-group">
                           
            <label>Nombre del Rol</label>
            <input type="text" name="nomRol" value="<?php echo $rol->__GET('nomRol'); ?>" class="form-control" placeholder="Nombre del Rol" required>
    </div>

       <div class="form-group">
                           
            <label>Descripcion del Rol</label>
            <input type="text" name="descrRol" value="<?php echo $rol->__GET('descrRol'); ?>" class="form-control" placeholder="Descripcion del Rol" required>
    </div>

    

    <div class="form-group">

            <input type="submit" class="btn btn-primary" value= "Guardar" onclick = "this.form.action = '?action=Guardar_rol';" />

            <input type="submit" class="btn btn-success" value= "Actualizar" onclick = "this.form.action = '?action=Actualizar_rol';" />
    </div>

</form>
    </div>
  </div>
</div>       

    <div class="container">
    <h2> CONSULTA - REGISTROS - ROL</h2>
                <table class="table table-striped">
                    <thead>
                        <tr class="info">
                            <th>NomRol</th>
                            <th>DescrRol</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar_rol() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nomRol'); ?></td>
                            <td><?php echo $r->__GET('descrRol'); ?></td>
                            <td>
                                <a href="?action=Editar&nomRol=<?php echo $r->nomRol; ?>" class="btn btn-warning">Editar</a>
                            </td>
                            <td>
                                <a href="?action=Eliminar&nomRol=<?php echo $r->nomRol; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Rol?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
    </div>
        </div>

    </body>
</html>