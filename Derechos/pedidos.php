<?php 
include("repartidores.php");
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
if (isset($eliminar)) {
	mysqli_query($mysqli,"DELETE FROM compra WHERE id = '$eliminar'");
	alert("Pedido completado");
	redir("?=pedidos");
}
if(isset($_SESSION['id_cliente'])) {
	redir("?p=principal");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pedidos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="pedi2.css">
	<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css">
	<script type="text/javascript" href="bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<link rel="stylesheet" href="./styles.css">
</head>
<body>
	<div class="title">
		<link rel="icon" type="image/jpg" href="img/ohicon1.png">
		<h2>Pedidos</h2>
	</div>
	<div class="refresh">
		<button type="button" id="actu" class="refrescar">Refrescar</button>
	</div>
	<table class="tabla table-striped">
			<tr>
				<th>Nombre</th>
				<th>pedido</th>
				<th></th>
				<th>lugar</th>
				<th>monto</th>
				<th>accion</th>
			</tr>
		<?php
		$cln = mysqli_query($mysqli,"SELECT * FROM cliente");
		$rcln = mysqli_fetch_array($cln);

		$cid = $rcln['id'];
		// is del cln y monto del pedido
		$id = mysqli_query($mysqli,"SELECT * FROM compra ");
		while($rc = mysqli_fetch_array($id)){

			$nm = $rc['id_cliente']; //nm cln
			$monto = $rc['monto']; 
			$ipd=['id_producto'];  //id del producto
			$receptor = $rc['receptor'];//quien recibe

			// pedido
			$consulta=mysqli_query($mysqli,"SELECT productos.id,productos.name,productos_compra.id_compra,productos_compra.cantidad,productos_compra.id_producto,compra.id, compra.fecha FROM compra INNER JOIN productos_compra INNER JOIN productos ON compra.id=productos_compra.id_compra WHERE compra.id_cliente='$nm' AND productos_compra.id_producto=productos.id");

			$nmpf="";
			// $cnt=
			$c=", ";
			while ($fila=mysqli_fetch_array($consulta)) {
				$cnt=$fila['cantidad'];
				$nmpf .=$fila['name']."(".$cnt.")".$c;

				$ida=$fila['fecha'];
				$iC=$fila['id'];
				
				//ajax
				// $arr[]=$fila;
			}
			//JSON
			// echo json_encode($arr);
		// lugar
			$lg=$rc['lugar'];
			?>
				<tr id="tr">
					<td><?="(".$iC.") ".$receptor?></td>
					<td><?=$nmpf?><td>
					<td><?=$lg?></td>
					<td><?=$monto?></td>
					<td><a href="?p=pedidos&eliminar=<?=$rc['id']?>">complete</a></td>
				</tr>
		<?php 
		date_default_timezone_set('America/Mexico_City');
		 $idn= date("M-d H:i");
		if ($ida>=$idn) {
				alert("nuevo pedido"." ".$idn);
				$ida=$idn;
			}else{
				$idn=clear($idn);
				$ida=clear($ida);
			}
		}
		?>
	</table>
</body>
<script>
	$(document).ready(function() {
		$("#actu").click(function(){
			$.ajax({
				url:"consulta.php",
				type:"POST",
				dataType:"json",
				succes:function(data){
					console.log(data)
				}
			})
		})	
	})
</script>
</html>