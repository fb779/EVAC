<?php
    // if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $jsondata = array();
            if (session_id() == "") {
                session_start();
            }
            include '../conecta.php';

            $usuario = 'CR05003';
            $campUsuario = 'ct.usuarioss';
            $regional =

            // debo para ejecutar la consulta usuario, regional, tipo de consulta (en que estado o estados estan consultando, ojo  consulta para  deuda, recolectados)
            // usuario = CRXXYYY
            // Regional la que se encuentra en variable de session
            // tipo consulta = directorio=>'dr', sinDigitar=>'sd' - (0,1), digitando=>'dg' - 2,grabados=>'gb' - (3,4), devoluciones=>'dv' - (), hisDevoluciones=>'hdv' - (), criticados=>'cr' - 5, aprobados=>'ap' - 6, deuda=>'de' - (), recolectados=>'re' - ()

            $q2 = "select ct.estado, ca.nordemp, ca.nombre, di.ndpto, di.nmuni, ca.ciiu3, re.codireg, re.codis, IFNULL('1-forzoso','2-Probabilistico') as inclusion, ct.novedad, ct.estado,
                (select if (count(nordemp)>0,'Si','No') from devoluciones where nordemp = ca.nordemp) as devolucion, (select fecha from devoluciones where nordemp = ca.nordemp and tipo = 'DVR' order by fecha desc limit 1) as fecha,
                (select datediff(curdate(),fecha) from devoluciones where nordemp = ca.nordemp and tipo = 'DVR' order by fecha desc limit 1) as dias, (select nombre from usuarios where ident = :usuario) as critico
                from caratula as ca
                inner join control as ct on ca.nordemp = ct.nordemp
                inner join divipola as di on ca.depto = di.dpto and ca.mpio = di.muni
                inner join regionales as re on ca.regional = re.codireg and ct.codsede = re.codis
                where ca.regional = 5 and ct.usuarioss = :usuario and ct.estado in (3,4,5,6)";

            $query = "SELECT ca.nordemp, ca.nombre, di.ndpto, di.nmuni, ca.ciiu3, ca.regional, ct.codsede, IFNULL('1-forzoso','2-Probabilistico') AS inclusion, ct.novedad, ct.estado, (SELECT if (count(nordemp)>0,'Si','No') from devoluciones WHERE nordemp = ca.nordemp) AS devolucion, (SELECT fecha from devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' order by fecha desc limit 1) AS fecha, (SELECT datediff(curdate(),fecha) from devoluciones WHERE nordemp = ca.nordemp AND tipo = 'DVR' order by fecha desc limit 1) AS dias, (select nombre from usuarios WHERE ident = '$usuario') AS critico from caratula AS ca INNER JOIN control AS ct ON ca.nordemp = ct.nordemp INNER JOIN divipola AS di ON ca.depto = di.dpto and ca.mpio = di.muni WHERE ca.regional = 5 AND $campUsuario = '$usuario' AND ct.estado in (3,4,5,6)";

            $repQuery = $conn->query($query);

            $empresas = array();

            foreach ($repQuery AS $key => $value) {
                $empresas[$key]['nordemp'] = $value['nordemp'];
                $empresas[$key]['nombre'] = $value['nombre'];
                $empresas[$key]['depto'] = ucfirst(strtolower($value['ndpto']));
                $empresas[$key]['mpio'] = ucfirst(strtolower($value['nmuni']));
                $empresas[$key]['ciiu'] = $value['ciiu3'];
                $empresas[$key]['categoriaCiiu'] = $value['ciiu3'];
                $empresas[$key]['regional'] = $value['regional'];
                $empresas[$key]['territorial'] = $value['regional'];
                $empresas[$key]['codsede'] = $value['codsede'];
                $empresas[$key]['inclusion'] = $value['inclusion'];
                $empresas[$key]['novedad'] = $value['novedad'];
                $empresas[$key]['estado'] = $value['estado'];
                $empresas[$key]['devolucion'] = $value['devolucion'];
                $empresas[$key]['fecha'] = ($value['fecha']!=null)?$value['fecha']:'';
                $empresas[$key]['dias'] = ($value['dias']!=null)?$value['dias']:'0';
                $empresas[$key]['critico'] = $value['critico'];
                $empresas[$key]['observacion'] = 'Observaciones';
                // print_r($value);
                // echo "</br>";
            }

            $jsondata['data'] = $empresas;
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
