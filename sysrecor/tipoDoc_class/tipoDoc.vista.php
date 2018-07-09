<?php
require_once 'tipoDoc.control.php';
require_once 'tipoDoc.model.php';
require_once '../database.php';


// Logica
$tdoc = new tipoDoc();
$model = new tipoDocModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'Actualizar':
			
            $tdoc->__SET('cod_doc',              $_REQUEST['cod_doc']);
            $tdoc->__SET('nomDoc',                $_REQUEST['nomDoc']);

			$model->Actualizar_tdoc($tdoc);
			header('Location: tipoDoc.vista.php');
			break;

		case 'Guardar':
		  
            $tdoc->__SET('cod_doc',              $_REQUEST['cod_doc']);
            $tdoc->__SET('nomDoc',                $_REQUEST['nomDoc']);
			$model->Guardar_tdoc($tdoc);
			header('Location: tipoDoc.vista.php');
			break;

// Instancia la clase eliminar que se encuentra al final de cada registro//

		case 'eliminar':
			$model->Eliminar_tdoc($_REQUEST['cod_doc']);
			header('Location: tipoDoc.vista.php');
			break;

// Instancia la clase editar que se encuentra al final de cada registr
		case 'editar':
			$tdoc = $model->Obtener_tdoc($_REQUEST['cod_doc']);
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
                
                <form action="?action=<?php echo $tdoc->cod_doc > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="cod_doc" value="<?php echo $tdoc->__GET('cod_doc'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">codigo documento</th>
                            <td><input type="text" name="cod_doc" value="<?php echo $tdoc->__GET('cod_doc'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre documento</th>
                            <td><input type="text" name="nomDoc" value="<?php echo $tdoc->__GET('nomDoc'); ?>" style="width:100%;" /></td>
                        </tr>
                       
                        <tr>
                            <td colspan="2">
                                <input type="submit"value="Guardar"onclick="this.form.action = '?action=Guardar';">
                                <input type="submit"value="Actualizar"onclick="this.form.action = '?action=Actualizar';">
                            </td>
                        </tr>
                    </table>
                </form>

                
                
                            <?php echo $tdoc->__GET('cod_doc'); ?>

                               <h2> REGISTROS</h2>
                


                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr class="info">
                            <th> Codigo Documento</th>
                            <th> Nombre Documento</th>
                           
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar_tdoc() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('cod_doc'); ?></td>
                            <td><?php echo $r->__GET('nomDoc'); ?></td>
                            
                            <td>
                                <a href="?action=editar&cod_doc=<?php echo $r->cod_doc; ?>" class="btn btn-warning">Editar</a>
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