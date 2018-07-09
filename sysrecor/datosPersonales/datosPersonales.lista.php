<?php
require_once 'datosPersonales.control.php';
require_once 'datosPersonales.model.php';
require_once '../database.php';
require_once("PHPPaging.lib.php");

// Logica
$usu = new DatosPersonales();
$model = new DatosPersonalesModel();
$db = database::conectar();
$pag = new PHPPaging;



?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>datos Personales</title>
       
    <!-- CONEXION LOCAL BOOTSTRAP  -->

   <link rel="stylesheet" href="estt.css"> 
	</head>
    <body>
<div align="center">
     
      
    
    <h2> CONSULTA - REGISTROS</h2>
              <div class="datagrid">
<table>
<thead>
<tr>
 <th>Tipo_Identificación</th>
 <th>Documento</th>
 <th>Primer Nombre</th>
 <th>Segundo Nombre</th>
 <th>Primer Apellido</th>
 <th>Segundo Apellido</th>
 <th>Direccion</th>
 <th>Telefono</th></tr>
</thead>
<tfoot>
<tr>
<td colspan="4">
<div id="paging">
<ul>
<li><a href="#">¡¡98</span></a></li>
<li><a href="#" class="active"><span>1</span></a></li>
<li><a href="#"><span>2</span></a></li>
<li><a href="#"><span>3</span></a></li>
<li><a href="#"><span>4</span></a></li>
<li><a href="#"><span>5</span></a></li>
<li><a href="#"><span>Next</span></a></li>
</ul>
</div>
</tr>
</tfoot>
<tbody>
 <?php foreach($model->Listar() as $r): ?>
                        <tr class="alt">
                            <td><?php echo $r->__GET('cod_doc'); ?></td>
                            <td><?php echo $r->__GET('Documento'); ?></td>
                            <td><?php echo $r->__GET('PrimerNombre'); ?></td>
                            <td><?php echo $r->__GET('SegundoNombre'); ?></td>
                            <td><?php echo $r->__GET('P_apellido'); ?></td>
                            <td><?php echo $r->__GET('S_apellido'); ?></td>
                            <td><?php echo $r->__GET('direccion'); ?></td>
                            <td><?php echo $r->__GET('telefono'); ?></td>
                            
                           
                        </tr>
                    <?php endforeach; ?>
</tbody>
</table><?php echo 'Paginas '.$prepare->fetchNavegacion(); ?>
</div>   
              
    </div>
       

    </body>
</html>
