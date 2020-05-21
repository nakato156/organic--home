<?php
check_admin();
//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
// 0 recien comprado
// 1 preparando compra
// 2 en camino
// 3 despachado 
$s = mysqli_query($mysqli,"SELECT * FROM compra WHERE estado != 3");

if (isset($eliminar)) {
	$eliminar = clear($eliminar);

	mysqli_query($mysqli,"DELETE FROM productos_compra WHERE id = '$eliminar'");
	mysqli_query($mysqli,"DELETE FROM compra WHERE id = '$eliminar'");
	redir("?p=manejar_tracking");
}

?>
<h3>Trackings</h3>
<table class="table table-striped">
	<tr>
		<th>Cliente</th>
		<th>Fecha</th>
		<th>Monto</th>
		<th>Estado</th>
		<th>Acciones</th>
	</tr>	
<?php
	while ($r=mysqli_fetch_array($s)) {
$sc = mysqli_query($mysqli,"SELECT * FROM cliente WHERE id = '".$r['id_cliente']."'");
$rc = mysqli_fetch_array($sc);
$cliente = $rc['username'];

		if ($r['estado'] == 0) {
			$estado = "Iniciado";
		}elseif ($r['estado'] == 1) {
			$estado = "Preparando";
		}elseif ($r['estado'] == 2) {
			$estado = "Despachando";
		}elseif ($r['estado'] == 3) {
			$estado = "Listo";
		}else{
			$estado = "Indefinido";
		}

		$fecha = fecha($r['fecha']);

		?>
			<tr>
				<td><?=$cliente?></td>
				<td><?=$fecha?></td>
				<td><?=$r['monto']?><?=$divisa?></td>
				<td><?=$estado?></td>
				<td>
					<a href="?p=manejar_tracking&eliminar=<?=$r['id']?>">
						<i class="fa icon-close"></i>
					</a>
					&nbsp; &nbsp;
					<a href="?p=manejar_estado&id=<?=$r['id']?>">
						<i class="fa icon-edit"></i>
					</a>
					&nbsp; &nbsp;
					<a href="?p=ver_compra&id=<?=$r['id']?>">
						<i class="fa icon-eye"></i>
					</a>
				</td>
			</tr>
		<?php
	}
?>
</table>