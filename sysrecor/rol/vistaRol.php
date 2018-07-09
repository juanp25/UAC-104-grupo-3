
<?php

require_once 'rol.entidad.php';
require_once 'rol.model.php';

// Logica
$alm = new Rol();
$model = new RolModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('nomRol',              $_REQUEST['nomRol']);
			$alm->__SET('descrRol',          $_REQUEST['descrRol']);
			

			$model->Actualizar($alm);
			header('Location: vistaRol.php');
			break;

		case 'registrar':
			$alm->__SET('nomRol',              $_REQUEST['nomRol']);
			$alm->__SET('descrRol',          $_REQUEST['descrRol']);

			$model->Registrar($alm);
			header('Location: vistaRol.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['nomRol']);
			header('Location: vistaRol.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['nomRol']);
			break;
	}
}


?>

<!DOCTYPE html>
<meta charset="utf-8"/>
<html lang="en">
	<head>
		<title>Rol</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">



        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->nomRol > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="nomRol" value="<?php echo $alm->__GET('nomRol'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Rol</th>
                            <td><input type="text" name="nomRol" value="<?php echo $alm->__GET('nomRol'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="descrRol" value="<?php echo $alm->__GET('descrRol'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Rol</th>
                            <th style="text-align:left;">Descripcion</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nomRol'); ?></td>
                            <td><?php echo $r->__GET('descrRol'); ?></td>
                            
                            <td>
                                <a href="?action=editar&nomRol=<?php echo $r->nomRol; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&nomRol=<?php echo $r->nomRol; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Rol?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>


    </body>
</html>