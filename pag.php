<?php
include "configs/config.php";
include "configs/funciones.php";

if(!isset($p)) {
	$p = "principal";

}else {
	$p = $p;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/estilosPag.css">
	<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css">
	<script type="text/javascript" href="bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" href="styles.css">
	<title>Organic Home</title>
	<link rel="icon" type="image/jpg" href="img/ohicon1.png">
</head>
<body>
	<div class="header">
		Organic Home	
	</div>

	<div class="menu" style="">
		<a href="?p=principal">Principal</a>
		<a href="?p=productos">Productos</a>
		<a href="?p=ofertas">Ofertas</a>
		
		<!-- Mostrar el nombre y el menu de salir solo si se ha iniciado sesion -->
		<?php
		if(isset($_SESSION['id_cliente'])){
			?>
			<!-- agregado -->
			<a href="?p=carrito">Carrito</a> 
			<!-- pero si es admin tambien mostrar lo sgt-->
			<div class="carrito">
				<!-- y si solo es usuario mostrar lo sgt -->
				<!-- Mostrar el nombre y el menu de salir solo si se ha iniciado sesion -->

				<a class="nombre" href="#"><?=nombre_cliente($_SESSION['id_cliente'])?></a>
				<a href="?p=salir">Salir</a>
			</div>
			<?php
		}
		?>	
		<!--Mostrar el menu de agregar solo si es un administrador-->
		<?php
		if(isset($_SESSION['id'])){
			?>
			<a href="?p=$cambiar_1admin(P)">agregar</a>
			<a style="float: right;" href="?p=salir">Salir</a>
			<a class="nombre" style="float: right;" href="#"><?=nombre_cliente($_SESSION['id'])?></a> 
			<?php
		}
		?>
	</div>

	<div class="cuerpo">
		<?php
		if(file_exists("modulo/".$p.".php")) {
			include "modulo/".$p.".php";
		}else{
			include "404.php";
			echo "<a href='./'>Regresar</a></i>";
		}
		?>
	</div>
	<footer class="footer">
		
		<div class="redes">
			<a herf="organic--home.blogspot.com" class="icon-blog"></a>
		</div>

		Todos los derechos reservados-Copyright &copy; <?=date("Y")?>
	</footer>
</body>
</html>