<?php
    SESSION_START();
    header("Access-Control-Allow-Origin: *");
    if(!isset($_SESSION['db'])){
        header("Location: http://www.merakisolutionsdev.com/rent/ms-invent/html/login.html");
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "1nj7TkF94h";
    $dbname = $_SESSION['db'];
    $counter = 0;

    $connect = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $data = json_decode(file_get_contents("php://input"));

    if (count($data) > 0) {

        /*$query1 = "SELECT id_transaction FROM `regdocumentos` ORDER BY id DESC LIMIT 1";

        $result = mysqli_query($connect,$query1);

        while ($row = mysqli_fetch_assoc($result)) {
            $id_transaction = $row['id_transaction'];
        }

        $id_transaction = intval($id_transaction) + 1;*/

        for ($i=0; $i < count($data); $i++) {


            $id_resumen = $i + 1;
            $_CORR          = mysqli_real_escape_string($connect, $data[$i]->CORR);
            $_DOC           = mysqli_real_escape_string($connect, $data[$i]->DOC);
            $_ALM           = mysqli_real_escape_string($connect, $data[$i]->ALM);
            $_FCH_MOV       = mysqli_real_escape_string($connect, $data[$i]->FCH_MOV);
            $_TIPO_MOV      = mysqli_real_escape_string($connect, $data[$i]->TIPO_MOV);
            $_TIPO_TRAN     = mysqli_real_escape_string($connect, $data[$i]->TIPO_TRAN);
            $_NOM_CLIENTE   = mysqli_real_escape_string($connect, $data[$i]->NOM_CLIENTE);
            $_FA            = mysqli_real_escape_string($connect, $data[$i]->FA);
            $_PROD          = mysqli_real_escape_string($connect, $data[$i]->PROD);
            $_TM            = mysqli_real_escape_string($connect, $data[$i]->TM);
            $_BULTOS        = mysqli_real_escape_string($connect, $data[$i]->BULTOS);
            $_PRESENTACION  = mysqli_real_escape_string($connect, $data[$i]->PRESENTACION);
            $_FLETE         = mysqli_real_escape_string($connect, $data[$i]->FLETE);
            $_INICIO       = mysqli_real_escape_string($connect, $data[$i]->INICIO);
            $_FIN        = mysqli_real_escape_string($connect, $data[$i]->FIN);

            $query2 = "INSERT INTO `regdocumentos` (id_transaction,id_resumen,doc,alm,fch_mov, tipo_mov,tipo_tran,nom_cliente,fa,prod,tm,bultos,presentacion,flete,inicio,fin) VALUES ('$_CORR','$id_resumen','$_DOC','$_ALM','$_FCH_MOV','$_TIPO_MOV','$_TIPO_TRAN','$_NOM_CLIENTE','$_FA','$_PROD','$_TM','$_BULTOS','$_PRESENTACION','$_FLETE','$_INICIO','$_FIN')";

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
