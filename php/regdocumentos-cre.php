<?php
    SESSION_START();
    header("Access-Control-Allow-Origin: *");
    if(!isset($_SESSION['db'])){
        header("Location: http://www.merakisolutionsdev.com/rent/ms-invent/html/login.html");
        exit();
    }

    $servername = "localhost";
    $username = "merakiso";
    $password = "1nj7TkF94h";
    $dbname = $_SESSION['db'];
    $counter = 0;

    $connect = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $data = json_decode(file_get_contents("php://input"));

    if (count($data) > 0) {

        $query1 = "SELECT id_transaction FROM `regdocumentos` ORDER BY id DESC LIMIT 1";

        $result = mysqli_query($connect,$query1);

        while ($row = mysqli_fetch_assoc($result)) {
            $id_transaction = $row['id_transaction'];
        }

        $id_transaction = intval($id_transaction) + 1;

        for ($i=0; $i < count($data); $i++) {

            $id_resumen = $i;
            $_fecha      = mysqli_real_escape_string($connect, $data[$i]->Fecha);
            $_doc        = mysqli_real_escape_string($connect, $data[$i]->Doc);
            $_docnum     = mysqli_real_escape_string($connect, $data[$i]->Docnum);
            $_tercero    = mysqli_real_escape_string($connect, $data[$i]->Tercero);
            $_idprod     = mysqli_real_escape_string($connect, $data[$i]->IDProd);
            $_prod       = mysqli_real_escape_string($connect, $data[$i]->Prod);
            $_detalle     = mysqli_real_escape_string($connect, $data[$i]->Detalle);
            $_moneda     = mysqli_real_escape_string($connect, $data[$i]->Moneda);
            $_scantidad  = mysqli_real_escape_string($connect, $data[$i]->SCantidad);
            $_spunitario = mysqli_real_escape_string($connect, $data[$i]->SPUnitario);
            $_stotal     = mysqli_real_escape_string($connect, $data[$i]->STotal);
            $_ecantidad  = mysqli_real_escape_string($connect, $data[$i]->ECantidad);
            $_epunitario = mysqli_real_escape_string($connect, $data[$i]->EPUnitario);
            $_etotal     = mysqli_real_escape_string($connect, $data[$i]->ETotal);
            $_stock     = mysqli_real_escape_string($connect, $data[$i]->Stock);

            $query2 = "INSERT INTO `regdocumentos` (id_transaction,id_resumen,fecha,doc,docnum,tercero,detalle,idprod,prod,moneda,scantidad,spunitario,stotal,ecantidad,epunitario,etotal,stock) VALUES ('$id_transaction','$id_resumen','$_fecha','$_doc','$_docnum','$_tercero','$_detalle','$_idprod','$_prod','$_moneda','$_scantidad','$_spunitario','$_stotal','$_ecantidad','$_epunitario','$_etotal','$_stock')";

            if(mysqli_query($connect,$query2)){
                $counter = $counter + 1;
            }else{
                $counter = 0;
            }
        }

        if($counter > 0){
            echo "Operación Registrada";
        }else{
            echo "Revise su conexión a internet";
        }
        mysqli_close($connect);
    }
?>
