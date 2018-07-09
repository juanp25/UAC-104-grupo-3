<?php
require_once 'usuario.control.php';
require_once 'usuario.model.php';
require_once '../database.php';

// Logica
$usu = new Usuario();
$model = new UsuarioModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
    switch($_REQUEST['action'])
    {
        case 'actualizar':
            $usu->__SET('correo',            $_REQUEST['correo']);
            $usu->__SET('clave',            $_REQUEST['clave']);
            $usu->__SET('nomRol',          $_REQUEST['nomRol']);
            $usu->__SET('Documento',         $_REQUEST['Documento']);
           
           
            
            $model->Actualizar($usu);
            header('Location: usuario.vista.php');
            break;

        case 'registrar':
           $usu->__SET('correo',            $_REQUEST['correo']);
            $usu->__SET('clave',            $_REQUEST['clave']);
            $usu->__SET('nomRol',          $_REQUEST['nomRol']);
            $usu->__SET('Documento',         $_REQUEST['Documento']);



            $model->Registrar($usu);
            header('Location: usuario.vista.php');
            break;

// Instancia la clase eliminar que se encuentra al final de cada registro//

        case 'eliminar':
            $model->Eliminar($_REQUEST['correo']);
            header('Location: usuario.vista.php');
            break;

// Instancia la clase editar que se encuentra al final de cada registr
        case 'editar':
            $usu = $model->Obtener($_REQUEST['correo']);
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Crear usuario</title>
       
    <!-- CONEXION LOCAL BOOTSTRAP  -->

   <link rel="stylesheet" href=""> 
    </head>
    <body>
<div align="center">
     
        <h2>Crear usuario</h2>
    
      <div class="panel-heading">FORMULARIO NUEVO USUARIO</div>
           
                          
                <form action="" method="post" >

                    
                    
                    <table class="table table-striped">
                    <div class="form-group">
                        
                           <tr>
                        <th>Documento</th>
                        <td>
                             <select class="form-control" name="Documento" >
            <?php
                foreach ($db->query('SELECT * FROM datospersonales') as $row) 
                {
                     echo '<option value="'. $row['Documento'] .'">'. $row['Documento'] . '</option>';;
                }
             ?>
             </select>
                            </td>
                        </tr>

                        <tr>
                            <th>Rol</th>
                            <td>
                             <select class="form-control" name="nomRol" >
            <?php
                foreach ($db->query('SELECT * FROM Rol') as $row) 
                {
                     echo '<option value="'. $row['nomRol'] .'">'. $row['nomRol'] . '</option>';;
                }
             ?>
             </select>
                            </td>
                        </tr>

                        <tr>
                            <th>Correo</th>
                            <td><input type="mail" name="correo" value="<?php echo $usu->__GET('correo'); ?>" class="form-control" placeholder="Ingrese Correo" required></td>
                        </tr>
                        <tr>
                            <th>Clave</th>
                            <td><input type="text" name="clave" value="<?php echo $usu->__GET('clave'); ?>" class="form-control" placeholder="Ingrese clave" ></td>
                        </tr>                    
                                                        
                                           
                                               
                    
                  </table>
                    <input type="submit" class="btn btn-primary" value= "Guardar" onclick = "this.form.action = '?action=registrar';" />
                    <input type="submit" class="btn btn-success" value= "Actualizar" onclick = "this.form.action = '?action=actualizar';" />
                </form>
    
    <h2> CONSULTA - REGISTROS</h2>
                <table class="table table-striped">
                    <thead>
                        <tr class="info">
                            
                            <th>Documento</th>
                            <th>Rol</th>
                            <th>Clave</th>
                            <th>Correo</th>
                            
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            
                            <td><?php echo $r->__GET('Documento'); ?></td>
                            <td><?php echo $r->__GET('nomRol'); ?></td> 
                            <td><?php echo $r->__GET('clave'); ?></td>
                            <td><?php echo $r->__GET('correo'); ?></td>
                            
                            
                            <td>
                                <a href="?action=editar&correo=<?php echo $r->correo; ?>" class="btn btn-warning">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&correo=<?php echo $r->correo; ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>  
                <a href="../sesiones/entrenador.php"><h1>Regresar</h1></a>   
              
    </div>
       

    </body>
</html>