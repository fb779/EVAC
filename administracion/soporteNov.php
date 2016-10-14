<?php
	if (session_id() == "") {
		session_start();
	}
	$conn = null;
//Servidor de Prueba:
	$con = mysql_connect("192.168.1.200", "dimpe", "D1mP3D3s4rr0ll0");

//	$con = mysql_connect("$servidor", "$usuario", "$password");
	if (!$con)
	{
		die("No se puede conectar: ". mysql_error());
	}
	mysql_select_db("dane_evac", $con);

	if (isset($_POST['numero'])) {
		$numero_empresa = $_POST['numero'];
	}
	if (isset($_GET['numero'])) {
		$numero_empresa = $_GET['numero'];
	}

	if (isset($_GET['id'])) {
		$idImg = $_GET['id'];
	}
	$vig = $_SESSION['vigencia'];

	if(isset($_GET['id']) AND $_GET['opcion_soporte']==1)//cuando opcion_soporte es igual a uno busca la imagen
	{
	  $sql = "SELECT numemp, soporte_nombre,soporte_binario,soporte_tipo,soporte_peso FROM soportes WHERE id=" .$_GET['id'];
	  $consulta = mysql_query($sql);
	  if (mysql_num_rows($consulta) > 0) {
		$limagen = mysql_fetch_array($consulta);
		$datos = $limagen['soporte_binario'];
		$tipo = $limagen['soporte_tipo'];
		$nombre = $limagen['soporte_nombre'];
		$peso = $limagen['soporte_peso'];
		$parborra = $limagen['numemp'] . "&estab=" . $limagen['estable'];
	  }
	  else {
		echo "No se encontraron imágenes cargadas";
	}

	/*
	  $datos = mysql_result($consulta,0,"soporte_binario");
	  $tipo = mysql_result($consulta,0,"soporte_tipo");
	  $nombre = mysql_result($consulta,0,"soporte_nombre");
	  $peso = mysql_result($consulta,0,"soporte_peso");
	*/

	  header("Content-type: $tipo");
	  header("Content-Disposition: inline; filename=$nombre");
	  print $datos;
	  mysql_close($con);
	}

	if(isset($_GET['id']) and $_GET['opcion_soporte']==2)//cuando opcion_soporte es igual a dos elimina la imagen
	{
	  $retorno = "SELECT numemp FROM soportes WHERE id = " . $_GET['id'];
	  $respret = mysql_query($retorno);
	  $lret = mysql_fetch_array($respret);
	  $parborra = $lret['numemp'];

	  $sql = "Delete FROM soportes WHERE id=" . $_GET['id'];
	  mysql_query($sql,$con);
	  echo "Archivo de soporte Eliminado";
	  header("location: novedades.php?numero=$numero_empresa");  // si ha ido todo bien
	}

	if($_GET['opcion_soporte']==3)//cuando opcion_soporte es igual a tres inserta la imagen
	{
		if (is_uploaded_file($_FILES['archivo']['tmp_name']))//verifico si el archivo subio al servidor
		{
			$binario_nombre_temporal=$_FILES['archivo']['tmp_name'];
			$tipo_archivo = $_FILES['archivo']['type'];
			$size =  filesize($binario_nombre_temporal);
			if($size<2000000)//Valida que el archivo sea menor a 2MB
			{
			   if ($tipo_archivo == "image/jpeg" || $tipo_archivo == "image/gif" || $tipo_archivo == "image/png" || $tipo_archivo == "application/pdf"
					|| $tipo_archivo == "image/pjpeg" || $tipo_archivo == "image/x-png")//Se valida el tipo de archivo
				{
					// "rb" para Windows .. Linux parece q con "r" sobra ...
					$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "r"), filesize($binario_nombre_temporal)));

					// Obtener del array FILES (superglobal) los datos del binario .. nombre, tamaño y tipo.
					$binario_nombre=$_FILES['archivo']['name'];
					$binario_peso=$_FILES['archivo']['size'];
					$binario_tipo=$_FILES['archivo']['type'];

					//insertamos los datos en la BD.
					$param = $vig . "&numero=" . $_POST['empre'];
					$consulta_insertar = "INSERT INTO soportes (numemp,soporte_binario, soporte_nombre, soporte_peso, soporte_tipo) VALUES
					 	($numero_empresa, '$binario_contenido', '$binario_nombre', '$binario_peso', '$binario_tipo')";
					mysql_query($consulta_insertar,$con) or die($consulta_insertar);
					header("location: novedades.php?numero=$numero_empresa");  // si ha ido todo bien
				}
				else
				{ ?>
					<script>
						alert("El archivo no tiene ninguna de las siguientes extensiones Jpg, Gif, Png, Pdf");top.location.href='editmenu.php';
					</script>
					<?php
				}
			}
			else
			{
				?><script>
				alert("El directorio actual tiene mas de 2MB");top.location.href='editmenu.php';
				</script>
				<?php
			}
		}
		else
		{
			?><script>
			alert("El servidor no acepta cargar archivos");top.location.href='editmenu.php';
			</script>
			<?php
		}
	}
?>
