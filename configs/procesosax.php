<?php 
$host_mysql="localhost";
$user_mysql="root";
$pass_mysql="";
$bd_mysql="tienda";
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
mysqli_set_charset($mysqli, "utf8");

if (!isset($mysqli)) {
	echo "Error al conectar con la base de Datos";
}
if (isset($_POST['name']) !="") {
	$name = $_POST['name'];
	$precio = $_POST['precio'];
	$oferta = $_POST['oferta'];
	$categoria = $_POST['categoria'];

	$imagen = $_FILES['imagen'];
	if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		if ($imagen["type"] == "image/jpg" or $imagen["type"] == "image/jpeg") {

			$im = $name.rand(0,1000).".png";
			$rut = "../productos/";
			$fl = $rut.$im;

			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $fl)){ 

				mysqli_query($mysqli, "INSERT INTO productos (name,precio,imagen,id_categoria,oferta,descargable) VALUES ('$name','$precio','$im','$categoria','$oferta','$descargable')");
			}
		}
	}
	
 	// cargar img del producto

	// if (is_uploaded_file($_FILES['name'])){

	// 	$imagen = $name.rand(0,1000).".png";

	// 	}

 	// cargar archivo virtual
	// if (is_uploaded_file($_FILES['descargable']['tmp_name'])) {
	// 	$descargable =$descargable.rand(0,1000).$_FILES['descargable']['name'];
	// 	move_uploaded_file($_FILES['descargable']['tmp_name'], "./ebook/".$descargable);
	// }


	// if (is_uploaded_file($_FILES['descargable']['tmp_name'])) {
	// 	$descargable =$descargable.rand(0,1000).$_FILES['descargable']['name'];
	// 	move_uploaded_file($_FILES['descargable']['tmp_name'], "./ebook/".$descargable);
	// }

}
?>