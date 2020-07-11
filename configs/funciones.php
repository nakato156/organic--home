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
		reedir("/");
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
function alert($tit,$txt,$type,$url){
	// titulos
	if ($tit == 0) {
		$title = "Error";
	}elseif ($tit == 1) {
		$title = "Bien";
	}elseif ($tit == 2) {
		$title = "Informacion";
	}elseif ($tit == 9) {
		$title = "Hola";
	}else{
		$title ="Informacion";
	}
	// tipos
	if ($type == 0) {
		$t = "error";
	}elseif ($type == 1) {
		$t = "success";
	}elseif ($type == 2) {
		$t = "info";
	}else{
		$t = "info";
	}
	echo '<script> swal({
		title: "'.$title.'!",
		text: "'.$txt.'",
		icon: "'.$t.'",
	});';
	echo '$(".swal-button").click(function(){window.location="?p='.$url.'";});';
	echo '</script>';
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