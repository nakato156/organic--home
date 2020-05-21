<?php
check_admin();
//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

if (isset($enviar)) {
	$categoria = clear($categoria);

	$q = mysqli_query($mysqli,"SELECT * FROM categorias WHERE categoria = '$categoria'");
	if (mysqli_num_rows($q)>0) {
		alert("Esta categoria ya existe");
		redir("");
	}else{
		mysqli_query($mysqli,"INSERT INTO categorias (categoria) VALUES ('$categoria')");
		alert("Categoria agregada exitosamente");
		redir("");
	}
}
if (isset($eliminar)) {
	$eliminar = clear($eliminar);
	mysqli_query($mysqli,"DELETE FROM categorias WHERE id = '$eliminar'");
	alert("categoria eliminada");
	redir("?p=agregar_categoria");
}
?>
<h3>Agregar categoria</h3>
<form method="post" action="">
	<div class="form-group">
		<input type="text" name="categoria" placeholder="categoria"/>
	</div>
	<div class="form-group">
		<button type="submit" class="icon-plus btn-primary" name="enviar">Agregar Categoria</button>
	</div>
</form>
<br>

<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Categoria</th>
		<th>Accion</th>
	</tr>
	<?php
	$q = mysqli_query($mysqli,"SELECT * FROM categorias ORDER BY categoria ASC");
	while ($r=mysqli_fetch_array($q)) {
		?>
			<tr>
				<td><?=$r['id' ]?></td>
				<td><?=$r['categoria']?></td>
				<td>
					<a class="icon-close" href="?p=agregar_categoria&eliminar=<?=$r['id']?>"></a>
				</td>
			</tr>
		<?php 
	}
	?>
</table>
