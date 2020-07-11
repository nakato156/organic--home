<?php
$host_mysql="localhost";
$user_mysql="root";
$pass_mysql="";
$bd_mysql="tienda";
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

function clear($var){
	htmlspecialchars($var);
	return $var;
}

function check_admin(){
	if (!isset($_SESSION['id'])) {
		redir("log.php");
	}
}

function redir($var){
	?>
	<script>
		window.location = "<?=$var?>";
	</script>
	<?php
	die();
}
function alert($var){
	?>
	<script type="text/javascript">
		alert("<?=$var?>");
	</script>
	<?php
}
function check_user($url){
	if (!isset($_SESSION['id_cliente'])) {
		redir("?p=login&return=$url"."s");
	}else{
		
	}
}

function nombre_cliente($id_cliente){
	$mysqli = connect();

	$q = mysqli_query($mysqli,"SELECT * FROM cliente WHERE id = '$id_cliente'");
	$r = mysqli_fetch_array($q);
	return $r['username'];
}
function productos($idp){
	$mysqli = connect();

	$prod = mysqli_query($mysqli,"SELECT * FROM productos_compra WHERE id = '$idp'");
	$rp = mysqli_fetch_array($prod);
	$idp = $rp['id_producto'];

	$pr = mysqli_query($mysqli,"SELECT * FROM productos");
	while($rpr = mysqli_fetch_array($pr)){

		$p = $rpr['id'];
		if ($p == $idp) {
			$nmp = $rpr['name'];
		}
		
	}
	return $nmp;
}
function connect(){
	$host_mysql="localhost";
	$user_mysql="root";
	$pass_mysql="";
	$bd_mysql="tienda";

	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
	return $mysqli;
}
function fecha($fecha){
	$e = explode("-",$fecha);

	$year = $e[0];
	$month = $e[1];
	$e2 = explode(" ", $e[2]);
	$day = $e2[0];
	$time = $e2[1];
	
	$e3 = explode(":", $time);
	$hour = $e3[0];
	$mins = $e3[1];

	return $day."/".$month."/".$year." ".$hour.":".$mins;
}
function prdf($p,$ipd){
$mysqli = connect();
$qp = mysqli_query($mysqli,"SELECT DISTINCT id, name FROM productos WHERE id = '$ipd'");
	while ($fila=mysqli_fetch_array($qp)) {
		$idpf="";
		$nmpf="";
	while($rqp=mysqli_fetch_array($qp)){
		$idpf.= $rqp['id'];
		$nmpf.= $rqp['name'];
	}
	return $nmpf;
	}
}
function estado($id_estado){
	if ($id_estado == 0){
		$estado = "Iniciado";
	}elseif ($id_estado == 1){
		$estado = "Preparando";
	}elseif ($id_estado == 2){
		$estado = "En camino";
	}elseif ($id_estado == 3){
		$estado = "Listo";
	}else{
		$estado = "Indefinido";
	}
	return $estado;
}
?>