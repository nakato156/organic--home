<?php
check_admin();
//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

$id = clear($id);
$s = mysqli_query($mysqli,"SELECT *FROM compra WHERE id = '$id'");
$r = mysqli_fetch_array($s);

if (isset($modificar)) {
	$estado = clear($estado);
	mysqli_query($mysqli,"UPDATE compra SET estado = '$estado' WHERE id = '$id'");
	redir("?p=manejar_tracking");
}
?>
<h3>Manejar Estado</h3>
<br>
<form method="post" action="">
	<div class="form-group">
		<select class="form-control" name="estado">
			<option <?php if ($r['estado'] == 0){echo "selected";} ?> value="0">Iniciado</option>
			<option <?php if ($r['estado'] == 1){echo "selected";} ?> value="1">Preparando</option>
			<option <?php if ($r['estado'] == 2){echo "selected";} ?> value="2">Despachando</option>
			<option <?php if ($r['estado'] == 3){echo "selected";} ?> value="3">Finalizado</option>
		</select>
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" value="set estado" name="modificar">
	</div>
</form>