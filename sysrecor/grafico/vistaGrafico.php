<?php
require_once 'grafico.entidad.php';
require_once 'grafico.model.php';

// Logica
$alm = new Grafico();
$model = new GraficoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idgrafico',              $_REQUEST['idgrafico']);
			$alm->__SET('nomGragico',          $_REQUEST['nomGragico']);
			$alm->__SET('imagen',        $_REQUEST['imagen']);
			

			$model->Actualizar($alm);
			header('Location: vistaGrafico.php');
			break;

		case 'registrar':
			$alm->__SET('idgrafico',          $_REQUEST['idgrafico']);
			$alm->__SET('nomGragico',        $_REQUEST['nomGragico']);
			$alm->__SET('Simagen',            $_REQUEST['imagen']);
			

			$model->Registrar($alm);
			header('Location: vistaGrafico.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idgrafico']);
			header('Location: vistaGrafico.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idgrafico']);
			break;
	}
}


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>grafico</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">



        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idgrafico > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idgrafico" value="<?php echo $alm->__GET('idgrafico'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">idgrafico</th>
                            <td><input type="text" name="idgrafico" value="<?php echo $alm->__GET('idgrafico'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">nombre del grafico</th>
                            <td><input type="text" name="nomGragico" value="<?php echo $alm->__GET('nomGragico'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Grafico</th>
                            <td><input type="text" name="imagen" value="<?php echo $alm->__GET('imagen'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">idgrafico</th>
                            <th style="text-align:left;">nomGrafico</th>
                            <th style="text-align:left;">imagen</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('idgrafico'); ?></td>
                            <td><?php echo $r->__GET('nomGragico'); ?></td>
                            <td><?php echo $r->__GET('imagen'); ?></td>
                            <td>
                                <a href="?action=editar&idgrafico=<?php echo $r->idgrafico; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idgrafico=<?php echo $r->idgrafico; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>


    </body>
</html>