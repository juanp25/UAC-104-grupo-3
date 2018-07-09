<?php
require_once 'Catetgoria.entidad.php';
require_once 'Catetgoria.model.php';

// Logica
$alm = new Categoria();
$model = new CategoriaModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('nomCat',              $_REQUEST['nomCat']);
			$alm->__SET('descr_cat',          $_REQUEST['descr_cat']);
			

			$model->Actualizar($alm);
			header('Location: vistaCatetgoria.php');
			break;

		case 'registrar':
			$alm->__SET('nomCat',          $_REQUEST['nomCat']);
			$alm->__SET('descr_cat',        $_REQUEST['descr_cat']);
			

			$model->Registrar($alm);
			header('Location: vistaCatetgoria.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['nomCat']);
			header('Location: vistaCatetgoria.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['nomCat']);
			break;
	}
}


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Categoria</title>
        <link rel="stylesheet" href="">
	</head>
    <body style="padding:15px;">



        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->nomCat > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="nomCat" value="<?php echo $alm->__GET('nomCat'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Categoria</th>
                            <td><input type="text" name="nomCat" value="<?php echo $alm->__GET('nomCat'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="descr_cat" value="<?php echo $alm->__GET('descr_cat'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Categoria</th>
                            <th style="text-align:left;">Descripcion</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nomCat'); ?></td>
                            <td><?php echo $r->__GET('descr_cat'); ?></td>
                           
                            
                            <td>
                                <a href="?action=editar&nomCat=<?php echo $r->nomCat; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&nomCat=<?php echo $r->nomCat; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>


    </body>
</html>