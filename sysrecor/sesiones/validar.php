
<?php


session_start();
	require("connect_db.php");

	$correo=$_POST['correo'];
	$clave=$_POST['clave'];

	//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
	$sql2=mysqli_query($mysqli,"SELECT * FROM usuario WHERE correo='$correo'");
	if($f2=mysqli_fetch_assoc($sql2))

	{
		if($clave==$f2['clave']){
			$_SESSION['correo']=$f2['correo'];
			$_SESSION['nomRol']=$f2['nomRol'];
			$_SESSION['Documento']=$f2['Documento'];

			echo '<script>alert("Sesion Iniciada")</script> ';
			echo "<script>location.href='admin.php'</script>";
		
		}
	}

	$sql=mysqli_query($mysqli,"SELECT * FROM usuario WHERE id_usuario='$correo'");
	if($f=mysqli_fetch_assoc($sql))

	{
		if($clave==$f['clave']){
			$_SESSION['correo']=$f['correo'];
			$_SESSION['nomRol']=$f['nomRol'];
			$_SESSION['Documento']=$f['Documento'];
			
            echo '<script>alert("Sesion iniciada")</script> ';
			header("Location: entrenador.php");
	}


		else{
			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
		?>

				<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=index.php">";
		<?php
		}
	}else{
		
		echo '<script>alert("ESTE USUARIO NO EXISTE, POR FAVOR REGISTRESE PARA PODER INGRESAR")</script> ';
		
		echo "<script>location.href='index.php'</script>";	?>



		<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=index.php">";
<?php 

	}

?>