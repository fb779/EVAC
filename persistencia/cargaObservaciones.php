<?php
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $jsondata = array();
            if (session_id() == "") {
                session_start();
            }
            include '../conecta.php';

            $empresa = $_POST['empresa'];
            $vigencia = $vig=$_SESSION['vigencia'];

            $query = "SELECT ob.nordemp, ob.fecha, ob.usuario, us.nombre, ob.observacion FROM observaciones AS ob INNER JOIN usuarios AS us on ob.usuario = us.ident WHERE vigencia = $vigencia AND nordemp = $empresa";

            $jsondata['query'] = $query;

            $repQuery = $conn->query($query);

            $observaciones = array();

            foreach ($repQuery AS $key => $value) {
                $observaciones[$key]['nordemp'] = $value['nordemp'];
                $observaciones[$key]['fecha'] = ($value['fecha']!=null)?$value['fecha']:'';
                $observaciones[$key]['ident'] = $value['usuario'];
                $observaciones[$key]['nombre'] = $value['nombre'];
                $observaciones[$key]['observacion'] = $value['observacion'];
            }

            $critico = $conn->query("select nombre from usuarios where ident = '$usuario'")->fetch(PDO::FETCH_ASSOC);
            // print_r($critico);

            $jsondata['data'] = $observaciones;
            $jsondata['success'] = true;
            echo json_encode($jsondata);
    } else{
        $jsondata['message'] = 'No es una peticion valida....';
        $jsondata['success'] = false;
        //header('location: operativo.php');
        // echo "No es una peticion valida....";
        echo json_encode($jsondata);
        exit();
    }


?>
