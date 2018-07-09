<?php
require_once 'objetivos.entidad.php';
require_once 'objetivos.model.php';

// Logica
$alm = new Objetivos();
$model = new ObjetivosModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idobjetivo',              $_REQUEST['idobjetivo']);
			$alm->__SET('objetivo',          $_REQUEST['objetivo']);
			

			$model->Actualizar($alm);
			header('Location: vistaObjetivos.php');
			break;

		case 'registrar':
			$alm->__SET('idobjetivo',          $_REQUEST['idobjetivo']);
			$alm->__SET('objetivo',        $_REQUEST['objetivo']);
			

			$model->Registrar($alm);
			header('Location: vistaObjetivos.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idobjetivo']);
			header('Location: vistaObjetivos.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idobjetivo']);
			break;
	}
}


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Objetivos</title>
        <link rel="stylesheet" href="">
	</head>
    <body style="padding:15px;">



        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idobjetivo > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idobjetivo" value="<?php echo $alm->__GET('idobjetivo'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">idObjetivo</th>
                            <td><input type="text" name="idobjetivo" value="<?php echo $alm->__GET('idobjetivo'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Objetivo</th>
                            <td><input type="text" name="objetivo" value="<?php echo $alm->__GET('objetivo'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">idobjetivo</th>
                            <th style="text-align:left;">Objetivo</th>
                           
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('idobjetivo'); ?></td>
                            <td><?php echo $r->__GET('objetivo'); ?></td>
                            
                            <td>
                                <a href="?action=editar&idobjetivo=<?php echo $r->idobjetivo; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idobjetivo=<?php echo $r->idobjetivo; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Objetivo?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>


    </body>
</html>