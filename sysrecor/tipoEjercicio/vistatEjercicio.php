<?php
require_once 'tEjercicio.entidad.php';
require_once 'tEjercicio.model.php';

// Logica
$alm = new tEjercicio();
$model = new TEjercicioModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('nom_tip',              $_REQUEST['nom_tip']);
			$alm->__SET('descrEjer',          $_REQUEST['descrEjer']);
			

			$model->Actualizar($alm);
			header('Location: vistatEjercicio.php');
			break;

		case 'registrar':
			$alm->__SET('nom_tip',          $_REQUEST['nom_tip']);
			$alm->__SET('descrEjer',        $_REQUEST['descrEjer']);
			

			$model->Registrar($alm);
			header('Location: vistatEjercicio.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['nom_tip']);
			header('Location: vistatEjercicio.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['nom_tip']);
			break;
	}
}


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Anexsoft</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">



        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->nom_tip > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="nom_tip" value="<?php echo $alm->__GET('nom_tip'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre del ejercicio</th>
                            <td><input type="text" name="nom_tip" value="<?php echo $alm->__GET('nom_tip'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">descripcion</th>
                            <td><input type="text" name="descrEjer" value="<?php echo $alm->__GET('descrEjer'); ?>" style="width:100%;" /></td>
                        </tr>
                       
                       
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Nombre del ejercico</th>
                            <th style="text-align:left;">Descripcion del ejercicio</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nom_tip'); ?></td>
                            <td><?php echo $r->__GET('descrEjer'); ?></td>
                            
                            <td>
                                <a href="?action=editar&nom_tip=<?php echo $r->nom_tip; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&nom_tip=<?php echo $r->nom_tip; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Ejercicio?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>


    </body>
</html>