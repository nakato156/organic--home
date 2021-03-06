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
	<meta title="Organic Home">
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/estilosPag.css">
	<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css">
	<script type="text/javascript" href="bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" href="styles.css">
	<title>Organic Home</title>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="icon" type="image/jpg" href="img/ohicon1.png">
</head>
<body>
	<?php // <header> ?>
	<section class="cab">
		<div class="header">
			<h1 class="h1">Organic Home</h1>	
		</div>
		<nav>
			<section class="conteneddor N">
				<div class="menu">
					<a href="?p=principal">Principal</a>
					<a href="?p=productos">Productos</a>
					<a href="?p=ofertas">Ofertas</a>
					<?php
		 // Mostrar el nombre y el menu de salir solo si se ha iniciado sesion 
					?>
					<?php
					if(isset($_SESSION['id_cliente'])){

			// agregado
						?>
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
				<div class="hamb" style="color: rgb(0, 0, 0);">
					<i class="icon-bar"></i>
				</div>
			</section>
		</nav>
	</section>
	<section class="cuerpo">
		<?php
		if(file_exists("modulo/".$p.".php")) {
			include "modulo/".$p.".php";
		}else{
			include "404.php";
			echo "<a href='./'>Regresar</a></i>";
		}
		?>
		<?php //</header>?>
	</section>
	<footer class="footer">	
		<div class="redes">
			<a class="icon-blog" rel="nofollow" herf="https://organic--home.blogspot.com" target="_blank"></a>
		</div>
		<p>Todos los derechos reservados-Copyright &copy; <?=date("Y")?></p>
	</footer>
	<script src="js/main.js"></script>
</body>
</html>