<?php
check_user("pagar");
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

// verificar si la compra es = 0 si lo es no ir a pagar
$id_cliente = clear($_SESSION['id_cliente']);
$q = mysqli_query($mysqli,"SELECT * FROM  carro WHERE id_cliente = '$id_cliente'");
$monto_total = 0;
while($r = mysqli_fetch_array($q)) {	
	$q2 = mysqli_query($mysqli,"SELECT * FROM productos WHERE id = '".$r['id_producto']."'");
	$r2 = mysqli_fetch_array($q2);

	$precioTotal = 0;
	if ($r2['oferta']>0) {
		if (strlen($r2['oferta'] == 1)) {
			$desc = "0.0".$r['oferta'];
		}else{
			$desc = "0.".$r2['oferta'];

		}
		$precioTotal = $r2['precio'] - ($r2['precio'] * $desc);
	}else{
		$precioTotal = $r2['precio'];
	}
	$nombre_producto = $r2['name'];
	$cantidad = $r ['cant'];
	$precio_unidad = $r2['precio'];
	$precio_total = $cantidad * $precioTotal;
	$imagen_producto = $r2['imagen'];
	$pTotal= $cantidad * $precioTotal;

	$monto_total = $monto_total + $precio_total;
}
if ($monto_total == 0) {
	redir("?p=carrito");
}
//si lo es :
if (isset($finalizar)) {

	$monto = clear($monto_total);

	$id_cliente = clear($_SESSION['id_cliente']);
	$q = mysqli_query($mysqli,"INSERT INTO compra (id_cliente,fecha,monto,estado) VALUES ('$id_cliente',NOW(),'$monto',0)");
	$sc = mysqli_query($mysqli, "SELECT * FROM compra WHERE id_cliente ='$id_cliente' ORDER BY id DESC LIMIT 1");
	$rc = mysqli_fetch_array($sc);

	$ultima_compra = $rc['id'];

	$q2 = mysqli_query($mysqli,"SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
	while ($r2=mysqli_fetch_array($q2)) {
		$sp = mysqli_query($mysqli,"SELECT * FROM productos WHERE id = '".$r2['id_producto']."'");
		$rp = mysqli_fetch_array($sp);

		$monto = $rp['precio'];

		mysqli_query($mysqli,"INSERT productos_compra (id_compra,id_producto,cantidad,monto ) VALUES ('$ultima_compra','".$r2['id_producto']."','".$r2['cant']."','$monto')");
	}
	mysqli_query($mysqli,"DELETE FROM carro WHERE id_cliente = '$id_cliente'");
	alert("Se ha finalizado la compra");
		// redir("?=productos");
}

$id_cliente = clear($_SESSION['id_cliente']);
$q = mysqli_query($mysqli,"SELECT * FROM  carro WHERE id_cliente = '$id_cliente'");
$monto_total = 0;
while($r = mysqli_fetch_array($q)) {	
	$q2 = mysqli_query($mysqli,"SELECT * FROM productos WHERE id = '".$r['id_producto']."'");
	$r2 = mysqli_fetch_array($q2);

	$precioTotal = 0;
	if ($r2['oferta']>0) {
		if (strlen($r2['oferta'] == 1)) {
			$desc = "0.0".$r['oferta'];
		}else{
			$desc = "0.".$r2['oferta'];

		}
		$precioTotal = $r2['precio'] - ($r2['precio'] * $desc);
	}else{
		$precioTotal = $r2['precio'];
	}
	$nombre_producto = $r2['name'];
	$cantidad = $r ['cant'];
	$precio_unidad = $r2['precio'];
	$precio_total = $cantidad * $precioTotal;
	$imagen_producto = $r2['imagen'];
	$pTotal= $cantidad * $precioTotal;

	$monto_total = $monto_total + $precio_total;
}

?>
<h2>Metodos de pago</h2>
<div>
	<p>Pagar en el momento de la entrega <i class="icon-check"></i></p>
	<form action="" method="post">
		<div class="datosPago">
			<input type="hidden" name="monto_total" value="<?=$monto_total?>">
			<label class="form-group">Ingrese su direccion</label>
			<input class="form-control" type="text" name="direccion">
			<label class="form-group">Ingrese una referencia (opcional)</label>
			<input class="form-control" type="text" name="referencia">
			<label class="form-group">Ingrese su nombre</label>
			<input class="form-control" type="text" name="nombre"><br>
			<button class="btn btn-primary" type="submit" name="finalizar">Finalizar compra</button>
		</div>
	</form>
	<div>Monto total:<b class="text"> <?=$monto_total?><?=$divisa?></b></div>
</div>