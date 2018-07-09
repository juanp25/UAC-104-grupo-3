<?php
require_once 'tDocumento.entidad.php';
require_once 'tDocumento.model.php';

// Logica
$alm = new Tdocumento();
$model = new TDocumentoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('cod_doc',              $_REQUEST['cod_doc']);
			$alm->__SET('nomDoc',          $_REQUEST['nomDoc']);
			

			$model->Actualizar($alm);
			header('Location: vistaTdocumento.php');
			break;

		case 'registrar':
			$alm->__SET('cod_doc',              $_REQUEST['cod_doc']);
			$alm->__SET('nomDoc',          $_REQUEST['nomDoc']);
			

			$model->Registrar($alm);
			header('Location: vistaTdocumento.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['cod_doc']);
			header('Location: vistaTdocumento.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['cod_doc']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>tipo Documento</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->cod_doc > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="cod_doc" value="<?php echo $alm->__GET('cod_doc'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">codigo documento</th>
                            <td><input type="text" name="cod_doc" value="<?php echo $alm->__GET('cod_doc'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre documento</th>
                            <td><input type="text" name="nomDoc" value="<?php echo $alm->__GET('nomDoc'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Codigo Documento</th>
                            <th style="text-align:left;">Nombre Documento</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('cod_doc'); ?></td>
                            <td><?php echo $r->__GET('nomDoc'); ?></td>
                            
                            <td>
                                <a href="?action=editar&cod_doc=<?php echo $r->cod_doc; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&cod_doc=<?php echo $r->cod_doc; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>