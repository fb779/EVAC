<?php
    // if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $jsondata = array();
            if (session_id() == "") {
                session_start();
            }
            include '../conecta.php';

            $estadosCons = array('dr' => 'dr', 'sd' => 'sd', 'dg' => 'dg', 'gb' => 'gb', 'cr' => 'cr', 'ap' => 'ap');
            $especialesCons = array('dv' => 'dv', 'hdv' => 'hdv', 'nv' => 'nv', 'de' => 'de', 're' => 're' );
            $novedades = "1,2,3,4,6,10,12,13,97,41,19";

            $emrpesa = $_POST['empresa'];
            $usuario = '';
            $region = $_POST['region'];
            if ($region == 99 ) {
                $campUsuario = 'ct.codsede';
                $campDevUsu = 'coddev';
            }else {
                $campUsuario = 'ct.usuarioss';
                $campDevUsu = 'codcrit';
            }

            $consulta = $_POST['tpConsulta'];
            switch ($consulta) {
                case 'dr':
                    // Directorio
                    $estados = '0,1,2,3,4,5,6';
                    $jsondata['tipoConsulta'] = 'Directorio';
                break;

                case 'sd':
                    // sin digitar y distribuidos
                    $estados = '0,1';
                    $jsondata['tipoConsulta'] = 'Sin Digitar';
                break;

                case 'dg':
                    // digitación
                    $estados = '2';
                    $jsondata['tipoConsulta'] = 'Digitaci&iacute;n';
                break;

                case 'gb':
                    // grabados y analisis verificación
                    $estados = '3,4';
                    $jsondata['tipoConsulta'] = 'Grabados';
                break;

                case 'dv':
                    // devueltos
                    $estados = '';
                    $jsondata['tipoConsulta'] = 'Devoluciones';
                break;

                case 'hdv':
                    // historico de devoluciones
                    $estados = '';
                    $jsondata['tipoConsulta'] = 'Historico Devoluciones';
                break;

                case 'cr':
                    // criticados
                    $estados = '5';
                    $jsondata['tipoConsulta'] = 'Criticados';
                break;

                case 'ap':
                    // aprobados DC
                    $estados = '6';
                    $jsondata['tipoConsulta'] = 'Aprovados';
                break;

                case 'nv':
                    // aprobados DC
                    $estados = '6';
                    $jsondata['tipoConsulta'] = 'Aprovados';
                break;

                case 'de':
                    // aprobados DC
                    $estados = '6';
                    $jsondata['tipoConsulta'] = 'Aprovados';
                break;

                case 're':
                    // aprobados DC
                    $estados = '6';
                    $jsondata['tipoConsulta'] = 'Aprovados';
                break;
            }

            // debo para ejecutar la consulta usuario, region, tipo de consulta (en que estado o estados estan consultando, ojo  consulta para  deuda, recolectados)
            // usuario = CRXXYYY
            // Regional la que se encuentra en variable de session - 99, 05, etc
            // tipo consulta = directorio=>'dr', sinDigitar=>'sd' - (0,1), digitando=>'dg' - 2,grabados=>'gb' - (3,4), devoluciones=>'dv' - (), hisDevoluciones=>'hdv' - (), criticados=>'cr' - 5, aprobados=>'ap' - 6, deuda=>'de' - (), recolectados=>'re' - ()

            if ( array_key_exists($consulta, $estadosCons) ){
                // informacion errada en la union de los municipios y el departamento por ello no carga la informacion completa
                /* esta query muestra las empresas que tienen mal asociado el municiopio con el departamento:
                    SELECT ca.nordemp, ca.nombre, //di.ndpto, di.nmuni,* // (select ndpto from divipola where dpto = ca.depto and muni = ca.mpio) as cruce, ca.depto, ca.mpio, ca.ciiu3, re.nombre as codireg, re.nombre as codis,
                    IFNULL('1-forzoso','2-Probabilistico') AS inclusion, nv.desc_novedad, ct.estado,
                    (SELECT if (count(nordemp)>0,'Si','No') FROM devoluciones WHERE nordemp = ca.nordemp) AS devolucion,
                    (SELECT fecha FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS fecha,
                    (SELECT datediff(curdate(),fecha) FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS dias,
                    (SELECT nombre FROM usuarios WHERE ident = :usuario) AS critico
                    FROM caratula AS ca
                    INNER JOIN control AS ct ON ca.nordemp = ct.nordemp
                    -- INNER JOIN divipola AS di ON ca.depto = di.dpto AND ca.mpio = di.muni
                    INNER JOIN regionales AS re ON ct.codsede = re.codis
                    INNER JOIN novedades AS nv ON ct.novedad = nv.idnovedades
                    WHERE ct.codsede = :sede AND ct.estado in (:estados) AND ct.novedad NOT IN (:novedades)
                */

                $query = "SELECT ca.nordemp, ca.nombre, di.ndpto, di.nmuni, ca.ciiu3, re.nombre as codireg, re.nombre as codis, IFNULL('1-forzoso','2-Probabilistico') AS inclusion, nv.desc_novedad, ct.estado, (SELECT if (count(nordemp)>0,'Si','No') FROM devoluciones WHERE nordemp = ca.nordemp) AS devolucion, (SELECT fecha FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS fecha, (SELECT datediff(curdate(),fecha) FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS dias, (SELECT nombre FROM usuarios WHERE ident = '$usuario') AS critico FROM caratula AS ca INNER JOIN control AS ct ON ca.nordemp = ct.nordemp INNER JOIN divipola AS di ON ca.depto = di.dpto AND ca.mpio = di.muni INNER JOIN regionales AS re ON ct.codsede = re.codis INNER JOIN novedades AS nv ON ct.novedad = nv.idnovedades WHERE ct.codsede = '$emrpesa' AND ct.estado in ($estados) AND ct.novedad NOT IN ($novedades)";
            }

            // if ( $consulta == $especialesCons['dv']){
            //     $query = "SELECT ca.nordemp, ca.nombre, di.ndpto, di.nmuni, ca.ciiu3, re.nombre as codireg, re.nombre as codis, IFNULL('1-forzoso','2-Probabilistico') AS inclusion, nv.desc_novedad, ct.estado, (SELECT if (count(nordemp)>0,'Si','No') FROM devoluciones WHERE nordemp = ca.nordemp) AS devolucion, (SELECT fecha FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS fecha, (SELECT datediff(curdate(),fecha) FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS dias, (SELECT nombre FROM usuarios WHERE ident = '$emrpesa') AS critico FROM caratula AS ca INNER JOIN control AS ct ON ca.nordemp = ct.nordemp INNER JOIN divipola AS di ON ca.depto = di.dpto AND ca.mpio = di.muni INNER JOIN regionales AS re ON ct.codsede = re.codis INNER JOIN novedades AS nv ON ct.novedad = nv.idnovedades WHERE $campUsuario = '$emrpesa' AND ct.estado in (4,5,6) AND ca.nordemp IN (SELECT DISTINCT(nordemp) FROM devoluciones WHERE $campDevUsu = '$emrpesa' AND tipo IN ('DEV'))";
            // }

            // if ( $consulta == $especialesCons['hdv']){
            //     $query = "SELECT ca.nordemp, ca.nombre, di.ndpto, di.nmuni, ca.ciiu3, re.nombre as codireg, re.nombre as codis, IFNULL('1-forzoso','2-Probabilistico') AS inclusion, nv.desc_novedad, ct.estado, (SELECT if (count(nordemp)>0,'Si','No') FROM devoluciones WHERE nordemp = ca.nordemp) AS devolucion, (SELECT fecha FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS fecha, (SELECT datediff(curdate(),fecha) FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS dias, (SELECT nombre FROM usuarios WHERE ident = '$emrpesa') AS critico FROM caratula AS ca INNER JOIN control AS ct ON ca.nordemp = ct.nordemp INNER JOIN divipola AS di ON ca.depto = di.dpto AND ca.mpio = di.muni INNER JOIN regionales AS re ON ct.codsede = re.codis INNER JOIN novedades AS nv ON ct.novedad = nv.idnovedades WHERE $campUsuario = '$emrpesa' AND ct.estado in (4,5,6) AND ca.nordemp IN (SELECT DISTINCT(nordemp) FROM devoluciones WHERE $campDevUsu = '$emrpesa' AND tipo IN ('DEV', 'DVR'))";
            // }

            // if ( $consulta == $especialesCons['nv']){
            //     $query = "SELECT ca.nordemp, ca.nombre, di.ndpto, di.nmuni, ca.ciiu3, re.nombre as codireg, re.nombre as codis, IFNULL('1-forzoso','2-Probabilistico') AS inclusion, nv.desc_novedad, ct.estado, (SELECT if (count(nordemp)>0,'Si','No') FROM devoluciones WHERE nordemp = ca.nordemp) AS devolucion, (SELECT fecha FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS fecha, (SELECT datediff(curdate(),fecha) FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS dias, (SELECT nombre FROM usuarios WHERE ident = '$emrpesa') AS critico FROM caratula AS ca INNER JOIN control AS ct ON ca.nordemp = ct.nordemp INNER JOIN divipola AS di ON ca.depto = di.dpto AND ca.mpio = di.muni INNER JOIN regionales AS re ON ct.codsede = re.codis INNER JOIN novedades AS nv ON ct.novedad = nv.idnovedades WHERE $campUsuario = '$emrpesa' AND ct.novedad in ($novedades)";
            // }

            // if ( $consulta == $especialesCons['de']){
            //     $query = "SELECT ca.nordemp, ca.nombre, di.ndpto, di.nmuni, ca.ciiu3, re.nombre as codireg, re.nombre as codis, IFNULL('1-forzoso','2-Probabilistico') AS inclusion, nv.desc_novedad, ct.estado, (SELECT if (count(nordemp)>0,'Si','No') FROM devoluciones WHERE nordemp = ca.nordemp) AS devolucion, (SELECT fecha FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS fecha, (SELECT datediff(curdate(),fecha) FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS dias, (SELECT nombre FROM usuarios WHERE ident = '$emrpesa') AS critico FROM caratula AS ca INNER JOIN control AS ct ON ca.nordemp = ct.nordemp INNER JOIN divipola AS di ON ca.depto = di.dpto AND ca.mpio = di.muni INNER JOIN regionales AS re ON ct.codsede = re.codis INNER JOIN novedades AS nv ON ct.novedad = nv.idnovedades WHERE $campUsuario = '$emrpesa' AND ct.estado in (0,1,2,3,4)";
            // }

            // if ( $consulta == $especialesCons['re']){
            //     $query = "SELECT ca.nordemp, ca.nombre, di.ndpto, di.nmuni, ca.ciiu3, re.nombre as codireg, re.nombre as codis, IFNULL('1-forzoso','2-Probabilistico') AS inclusion, nv.desc_novedad, ct.estado, (SELECT if (count(nordemp)>0,'Si','No') FROM devoluciones WHERE nordemp = ca.nordemp) AS devolucion, (SELECT fecha FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS fecha, (SELECT datediff(curdate(),fecha) FROM devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' ORDER BY fecha DESC LIMIT 1) AS dias, (SELECT nombre FROM usuarios WHERE ident = '$emrpesa') AS critico FROM caratula AS ca INNER JOIN control AS ct ON ca.nordemp = ct.nordemp INNER JOIN divipola AS di ON ca.depto = di.dpto AND ca.mpio = di.muni INNER JOIN regionales AS re ON ct.codsede = re.codis INNER JOIN novedades AS nv ON ct.novedad = nv.idnovedades WHERE $campUsuario = '$emrpesa' AND (ct.estado in (5,6) OR ct.novedad in ($novedades))";
            // }

            $jsondata['query'] = $query;

            $repQuery = $conn->query($query);

            $empresas = array();

            foreach ($repQuery AS $key => $value) {
                $empresas[$key]['nordemp'] = $value['nordemp'];
                $empresas[$key]['nombre'] = $value['nombre'];
                $empresas[$key]['depto'] = ucfirst(strtolower($value['ndpto']));
                $empresas[$key]['mpio'] = ucfirst(strtolower($value['nmuni']));
                $empresas[$key]['ciiu'] = $value['ciiu3'];
                $empresas[$key]['categoriaCiiu'] = $value['ciiu3'];
                $empresas[$key]['regional'] = $value['codireg'];
                $empresas[$key]['territorial'] = $value['codireg'];
                $empresas[$key]['codsede'] = $value['codis'];
                $empresas[$key]['inclusion'] = $value['inclusion'];
                $empresas[$key]['novedad'] = $value['desc_novedad'];
                $empresas[$key]['estado'] = $value['estado'];
                $empresas[$key]['devolucion'] = $value['devolucion'];
                $empresas[$key]['fecha'] = ($value['fecha']!=null)?$value['fecha']:'';
                $empresas[$key]['dias'] = ($value['dias']!=null)?$value['dias']:'0';
                $empresas[$key]['critico'] = $value['critico'];
            }

            $critico = $conn->query("select nombre from usuarios where ident = '$emrpesa'")->fetch(PDO::FETCH_ASSOC);
            // print_r($critico);
            $jsondata['critico'] = $critico['nombre'];
            $jsondata['data'] = $empresas;
            $jsondata['success'] = true;
            echo json_encode($jsondata);
    // } else{
    //     $jsondata['message'] = 'No es una peticion valida....';
    //     $jsondata['success'] = false;
    //     //header('location: operativo.php');
    //     // echo "No es una peticion valida....";
    //     echo json_encode($jsondata);
    //     exit();
    // }


?>
