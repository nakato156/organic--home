<?php
if (isset($enviar)) {
	$username = clear($username);
	$password = clear($password);
	
	//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

	//consulta a la base de datos
	$q = mysqli_query( $mysqli,"SELECT * FROM admin WHERE username='$username' and password ='$password'");

	if ($q->num_rows >0) { //verificar si existe el usuario
		$r = mysqli_fetch_array($q);
		$_SESSION['id'] = $r['id'];
		redir('/');
	}else{ //si no existe el usuario manda una alerta
		alert("los datos son incorrectos");
		redir("/");
	}

}

if (isset($_SESSION['id'])){ 	//si hay una sesion iniciada
	?>
	<a href="?p=agregar_producto">
		<button class="icon-plus btn btn-primary">Agregar Producto</button></a>	
	<a href="?p=agregar_categoria">
		<button class="icon-plus btn btn-primary">Agregar categoria</button></a>
	<a href="?p=manejar_tracking">
		<button class="icon-plus btn btn-warning">Manejar Tracking</button></a>	
	<?php 
}else{ 	//si noy hay una sesion uniciada
	?>
	<center>
		<form method="post" action="">
			<div class="centrarLogin">
				<label><h2><i class="fa fa-key"></i>Iniciar sesion como Administrador</h2></label>
				<div class="form">
					<input type="text" class="form-control" placeholder="Usuario" name="username"/>		
				</div>
				<div class="form">
					<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>
				<div class="form">
					<button class="btn" name="enviar" type="submit"><i class="sing"></i>ingresar</button>
				</div>
			</div>	
		</form>
	</center>
	<?php 
}
?>
