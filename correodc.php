<?php 

	class Correodc {
		
		const  PENDIENTE = 0;
		const  ENVIADO = 1;
		const  ERROR = 2;
		const  SIN_CONFIRMAR = 0;
		const  CONFIRMADO = 1;
		public $cnx;    		//Obtengo la conexion a la base de datos desde conecta.php
		public $server;         //Obtengo la IP del servidor SMTP;
		public $usuarioSMTP; 	//Usuario del servidor SMTP;
		public $passwordSMTP; 	//Password del servidor SMTP;
		public $linkAPP;		//Direccion al link del aplicativo en produccion	
		
		
		//Constructor de la clase. 
		//Cada vez que se crea una instancia de este objeto, ya se tiene acceso al link conector a la base de datos		
		function __construct() {
			include("../conecta.php");
			$this->cnx = $con;
			$this->setServer("192.168.1.98");					           //Configurar IP Servidor SMTP	
			$this->setUsuarioSMTP("aplicaciones@dane.gov.co"); 	           //Configurar usuario SMTP
			$this->setPasswordSMTP("Ou67UtapW3v");						   //Configurar password SMTP
			$this->setLinkApp("http://formularios.dane.gov.co/EDITIVII");  //Configurar links de correo al aplicativo
		}
		
		//Setter para la IP de la direccion de correos
		public function setServer($server){
			$this->server = $server;
		}
		
		//Getter para la IP de la direccion de correos
		public function getServer(){
			return $this->server;
		}
		
		//Setter para el usuario del servidor de correos
		public function setUsuarioSMTP($usuario){
			$this->usuarioSMTP = $usuario;
		}
		
		
		//Getter para el usuario del servidor de correos
		public function getUsuarioSMTP(){
			return $this->usuarioSMTP;
		}
		
		
		//Setter para el password del servidor de correos
		public function setPasswordSMTP($password){
			$this->passwordSMTP = $password;
		}
		
		
		//Getter para el password del servidor de correos
		public function getPasswordSMTP(){
			return $this->passwordSMTP;
		}
		
		//Setter para el link del aplicativo
		public function setLinkAPP($link){
			$this->linkAPP = $link;
		}
		
		//Getter para el link del aplicativo
		public function getLinkApp(){
			return $this->linkAPP;
		}
		
		
		//Consulta para obtener los valores del reporte operativo de envio de correos
		//@author Daniel M. Díaz 
		//@since  Jan 14 / 2015
		public function reporteCorreos($region){
			$repo = array();
			$sql = "SELECT
  						COUNT(CASE WHEN envcorr = ". self::PENDIENTE . " THEN 1 END) AS pendientes,
  						COUNT(CASE WHEN envcorr = ". self::ENVIADO . " THEN 1 END) AS enviados,
  						COUNT(CASE WHEN envcorr = ". self::ENVIADO . " AND vericorr = " . self::SIN_CONFIRMAR . " THEN 1 END) AS sin_confirmar,
  						COUNT(CASE WHEN envcorr = ". self::ENVIADO . " AND vericorr = " . self::CONFIRMADO . " THEN 1 END) AS confirmados,
  						COUNT(CASE WHEN envcorr = ". self::ERROR . " THEN 1 END) AS errores
					FROM caratula WHERE regional = 99";
			$res = mysql_query($sql,$this->cnx);
			while ($row=mysql_fetch_array($res)){
				$repo["pendientes"] =  $row["pendientes"];
				$repo["enviados"] =  $row["enviados"];
				$repo["sin_confirmar"] = $row["sin_confirmar"];
				$repo["confirmados"] =  $row["confirmados"];
				$repo["errores"] =  $row["errores"];
			}	
			$repo["total"] = $repo["pendientes"] + $repo["enviados"] + $repo["errores"];
			mysql_free_result($res);
			return $repo;			
		}
		
		
		//Obtiene el nombre del estado del envio y revision de los correos
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		public function obtenerNombreEstado($codigo){
			$nombre = "";
			switch($codigo){
				case 0:  $nombre = "Correos Pendientes";
						 break;
				case 1:  $nombre = "Correos Enviados";
						 break;
				case 11: $nombre = "Correos Confirmados";
						 break;
				case 10: $nombre = "Correos Sin Confirmar";
				         break;
				case 2:  $nombre = "Correos Errados";
				         break;
				case 3:  $nombre = "Total";
				         break;                  		 				
			}
			return $nombre;
		}
		
		
		//Obtiene el listado de correos que se encuentran en un estado especifico
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		public function obtenerListaCorreos($codigo, $region){
			$correos = array();
			switch($codigo){
				case 0:  $correos = $this->obtenerCorreosPendientes($region);
						 break;
				case 1:  $correos = $this->obtenerCorreosEnviados($region);
						 break;
				case 11: $correos = $this->obtenerCorreosConfirmados($region);
						 break;
				case 10: $correos = $this->obtenerCorreosSinConfirmar($region);
						 break;
				case 2:  $correos = $this->obtenerCorreosErrores($region);
						 break;
				case 3:  $correos = $this->obtenerCorreosTotal($region);
						 break;
			}
			return $correos;
		}

		
		//Obtiene el listado de correos que se encuentran pendientes de envio, en la regional del usuario
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		private function obtenerCorreosPendientes($region){
			$correos = array();
			$sql = "SELECT C.nordemp, C.numdoc, C.dv, C.nombre, C.direccion, C.telefono, C.emailnotif, C.fec_correo, S.nombre AS sede
					FROM caratula C, regionales S
					WHERE C.regional = S.codis 
					AND C.envcorr = " . self::PENDIENTE . "
					AND C.vericorr = " . self::SIN_CONFIRMAR .
					" AND C.regional = 99";
			$res = mysql_query($sql,$this->cnx);
			$i = 0;
			while ($row=mysql_fetch_array($res)){
				$correos[$i]["codigo"] =  $row["nordemp"];
				$correos[$i]["numdoc"] = $row["numdoc"];
				$correos[$i]["digval"] = $row["dv"];
				$correos[$i]["nombre"] =  $row["nombre"];
				$correos[$i]["direccion"] = $row["direccion"];
				$correos[$i]["telefono"] =  $row["telefono"];
				$correos[$i]["email"] =  $row["emailnotif"];
				$correos[$i]["fecha"] = $row["fec_correo"];
				$correos[$i]["sede"] = $row["sede"];
				$i++;
			}
			mysql_free_result($res);
			return $correos;
		}
		
		//Obtiene el listado de correos que han sido enviados 
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		private function obtenerCorreosEnviados($region){
			$correos = array();
			$sql = "SELECT C.nordemp, C.numdoc, C.dv, C.nombre, C.direccion, C.telefono, C.emailnotif, C.fec_correo, S.nombre AS sede
					FROM caratula C, regionales S
					WHERE C.regional = S.codis 
					AND C.envcorr = " . self::ENVIADO . 
					" AND C.regional = 99";
			$res = mysql_query($sql,$this->cnx);
			$i = 0;
			while ($row=mysql_fetch_array($res)){
				$correos[$i]["codigo"] =  $row["nordemp"];
				$correos[$i]["numdoc"] = $row["numdoc"];
				$correos[$i]["digval"] = $row["dv"]; 
				$correos[$i]["nombre"] =  $row["nombre"];
				$correos[$i]["direccion"] = $row["direccion"];
				$correos[$i]["telefono"] =  $row["telefono"];
				$correos[$i]["email"] =  $row["emailnotif"];
				$correos[$i]["fecha"] = $row["fec_correo"];
				$correos[$i]["sede"] = $row["sede"];
				$i++;
			}
			mysql_free_result($res);
			return $correos;
		}

		
		//Obtiene el listado de correos que estan sin confirmar
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		private function obtenerCorreosSinConfirmar($region){
			$correos = array();
			$sql = "SELECT C.nordemp, C.numdoc, C.dv, C.nombre, C.direccion, C.telefono, C.emailnotif, C.fec_correo, S.nombre AS sede
					FROM caratula C, regionales S
					WHERE C.regional = S.codis
					AND C.envcorr = " . self::ENVIADO . "
					AND C.vericorr = " . self::SIN_CONFIRMAR . 
					" AND C.regional = 99";
			$res = mysql_query($sql,$this->cnx);
			$i = 0;
			while ($row=mysql_fetch_array($res)){
				$correos[$i]["codigo"] =  $row["nordemp"];
				$correos[$i]["numdoc"] = $row["numdoc"];
				$correos[$i]["digval"] = $row["dv"];
				$correos[$i]["nombre"] =  $row["nombre"];
				$correos[$i]["direccion"] = $row["direccion"];
				$correos[$i]["telefono"] =  $row["telefono"];
				$correos[$i]["email"] =  $row["emailnotif"];
				$correos[$i]["fecha"] = $row["fec_correo"];
				$correos[$i]["sede"] = $row["sede"];
				$i++;
			}
			mysql_free_result($res);
			return $correos;
		}
		
		
		//Obtiene el listado de correos que estan confirmados
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		private function obtenerCorreosConfirmados($region){
			$correos = array();
			$sql = "SELECT C.nordemp, C.numdoc, C.dv, C.nombre, C.direccion, C.telefono, C.emailnotif, C.fec_correo, S.nombre AS sede
					FROM caratula C, regionales S
					WHERE C.regional = S.codis
					AND C.envcorr = " . self::ENVIADO . "
					AND C.vericorr = " . self::CONFIRMADO .
					" AND C.regional = 99";
			$res = mysql_query($sql,$this->cnx);
			$i = 0;
			while ($row=mysql_fetch_array($res)){
				$correos[$i]["codigo"] =  $row["nordemp"];
				$correos[$i]["numdoc"] = $row["numdoc"];
				$correos[$i]["digval"] = $row["dv"];
				$correos[$i]["nombre"] =  $row["nombre"];
				$correos[$i]["direccion"] = $row["direccion"];
				$correos[$i]["telefono"] =  $row["telefono"];
				$correos[$i]["email"] =  $row["emailnotif"];
				$correos[$i]["fecha"] = $row["fec_correo"];
				$correos[$i]["sede"] = $row["sede"];
				$i++;
			}
			mysql_free_result($res);
			return $correos;
		}
		
		
		//Obtiene el listado de correos con errores en el envio
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		private function obtenerCorreosErrores($region){
			$correos = array();
			$sql = "SELECT C.nordemp, C.numdoc, C.dv, C.nombre, C.direccion, C.telefono, C.emailnotif, C.fec_correo, S.nombre AS sede
					FROM caratula C, regionales S
					WHERE C.regional = S.codis
					AND C.vericorr = " . self::ERROR .
					" AND C.regional = 99";
			$res = mysql_query($sql,$this->cnx);
			$i = 0;
			while ($row=mysql_fetch_array($res)){
				$correos[$i]["codigo"] =  $row["nordemp"];
				$correos[$i]["numdoc"] = $row["numdoc"];
				$correos[$i]["digval"] = $row["dv"];
				$correos[$i]["nombre"] =  $row["nombre"];
				$correos[$i]["direccion"] = $row["direccion"];
				$correos[$i]["telefono"] =  $row["telefono"];
				$correos[$i]["email"] =  $row["emailnotif"];
				$correos[$i]["fecha"] = $row["fec_correo"];
				$correos[$i]["sede"] = $row["sede"];
				$i++;
			}
			mysql_free_result($res);
			return $correos;
		}
		
		
		//Obtiene el listado total de correos
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		private function obtenerCorreosTotal($region){
			$correos = array();
			$sql = "SELECT C.nordemp, C.numdoc, C.dv, C.nombre, C.direccion, C.telefono, C.emailnotif, C.fec_correo, S.nombre AS sede
					FROM caratula C, regionales S
					WHERE C.regional = S.codis
					AND C.regional = 99";
			$res = mysql_query($sql,$this->cnx);
			$i = 0;
			while ($row=mysql_fetch_array($res)){
				$correos[$i]["codigo"] =  $row["nordemp"];
				$correos[$i]["numdoc"] = $row["numdoc"];
				$correos[$i]["digval"] = $row["dv"];
				$correos[$i]["nombre"] =  $row["nombre"];
				$correos[$i]["direccion"] = $row["direccion"];
				$correos[$i]["telefono"] =  $row["telefono"];
				$correos[$i]["email"] =  $row["emailnotif"];
				$correos[$i]["fecha"] = $row["fec_correo"];
				$correos[$i]["sede"] = $row["sede"];
				$i++;
			}
			mysql_free_result($res);
			return $correos;
		}
		
		//Establece el cuerpo del mensaje. Arma el HTML para el envío de mensajes
		//@author Daniel M. Díaz
		//@since  Jan 14 / 2015
		private function obtenerMensajeHTML($fuente, $regional){
			$html = "<table>
					 <tr>
					 <td>&nbsp;</td>
					 <td><img src=\"cid:banner_top\" width='600' height='60' /></td>
					 <td>&nbsp;</td>
					 </tr>
					 <tr>
					 <td>&nbsp;</td>";
			$html.= "<td style='font-family: arial; font-size: 14px'>
					 <b>DEPARTAMENTO ADMINISTRATIVO NACIONAL DE ESTAD&Iacute;STICA - DANE</b>					
					 <br/><br/>
					 <p style='text-align: justify; font-size: 14px;'>". $regional["nombre"].", " . $this->obtenerFormatoFecha(date("Y-m-d")) ."</p> 
                     <p style='text-align: justify; font-size: 14px;'>Se&ntilde;ores<br/>". strtoupper($fuente["nombre"]) ."<br/>Ciudad.-</p>					 		
					 <p style='text-align: justify; font-size: 14px;'>Respetado se&ntilde;or(a),</p>
					 <p style='text-align: justify; font-size: 14px;'>El Departamento Administrativo Nacional de Estad&iacute;stica - DANE como ente rector del Sistema Estad&iacute;stico Nacional, asegura la producci&oacute;n de estad&iacute;sticas b&aacute;sicas y estrat&eacute;gicas para la toma de decisiones en el desarrollo econ&oacute;mico y social del pa&iacute;s.</p>
					 <p style='text-align: justify; font-size: 14px;'>Con el fin de cumpir con este objetivo, el DANE desarrolla una medición con periodicidad bianual de las diferentes actividades de desarrollo e innovaci&oacute;n tecnol&oacute;gica en el sector industrial, a trav&eacute;s de la <b>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - EDIT</b>. Esta encuesta tiene como objetivo general, caracterizar la din&aacute;mica tecnol&oacute;gica y analizar las actividades de innovaci&oacute;n y desarrollo tecnol&oacute;gico en las empresas con actividad industrial en Colombia, as&iacute; como realizar una evaluaci&oacute;n de los instrumentos de pol&iacute;tica, tanto de fomento como de protecci&oacute;n a la innovaci&oacute;n.</p>
					 <p style='text-align: justify; font-size: 14px;'>Con el prop&oacute;sito de facilitar el reporte de la informaci&oacute;n correspondiente a los a&ntilde;os 2013 y 2014, el DANE tiene a su disposici&oacute;n un formulario electr&oacute;nico al cual podr&aacute; ingresar luego de generar su Usuario y Contrase&ntilde;a <a href='". $this->linkAPP ."/correos/correosctl.php?b04f60=".$fuente["numdoc"]."&5f458dc406e8=".$fuente["digval"]."&b0a6a243b5fe=".$fuente["codigo"]."'>AQUI</a>, a trav&eacute;s del siguiente link: <a href='". $this->linkAPP ."'><b>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - EDIT</b></a>.</p>
					 <p style='text-align: justify; font-size: 14px;'>Para mayor informaci&oacute;n y aclaraciones, reiteramos que cuenta de forma gratuita con la asesor&iacute;a del personal del DANE, quienes lo estar&aacute;n visitando para apoyarlo con el diligenciamiento del formulario. Igualmente, puede comunicarse al tel&eacute;fono <b>". $regional["telefono"] ."</b>.</p>
					 <p style='text-align: justify; font-size: 14px;'>Resulta importante precisar, que de acuerdo con la ley 079 del 20 de Octubre de 1993, los datos que el DANE solicita en estos formularios son estrictamente confidenciales y en ning&uacute;n caso tienen fines fiscales, ni pueden ser utilizados como prueba judicial.</p>
                     <p style='text-align: justify; font-size: 14px;'>Cordialmente,</p>					 		
					 <p style='text-align: justify; font-size: 14px;'>&nbsp;</p>
                     <p style='text-align: justify; font-size: 14px;'><b>". $regional["asistente"]."</b><br/>Asistente T&eacute;cnico<br/>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - EDIT<br/>". $regional["nombre"]." - ". $regional["direccion"] ." - " . $regional["telefono"] ." - " . $regional["correo"] ."</p> 					 		
					 </td>";
		    $html.= "<td>&nbsp;</td>
					 </tr>   
					 </table>";
			return $html;
		}
		
		
		//Actualiza el estado del envio/verificacion de correos
		//@author Daniel M. Díaz
		//@since  Jan 13 / 2015
		public function actualizarEstado($nordemp, $estadoCorreo, $estadoVerificacion){
			$sql = "UPDATE caratula
			        SET envcorr = $estadoCorreo,
			            vericorr = $estadoVerificacion,
			            fec_correo = NOW()
			        WHERE nordemp = $nordemp";
			$res = mysql_query($sql,$this->cnx);
			if ($res){
				return true;
			}
			else{
				return false;
			}
		}
		
		
		//Actualiza el estado de control del formulario. Pasa la fuente al estado 5.1 / 99.1 (NOTIFICADO)
		//@author Daniel M. Díaz
		//@since  Jan 16 / 2015
		public function actualizarEstadoNotificado($nordemp, $novedad, $estado){			
			//Actualizo al estado notificado, solamente cuando la fuente está en estado 5-0
			$novedad = 5;
			$estado = 0;
			$sql = "SELECT novedad, estado
                    FROM control
                    WHERE nordemp = $nordemp";
			$res = mysql_query($sql, $this->cnx);
			while ($row = mysql_fetch_array($res)){
				$novedad = $row["novedad"];
				$estado = $row["estado"];
			}
			
			//Si la fuente ho ha sido notificada, la notifico.
			if (($novedad==5)&&($estado==0)){			
				$sql = "UPDATE control
						SET estado = $estado,
						    fecdist = CURDATE()
				        WHERE nordemp = $nordemp";
				$res = mysql_query($sql,$this->cnx);
				if ($res){
					return true;
				}
				else{
					return false;
				}
			}
		}
		
		
		//Obtiene los datos de la territorial
		//@author Daniel M. Díaz
		//@since  Jan 13 / 2015
		public function obtenerDatosTerritorial($region){
			$data = array();
			$sql = "SELECT telefono, asistente, nombre, direccion, correo
					FROM regionales
					WHERE codis = 99";
			$res = mysql_query($sql,$this->cnx);
			while ($row=mysql_fetch_array($res)){
				$data["telefono"] =  $row["telefono"];
				$data["asistente"] =  $row["asistente"];
				$data["nombre"] = $row["nombre"];
				$data["direccion"] =  $row["direccion"];
				$data["correo"] =  $row["correo"];				
			}
			mysql_free_result($res);
			return $data;
		}
		
		
		//Funcion para obtener el nombre de la fecha y dar formato de texto para el cuerpo del mensaje
		//@author Daniel M. Díaz
		//@since  Jan 13 / 2015
		public function obtenerFormatoFecha($fecha){
			$arrayFecha = explode("-",$fecha);
			$nombreMes = "";
			switch($arrayFecha[1]){
				case 1:  $nombreMes = "Enero";
						 break;
				case 2:  $nombreMes = "Febrero";
						 break;
				case 3:  $nombreMes = "Marzo";
						 break;
				case 4:  $nombreMes = "Abril";
						 break;
				case 5:  $nombreMes = "Mayo";
						 break;
				case 6:  $nombreMes = "Junio";
						 break;
				case 7:  $nombreMes = "Julio";
						 break;
				case 8:  $nombreMes = "Agosto";
						 break;
				case 9:  $nombreMes = "Septiembre";
						 break;
				case 10: $nombreMes = "Octubre";
						 break;
				case 11: $nombreMes = "Noviembre";
					     break;
				case 12: $nombreMes = "Diciembre";
						 break;
			}
			return $nombreMes." ".$arrayFecha[2] . " de " . $arrayFecha[0]; 
		}
		
		
		//Envio masivo de correos - Se envian correos de notificacion a todas las fuentes de la encuesta
		//Se utiliza la libreria PHP-Mail
		//@author Daniel M. Díaz
		//@since  Jan 13 / 2015
		public function enviarCorreos($region){
			date_default_timezone_set("America/Bogota");
			require_once ("mailer/PHPMailer_5.2.3/class.phpmailer.php");
			$correos = $this->obtenerCorreosPendientes($region);
/* 
			$correos = array();
			$correos[0]["codigo"] =  1;
			$correos[0]["numdoc"] =  890105214;
			$correos[0]["digval"] =  0;
			$correos[0]["nombre"] =  "Oscar Ortega M";
			$correos[0]["direccion"] = "Carrera 59 No. 26-70 Interior I - CAN";
			$correos[0]["telefono"] =  "5978300 Ext. 2938";
			$correos[0]["email"] =  "oortegam@dane.gov.co";
*/			
			$territorial = $this->obtenerDatosTerritorial($region);
			for ($i=0; $i<count($correos); $i++){
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPKeepAlive = true;
				$mail->Host = $this->getServer();
				$mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing) 12.// 1 = errors and messages 13.// 2 = messages only
				$mail->MailerDebug = true;
				$mail->Port = 25;
				$mail->Username = $this->getUsuarioSMTP();
				$mail->Password = $this->getPasswordSMTP();
				$mail->AddReplyTo("aplicaciones@dane.gov.co", "DANE - Encuesta De Desarrollo e Innovación Tecnológica- Formulario Electrónico");
				$mail->SetFrom("aplicaciones@dane.gov.co", "DANE - Encuesta De Desarrollo e Innovación Tecnológica- Formulario Electrónico");
				$mail->Subject = "DANE - Encuesta De Desarrollo e Innovación Tecnológica- Formulario Electrónico";
				$mail->AddEmbeddedImage("images/banner_top.png", "banner_top", "banner_top.png");
				$mail->Body = $this->obtenerMensajeHTML($correos[$i], $territorial);
				$mail->AddAddress($correos[$i]["email"]);
				$mail->IsHTML(true);
				if(!$mail->Send()){					
					$this->actualizarEstado($correos[$i]["codigo"], self::ERROR, self::SIN_CONFIRMAR);					
				} 
				else {					
					$this->actualizarEstado($correos[$i]["codigo"], self::ENVIADO, self::SIN_CONFIRMAR);
				}
				$mail->ClearAddresses();
				$mail->ClearAttachments();
			}
			echo "ENVIO TERMINADO";
		}
		
		//Valida los datos de una fuente para comprobar si se trata de un usuario valido del sistema, y poder mostrar el 
		//usuario y la contraseña.
		//@author Daniel M. Díaz
		//@since  Jan 16 / 2015 
		public function validarDatosFuente($nit,$dv,$nordemp){
			$result = false;
			$sql = "SELECT C.numdoc, C.dv 
					FROM caratula C, usuarios U
					WHERE C.nordemp = U.numemp
					AND C.nordemp = $nordemp";
			$res = mysql_query($sql,$this->cnx);
			while ($row=mysql_fetch_array($res)){
				$numdoc = $row["numdoc"];
				$digval = $row["dv"];
				if ((strcmp($nit,$numdoc)==0) && (strcmp($dv,$digval)==0))
					$result = true;
				else
					$result = false;				
			}
			mysql_free_result($res);
			return $result;
		}
		
		//Obtiene el login y el password de un usuario de la base de datos
		//@author Daniel M. Díaz
		//@since Jan 16 / 2015
		public function obtenerLoginPassword($nit,$dv,$nordemp){
			$data = array();
			$sql = "SELECT C. nombre, U.ident, U.clave
					FROM caratula C, usuarios U
					WHERE C.nordemp = U.numemp
					AND C.nordemp = $nordemp
					AND C.numdoc = $nit
					AND C.dv = $dv";
			$res = mysql_query($sql,$this->cnx);
			while ($row=mysql_fetch_array($res)){
				$data["nombre"] = $row["nombre"];
				$data["ident"] =  $row["ident"];
				$data["clave"] =  $row["clave"];				
			}
			mysql_free_result($res);
			return $data;
		}
		
		//Muestra la pagina del login y el password de un usuario y contraseña cuando se hace click sobre el link enviado desde el correo
		//@author Daniel M. Díaz
		//@since  Jan 16 / 2015
		public function mostrarConfirmacionHTML($data){
			$html = '<table>
					 <tr>
					 	<td colspan="2"><img src="images/banner_top.png" width="800" height="100"/></td>
					 </tr>
				     <tr>
						<td colspan="2" style="text-align: center; font-family: arial; font-size: 15px; font-weight: bold">DANE - ENCUESTA DE DESARROLLO E INNOVACION TECNOLOGICA - CREACIÓN DE USUARIOS</td>
					 </tr>
					 <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					 </tr>
					 <tr>
					    <td colspan="2" style="text-align: center; font-family: arial; font-size: 15px; font-weight: bold">'. strtoupper($data["nombre"]).'</td>
					 </tr>
				     <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					 </tr>
					 <tr>
						<td style="text-align: center; background-color: #FFFF00">USUARIO: <b>'.$data["ident"].'</b></td>
					    <td style="text-align: center; background-color: #FFFF00;">CLAVE: <b>'.$data["clave"].'</b></td>
					 </tr>
				     <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					 </tr>
					 <tr>
						<td colspan="2" style="text-align: justify; font-family: arial; font-size: 15px; padding: 10px;">
							<p><b>Señor Industrial</b></p>
							<p>Al ingresar al formulario electrónico de la EDIT por favor cambie y guarde la clave <i>(Esquina superior derecha del Formulario)</i></p>
							<p>Recuerde que tiene un plazo de 10 días calendario para el reporte de la información, contados a partir del recibo de esta notificación.</p>
							<p>En caso de ser necesario ingresando nuevamente al correo recibido,  y activando el link <b>GENERAR SU USUARIO Y CONTRASEÑA</b>, podrá recuperar su usuario y contraseña.</p>
							<p>Para resolver  cualquier inquietud  por favor  comuníquese  a los números telefónicos  registrados  en el correo de notificación, allí le atenderá el responsable de la investigación en cada ciudad.</p>
						</td>
					</tr>
					</table>';
			echo $html;
		}
		
		
		//Cierra la conexion con la base de datos
		function __destruct() {
			mysql_close($this->cnx);
			$this->cnx = NULL;
		}
		
	}//EOC

?>
