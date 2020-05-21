<?php
check_admin();
//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

$id = clear($id);

$s = mysqli_query($mysqli,"SELECT * FROM compra WHERE id = '$id'");
$r = mysqli_fetch_array($s);

$sc = mysqli_query($mysqli,"SELECT * FROM  cliente WHERE id ='".$r['id_cliente']."'");
$rc = mysqli_fetch_array($sc);

$nombre = $rc['username'];
?>
<h3>Viendo compra de <span style="color: #7ea4f7;"><?=$nombre?></span></h3>

Fecha: <?=fecha($r['fecha'])?><br>
Monto: <?=number_format($r['monto'])?><?=$divisa?><br>
Estado: <?=estado($r['estado'])?><br>
<table class="table table-striped">
	<tr>
		<th>Producto</th>
		<th>Cantida</th>
		<th>Monto unit</th>
		<th>Desc</th>
		<th>Monto Total</th>
	</tr>
	<?php
		$sp = mysqli_query($mysqli, "SELECT * FROM productos_compra WHERE id_compra = '$id'");
		while ($rp = mysqli_fetch_array($sp)) {

			$sprod = mysqli_query($mysqli, "SELECT * FROM productos WHERE id = '".$rp['id_producto']."'");
			$rpro = mysqli_fetch_array($sprod);

			$name_producto = $rpro['name'];

			$pagototal = $r['monto'];

			//hace el descuento 
			$precioTotal = 0;
			if ($rpro['oferta']>0) {
				if (strlen($rpro['oferta'] == 1)) {
					$desc = "0.0".$r['oferta'];
				}else{
				$desc = "0.".$rpro['oferta'];
				
				}
				$precioTotal = $rpro['precio'] - ($rpro['precio'] * $desc);
			}else{
				$precioTotal = $rpro['precio'] * $rp['cantidad'];
			}
			?>
				<tr>
					<td><?=$name_producto?></td>
					<td><?=$rp['cantidad']?></td>
					<td><?=$rp['monto']?></td>
					<td><?=$rpro['oferta']?></td>
					<td><?=$precioTotal?></td>
				</tr>	
			<?php
		}
	?>
</table>
<h4>Total <?=$pagototal?><?=$divisa?></h4>