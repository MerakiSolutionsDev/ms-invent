<?php
    SESSION_START();
    if(!isset($_SESSION['db'])){
        header("Location: http://localhost/meraki-rent/ms-invent/html/login.html");
        exit();
    }
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $servername = "localhost";
    $username = "root";
    $password = "1nj7TkF94h";
    $dbname = $_SESSION['db'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM regdocumentos";
    $result = mysqli_query($conn, $sql);

    $outp = "";

    while ($row = mysqli_fetch_assoc($result)) {
        if ($outp != "") {$outp .= ",";}
        $outp .= '{"Operacion":"' . $row['id_transaction'] . '",';
        $outp .= '"ID":"' . $row['id_resumen'] . '",';
        $outp .= '"DOC":"' . $row['doc'] . '",';
        $outp .= '"ALM":"' . $row['alm'] . '",';
        $outp .= '"FCH_MOV":"' . $row['fch_mov'] . '",';
        $outp .= '"TIPO_MOV":"' . $row['tipo_mov'] . '",';
        $outp .= '"TIPO_TRAN":"' . $row['tipo_tran'] . '",';
        $outp .= '"NOM_CLIENTE":"' . $row['nom_cliente'] . '",';
        $outp .= '"FA":"' . $row['fa'] . '",';
        $outp .= '"PROD":"' . $row['prod'] . '",';
        $outp .= '"TM":"' . $row['tm'] . '",';
        $outp .= '"BULTOS":"' . $row['bultos'] . '",';
        $outp .= '"PRESENTACION":"' . $row['presentacion'] . '",';
        $outp .= '"FLETE":"' . $row['flete'] . '",';
        $outp .= '"INICIO":"' . $row['inicio'] . '",';
        $outp .= '"FIN":"' . $row['fin'] . '",';
        $outp .= '"RegDate":"' . $row['regDate'] . '"}';
    }

    $outp ='{"records":['.$outp.']}';
    mysqli_close($conn);

    echo ($outp);
?>
