<?php
check_admin();
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

//guardar producto en la base de datos
if (isset($enviar)) {
 	# code...
	$name = clear($name);
	$precio = clear($precio);
	$oferta = clear($oferta);

 	$imagen = "";
    $descargable = " ";

	$imagen = "";
	$descargable = " ";
 	// cargar img del producto
	if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
 		# code...
		$imagen = $name.rand(0,1000).".png";
		move_uploaded_file($_FILES['imagen']['tmp_name'], "./productos/".$imagen);
	}
 	// cargar archivo virtual
         	if (is_uploaded_file($_FILES['descargable']['tmp_name'])) {
         		$descargable =$descargable.rand(0,1000).$_FILES['descargable']['name'];
         		move_uploaded_file($_FILES['descargable']['tmp_name'], "./ebook/".$descargable);
         	}
 	mysqli_query($mysqli, "INSERT INTO productos (name,precio,imagen,id_categoria,oferta,descargable) VALUES ('$name','$precio','$imagen','$categoria','$oferta','$descargable')");
 	alert("Producto agregado exitosamente");

	if (is_uploaded_file($_FILES['descargable']['tmp_name'])) {
		$descargable =$descargable.rand(0,1000).$_FILES['descargable']['name'];
		move_uploaded_file($_FILES['descargable']['tmp_name'], "./ebook/".$descargable);
	}
	mysqli_query($mysqli, "INSERT INTO productos (name,precio,imagen,id_categoria,oferta,descargable) VALUES ('$name','$precio','$imagen','$categoria','$oferta','$descargable')");
	alert("Producto agregado exitosamente");

 	// redir("?p=agregar_producto");
}
if(isset($eliminar)) {
	mysqli_query($mysqli,"DELETE FROM productos WHERE id ='$eliminar'");
	redir ("?p=agregar_producto");
}
?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="name" placeholder="Nombre del producto"/>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="precio" placeholder="Precio del producto"/>
	</div>

	<label>Imagen del producto</label>
	<div class="form-group">
		<input type="file" class="form-control" name="imagen" placeholder="Imagen del producto"/>
	</div>

	<div class="form-group">
		<select name="categoria" required class="form-control">
			<option value="">Selecione una categoria</option>
			<?php
			$q = mysqli_query($mysqli,"SELECT * FROM categorias ORDER BY id ASC");

			while ($r=mysqli_fetch_array($q)) {
				?>
				<option value="<?=$r['id']?>"><?=$r['categoria']?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<select name="oferta" class="form-control">
			<option value="0">0% de Descuento</option>
			<option value="5">5% de Descuento</option>
			<option value="10">10% de Descuento</option>
			<option value="15">15% de Descuento</option>
			<option value="20">20% de Descuento</option>
			<option value="25">25% de Descuento</option>
			<option value="30">30% de Descuento</option>
			<option value="35">35% de Descuento</option>
			<option value="40">40% de Descuento</option>
			<option value="45">45% de Descuento</option>
			<option value="50">50% de Descuento</option>
			<option value="55">55% de Descuento</option>
			<option value="60">60% de Descuento</option>
			<option value="65">65% de Descuento</option>
			<option value="70">70% de Descuento</option>
			<option value="75">75% de Descuento</option>
			<option value="80">80% de Descuento</option>
			<option value="85">85% de Descuento</option>
		</select>
	</div>

	<div class="form-group">
		<label>Agregar Producto Virtual</label>
		<input type="file" name="descargable" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="icon-plus" name="enviar">Agregar producto</button>
	</div>
</form>
<br>
<table class="table table-striped">
	<tr>
		<th>img</th>	
		<th>Nombre</th>
		<th>Precio</th>	
		<th>%Descuento</th>
		<th>P. Total</th>
		<th>categoria</th>		
		<th>Acciones</th>
	</tr>
	<?php
	$prod = mysqli_query($mysqli,"SELECT * FROM productos ORDER BY id DESC");
	while ($rp=mysqli_fetch_array($prod)) {
		$precioTotal = 0;

		$acat = mysqli_query($mysqli,"SELECT * FROM categorias WHERE id ='".$rp['id_categoria']."'");

		if (mysqli_num_rows($acat)>0) {
			$racat = mysqli_fetch_array($acat);
			$categoria = $racat['categoria'];
		}else{
			$categoria = "--";
		}
		if ($rp['oferta']>0) {
			if (strlen($rp['oferta'] == 1)) {
				$desc = "0.0".$rp['oferta'];
			}else{
				$desc = "0.".$rp['oferta'];
				
			}
			$precioTotal = $rp['precio'] - ($rp['precio'] * $desc);
		}else{
			$precioTotal = $rp['precio'];
		}
		?>
		<tr>
			<td><img src="productos/<?=$rp['imagen']?>" class="imagen_carro"/></td>
			<td><?=$rp['name']?></td>
			<td><?=$rp['precio']?></td>
			<td>
				<?php
				if ($rp['oferta']>0) {
					echo $rp['oferta']."% de Descuento";
				}else{
					echo "--";
				}
				?>
			</td>
			<td><?=$precioTotal?></td>
			<td><?=$categoria?></td>
			<td>
				<a href="?p=modificar_producto&id=<?=$rp['id']?>"><i class="icon-edit"></i></a>
				&nbsp;
				<a href="?p=agregar_producto&eliminar=<?=$rp['id']?>"><i class="icon-close"></i></a>
			</td>
		</tr>
		<?php	
	}
	?>
</table>