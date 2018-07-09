<?php
require_once 'tipocateg.control.php';
require_once 'tipocateg.model.php';
require_once '../database.php';


// Logica
$cat = new tipocateg();
$model = new catetgoriaModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'Actualizar':
			
            $cat->__SET('nomCat',              $_REQUEST['nomCat']);
            $cat->__SET('descr_cat',                $_REQUEST['descr_cat']);

			$model->Actualizar_cat($cat);
			header('Location: tipocateg.vista.php');
			break;

		case 'Guardar':
		  
            $cat->__SET('nomCat',              $_REQUEST['nomCat']);
            $cat->__SET('descr_cat',                $_REQUEST['descr_cat']);
			$model->Guardar_cat($cat);
			header('Location: tipocateg.vista.php');
			break;

// Instancia la clase eliminar que se encuentra al final de cada registro//

		case 'eliminar':
			$model->Eliminar_cat($_REQUEST['nomCat']);
			header('Location: tipocateg.vista.php');
			break;

// Instancia la clase editar que se encuentra al final de cada registr
		case 'editar':
			$cat = $model->Obtener_cat($_REQUEST['nomCat']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>ALIANZA ELITE</title>
       
   

    <link rel="stylesheet" type="text/css" href="">
	</head>
    <body>

<div class="tipocateg">
    <div class="titulo_formulario">
        <h1>Categoria</h1>
    </div>
    <form action="" class="formulario" method="post">
    <input type="text" name="nomCat" value="<?php echo  $cat->__GET('nomCat'); ?>">
    <input type="text" name="descr_cat" value="<?php echo  $cat->__GET('descr_cat'); ?>">
    <input type="submit"value="Guardar"onclick="this.form.action = '?action=Guardar';">
    <input type="submit"value="Actualizar"onclick="this.form.action = '?action=Actualizar';">
    </form>

</div>
<!-- <div class="container">
        <h2>TIPO DOCUMENTO </h2>
    <div class="panel panel-primary">
      <div class="panel-heading">FORMULARIO NUEVO TIPO DOCUMENTO</div>
        <div class="panel-body">                   
                
<form action="" method="post">                
                                          
    
    <div class="form-group">

            <label>Codigo Tipo Documento</label>
            <input type="text" name="nomCat" value="<?php echo $cat->__GET('nomCat'); ?>" class="form-control" placeholder="Codigo Tipo Documento" required>
                        
    </div>

     <div class="form-group">

            <label>Descripcion Tipo Documento</label>
            <input type="text" name="desc_cat" value="<?php echo $cat->__GET('desc_cat'); ?>" class="form-control" placeholder="Descripcion Tipo Documento" required></td>
    
    </div>

   
    <div class="form-group">

            <input type="submit" class="btn btn-primary" value= "Guardar" onclick = "this.form.action = '?action=registrar';" />

            <input type="submit" class="btn btn-success" value= "Actualizar" onclick = "this.form.action = '?action=actualizar';" />
    </div>

</form>
    </div>
  </div>
</div>       
-->
    <div class="container">
    <h2> CONSULTA - REGISTROS</h2>
                <table class="table table-striped">
                    <thead>
                        <tr class="info">
                            <th> Nombre Categoria</th>
                            <th> descripcion categoria</th>
                           
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar_cat() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nomCat'); ?></td>
                            <td><?php echo $r->__GET('descr_cat'); ?></td>
                            
                            <td>
                                <a href="?action=editar&nomCat=<?php echo $r->nomCat; ?>" class="btn btn-warning">Editar</a>
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