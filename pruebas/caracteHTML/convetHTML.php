<?php
	echo 'Convercion de caracteres utf8 <br>';

	$cadena = 'á é í ó ú ñ Á É Í Ó Ú Ñ ¿ ? ';
	$acentos = array('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ','¿');
	$acenCon = array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&ntilde;','&Ntilde;','&iquest;');


	$bodytag = str_replace($acentos, $acenCon, $cadena);

	// echo $cadena . ' - ' . htmlentities($bodytag);

	// echo replace($acentos);

function replace($item=''){
	return utf8_decode($item);
}

	$post = "[{\"name\":\"i1r1c1\",\"value\":\"1\"},{\"name\":\"i1r1c2\",\"value\":\"10\"},{\"name\":\"i1r1c3\",\"value\":\"1\"},{\"name\":\"i1r1c4\",\"value\":\"9\"},{\"name\":\"i1r3c2\",\"value\":\"1\"},{\"name\":\"i1r4c1\",\"value\":\"0\"},{\"name\":\"OBSERVACIONES\",\"value\":\"\"}]";

	$post = "[{\"name\":\"i1r1c1\",\"value\":\"2\"}]";

	$campos = ",{\"name\": \"i1r1c2\", \"value\": 0},{\"name\": \"i1r1c3\", \"value\": 0},{\"name\": \"i1r1c4\", \"value\": 0},{\"name\":\"i1r3c1\",\"value\":\"0\"},{\"name\":\"i1r3c2\",\"value\":\"0\"},{\"name\":\"i1r3c3\",\"value\":\"1\"},{\"name\":\"i1r3c4\",\"value\":\"0\"},{\"name\":\"i1r3c5\",\"value\":\"0\"},{\"name\":\"i1r3c6\",\"value\":\"0\"},{\"name\":\"i1r3c7\",\"value\":\"0\"},{\"name\":\"i1r3c8\",\"value\":\"0\"},{\"name\": \"i1r3c9\", \"value\": \"\"},{\"name\": \"i1r4c1\", \"value\": \"\"},{\"name\": \"OBSERVACIONES\", \"value\": \"\"}]";


	$jsonDe = rtrim($post,']') . $campos;

	echo $jsonDe;
	// print_r($jsonDe);



	// print_r( array_merge($arrayName, $campos));
?>


<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<style type="text/css">
		.label--checkbox {
			position: relative;
			margin: .5rem;
			font-family: Arial, sans-serif;
			line-height: 135%;
			cursor: pointer;
		}

		.checkbox {
			position: relative;
			margin: 0 auto;
		}

		.checkbox div {
			display: inline;
		}


	</style>
</head>
<body>

	<div class="checkbox">
		<div> <input type="checkbox" checked> </div>
		<div> <label> Item 1 </label></div>
	</div>


	<ul class="list">
		<li class="list__item">
			<label class="label--checkbox">
				<input type="checkbox" class="checkbox" checked>
				Item 1
			</label>
		</li>
		<li class="list__item">
			<label class="label--checkbox">
				<input type="checkbox" class="checkbox">
				Item 2
			</label>
		</li>
		<li class="list__item">
			<label class="label--checkbox">
				<input type="checkbox" class="checkbox">
				Item 3
			</label>
		</li>
		<li class="list__item">
			<label class="label--checkbox">
				<input type="checkbox" class="checkbox">
				Item 4
			</label>
		</li>
	</ul>
</body>
</html>
 -->


