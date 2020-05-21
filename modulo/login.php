<?php
if(isset($_SESSION['id_cliente'])) {
	redir("?p=principal");
}

if (isset($enviar)) {
	$username = clear($username);
	$password = clear($password);
	
	//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

	//consulta a la base de datos
	$q = mysqli_query( $mysqli,"SELECT * FROM cliente WHERE username='$username' and password ='$password'");

	if ($q->num_rows >0) { //verificar si existe el usuario
		$r = mysqli_fetch_array($q);
		$_SESSION['id_cliente'] = $r['id'];
		if(isset($return)){
			redir("?p=".$return);
		}else{
			redir("?p=productos");
		}
	}else{ //si no existe el usuario manda una alerta
		alert("los datos son incorrectos");
		redir("?p=login");
	}

}
	?>


	<center>
		<form method="post" action="">
			<div class="centrarLogin">
				<label><h2><i class="fa fa-key"></i>Iniciar sesion</h2></label>
				<div class="form">
					<input type="text" class="form-control" placeholder="Usuario" name="username"/>		
				</div>
				<div class="form">
					<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>
				<div class="form">
					<button class="btn" name="enviar" type="submit"><i class="sing"></i>ingresar</button>
				</div>
				<div class="form">
					<a href="?p=registro">Registrate</a>
				</div>
			</div>	
		</form>
	</center>

