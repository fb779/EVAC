<?php
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $jsondata = array();
            if (session_id() == "") {
                session_start();
            }
            include '../conecta.php';

            $pquery = "select ca.nordemp, ca.nombre, ca.depto, ca.mpio, ca.ciiu3, ca.regional, ct.codsede, IFNULL('1-forzoso','2-Probabilistico') as inclusion, ct.novedad, ct.estado, (select if (count(nordemp)>0,'Si','No') from devoluciones where nordemp = ca.nordemp) as devolucion
                from caratula as ca
                inner join control as ct on ca.nordemp = ct.nordemp
                where ca.regional = 5 ";

    } else{
        $jsondata['message'] = 'No es una peticion valida....';
        $jsondata['success'] = false;
        //header('location: operativo.php');
        // echo "No es una peticion valida....";
        echo json_encode($jsondata);
        exit();
    }


?>