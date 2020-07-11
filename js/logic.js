$(document).ready(function() {
	obtenerd()
	// ENVIAR DATOS
	$('#pluspdoh').submit(function (e) {
		var datos = new FormData($('#pluspdoh')[0]);

		$.ajax({
			url: 'configs/procesosax.php',
			type: 'POST',
			data: datos,
			contentType: false,
			processData: false,
			success: function (datos){
				if (datos =0){
					alert("No se ha podido subir el producto")
				}if (datos =2) {
					alert("La extension de la imagen no es valida")
				}
				$('#pluspdoh').trigger('reset')
				obtenerd()
			}
		})
		e.preventDefault()
		console.log(datos)
	});
	// OBTENER LOS DATOS
	function obtenerd(){
		$.ajax({
			url:"configs/mostrarpdoh.php",
			method:"POST",
			success: function(data){
				const prod = JSON.parse(data);
				let tem = "";
				prod.forEach(pd => {
					tem += `
					<tr>
					<td><img class="imagen_carro" src="productos/${pd.imagen}"></td>
					<td>${pd.name}</td>
					<td>${pd.precio}</td>
					<td>${pd.oferta}</td>	
					<td>${pd.precioT}</td>
					<td>${pd.categoria}</td>
					<td>
					<a href="?p=modificar_producto&id=<?=$rp['id']?>"><i class="icon-edit"></i></a>
					&nbsp;
					<a href="?p=agregar_producto&eliminar=<?=$rp['id']?>"><i class="icon-close"></i></a>					
					</td>
					</tr>`
				})
				$("#productosoh").html(tem)
			}
		})
	} 
})