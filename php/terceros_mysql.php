<?php
    SESSION_START();
    if(!isset($_SESSION['db'])){
        header("Location: http://www.merakisolutionsdev.com/rent/ms-invent/html/login.html");
        exit();
    }
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $servername = "localhost";
    $username = "merakiso";
    $password = "1nj7TkF94h";
    $dbname = $_SESSION['db'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM terceros";
    $result = mysqli_query($conn, $sql);

    $outp = "";

    while ($row = mysqli_fetch_assoc($result)) {
        if ($outp != "") {$outp .= ",";}
        $outp .= '{"ID":"' . $row['id'] . '",';
        $outp .= '"Identi":"' . $row['identi'] . '",';
        $outp .= '"IdentiClass":"' . $row['identiClass'] . '",';
        $outp .= '"TerceroClass":"' . $row['terceroClass'] . '",';
        $outp .= '"Nombre":"' . $row['nombre'] . '",';
        $outp .= '"Ciudad":"' . $row['ciudad'] . '",';
        $outp .= '"Direccion":"' . $row['direccion'] . '",';
        $outp .= '"Tel":"' . $row['tel'] . '",';
        $outp .= '"Detalles":"' . $row['detalles'] . '"}';
    }

    $outp ='{"records":['.$outp.']}';
    mysqli_close($conn);

    echo ($outp);
?>
