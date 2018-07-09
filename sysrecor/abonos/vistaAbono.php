<?php
require_once 'Abono.entidad.php';
require_once 'Abono.model.php';

// Logica
$alm = new Abono();
$model = new AbonoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idabonos',              $_REQUEST['idabonos']);
			$alm->__SET('valorAbono',          $_REQUEST['valorAbono']);
			$alm->__SET('saldo',        $_REQUEST['saldo']);
			

			$model->Actualizar($alm);
			header('Location: vistaAbono.php');
			break;

		case 'registrar':
			$alm->__SET('idabonos',          $_REQUEST['idabonos']);
			$alm->__SET('valorAbono',        $_REQUEST['valorAbono']);
			$alm->__SET('saldo',            $_REQUEST['saldo']);
			

			$model->Registrar($alm);
			header('Location: vistaAbono.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idabonos']);
			header('Location: vistaAbono.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idabonos']);
			break;
	}
}


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Abonos</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">



        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idabonos > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idabonos" value="<?php echo $alm->__GET('idabonos'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">idAbono</th>
                            <td><input type="text" name="idabonos" value="<?php echo $alm->__GET('idabonos'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">valor Abono</th>
                            <td><input type="text" name="valorAbono" value="<?php echo $alm->__GET('valorAbono'); ?>" style="width:100%;" /></td>
                        </tr>
                       
                            <th style="text-align:left;">Saldo</th>
                            <td><input type="text" name="saldo" value="<?php echo $alm->__GET('saldo'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">idAbono</th>
                            <th style="text-align:left;">Valor del abono</th>
                            <th style="text-align:left;">saldo pendiente</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('idabonos'); ?></td>
                            <td><?php echo $r->__GET('valorAbono'); ?></td>
                            <td><?php echo $r->__GET('saldo'); ?></td>
                            <td>
                                <a href="?action=editar&idabonos=<?php echo $r->idabonos; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idabonos=<?php echo $r->idabonos; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Registro?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>


    </body>
</html>