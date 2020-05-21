<?php
check_user("producto");
?>
<select id="Fcategoria" onchange="redir_cat()" class="form-control" >
	<option value="">Seleccione una categoria para filtrar</option>
	<?php
	$cate = mysqli_query($mysqli,"SELECT * FROM categorias ORDER BY categoria ASC");
	while ($rcat = mysqli_fetch_array($cate)) {
		?>
		<option value="<?=$rcat['id']?>"><?=$rcat['categoria']?></option>
		<?php
	}
	?>
</select>
<?php

if (isset($cat)) {
	$sc = mysqli_query($mysqli,"SELECT * FROM categorias WHERE id = '$cat'");
	$rc = mysqli_fetch_array($sc);
	?>
	<h6>Categoria filtrada por:&nbsp;<?=$rc['categoria']?></h6>
	<?php
}
if (isset($agregar) && isset($cant)) {

	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['id_cliente']);

	$v = mysqli_query($mysqli,"SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	if (mysqli_num_rows($v)>0) {	

		$q = mysqli_query($mysqli,"UPDATE carro SET cant = cant + $cant WHERE id_cliente ='$id_cliente' AND id_producto = '$idp'");
	}else{

		$q=mysqli_query($mysqli,"INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");
	}

	alert("Producto agregado al carro");
	redir("?p=productos");
}
if (isset($cat)) {
	$q = mysqli_query($mysqli, "SELECT * FROM productos WHERE id_categoria = '$cat' AND oferta>0 ORDER BY id ASC");	
}else{
	$q = mysqli_query($mysqli, "SELECT * FROM productos WHERE oferta>0 ORDER BY id ASC");	
}
//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
while ($r=mysqli_fetch_array($q)) {
	$precioTotal = 0;
			if ($r['oferta']>0) {
				if (strlen($r['oferta'] == 1)) {
					$desc = "0.0".$r['oferta'];
				}else{
				$desc = "0.".$r['oferta'];
				
				}
				$precioTotal = $r['precio'] - ($r['precio'] * $desc);
			}else{
				$precioTotal = $r['precio'];
			}
	?>	
		<div class="producto">
		<div class="name_producto"><?=$r['name']?></div>
			<div><img class="img_producto" src="productos/<?=$r['imagen']?>"/></div>
			<del><?=$r['precio']?><?=$divisa?></del><span class="precio">-<?=$precioTotal?><?=$divisa?></span>
			<button class="btn btn-warning" id="carrito" onclick="agregar_carro('<?=$r['id']?>');"><div class="icon-carrito"></div>
			</button>
		</div>
	<?php
}
?>

<script type="text/javascript">
	function agregar_carro(idp) {
		var cant = prompt("¿Que cantidad desea agregar?",1);

		if(cant.length>0){
			window.location=("?p=ofertas&agregar="+idp+"&cant="+cant);
		}
	}
	function redir_cat(){
		window.location="?p=ofertas&cat="+$("#Fcategoria").val()+"?%product%";
	}
</script>