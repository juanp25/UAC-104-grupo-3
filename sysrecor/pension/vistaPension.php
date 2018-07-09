<?php
require_once 'Pension.entidad.php';
require_once 'Pension.model.php';

// Logica
$alm = new Pension();
$model = new PensionModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idpension',              $_REQUEST['idpension']);
			$alm->__SET('mes',          $_REQUEST['mes']);
			$alm->__SET('valor',        $_REQUEST['valor']);
			

			$model->Actualizar($alm);
			header('Location: vistaPension.php');
			break;

		case 'registrar':
			$alm->__SET('idpension',          $_REQUEST['idpension']);
			$alm->__SET('mes',        $_REQUEST['mes']);
			$alm->__SET('valor',            $_REQUEST['valor']);
			

			$model->Registrar($alm);
			header('Location: vistaPension.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idpension']);
			header('Location: vistaPension.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idpension']);
			break;
	}
}


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Pension</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">



        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idpension > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idpension" value="<?php echo $alm->__GET('idpension'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">idPension</th>
                            <td><input type="text" name="idpension" value="<?php echo $alm->__GET('idpension'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Mes</th>
                            <td><input type="text" name="mes" value="<?php echo $alm->__GET('mes'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Valor mes</th>
                            <td><input type="text" name="valor" value="<?php echo $alm->__GET('valor'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">IDpension</th>
                            <th style="text-align:left;">mes</th>
                            <th style="text-align:left;">Valor</th>
                           
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('idpension'); ?></td>
                            <td><?php echo $r->__GET('mes'); ?></td>
                            <td><?php echo $r->__GET('valor'); ?></td>
                            <td>
                                <a href="?action=editar&idpension=<?php echo $r->idpension; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idpension=<?php echo $r->idpension; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>


    </body>
</html>