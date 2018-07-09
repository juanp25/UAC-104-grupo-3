<?php
require_once 'tsangre.control.php';
require_once 'tsangre.model.php';
require_once '../database.php';


// Logica
$tsangre = new tsangre();
$model = new tsangreModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'Actualizar':
			$tsangre->__SET('codTsangre',            $_REQUEST['codTsangre']);
            $tsangre->__SET('nombreCompleto',              $_REQUEST['nombreCompleto']);
			
			$model->Actualizar_tsangre($tsangre);
			header('Location: tsangre.vista.php');
			break;

		case 'Guardar':
			$tsangre->__SET('codTsangre',            $_REQUEST['codTsangre']);
            $tsangre->__SET('nombreCompleto',              $_REQUEST['nombreCompleto']);
			
			$model->Guardar_tsangre($tsangre);
			header('Location: tsangre.vista.php');
			break;

// Instancia la clase eliminar que se encuentra al final de cada registro//

		case 'Eliminar':
			$model->Eliminar_tsangre($_REQUEST['codTsangre']);
			break;

// Instancia la clase editar que se encuentra al final de cada registr
		case 'Editar':
			$tsangre = $model->Obtener_tsangre($_REQUEST['codTsangre']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Tipo de Sangre de Alianza Elite </title>
       
    <!-- CONEXION LOCAL BOOTSTRAP  -->

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"> 
	</head>
    <body>

<div class="container">
        <h2>Tipos de Sangre de Alianza Elite</h2>
    <div class="panel panel-primary">
      <div class="panel-heading">Formulario de Tipos de Sangre de Alianza Elite</div>
        <div class="panel-body">                   
                
<form action="" method="post">                
                                          

    

    <div class="form-group">
                           
            <label>Codigo de la Sangre</label>
            <input type="text" name="codTsangre" value="<?php echo $tsangre->__GET('codTsangre'); ?>" class="form-control" placeholder="Codigo de la Sangre" required>
    </div>

       <div class="form-group">
                           
            <label>Nombre de la Sangre</label>
            <input type="text" name="nombreCompleto" value="<?php echo $tsangre->__GET('nombreCompleto'); ?>" class="form-control" placeholder="Nombre de la Sangre" required>
    </div>

    

    <div class="form-group">

            <input type="submit" class="btn btn-primary" value= "Guardar" onclick = "this.form.action = '?action=Guardar_tsangre';" />

            <input type="submit" class="btn btn-success" value= "Actualizar" onclick = "this.form.action = '?action=Actualizar_tsangre';" />
    </div>

</form>
    </div>
  </div>
</div>       

    <div class="container">
    <h2> CONSULTA - SANGRE</h2>
                <table class="table table-striped">
                    <thead>
                        <tr class="info">
                            <th>CodTsangre</th>
                            <th>NombreCompleto</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar_tsangre() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('codTsangre'); ?></td>
                            <td><?php echo $r->__GET('nombreCompleto'); ?></td>
                            <td>
                                <a href="?action=Editar&codTsangre=<?php echo $r->codTsangre; ?>" class="btn btn-warning">Editar</a>
                            </td>
                            <td>
                                <a href="?action=Eliminar&codTsangre=<?php echo $r->codTsangre; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Rol?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
    </div>
        </div>

    </body>
</html>