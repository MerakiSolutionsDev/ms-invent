<?php
    SESSION_START();
    if(!isset($_SESSION['db'])){
        header("Location: http://localhost/meraki-rent/ms-invent/html/login.html");
        exit();
    }
    header("Access-Control-Allow-Origin: *");

    $servername = "localhost";
    $username = "root";
    $password = "1nj7TkF94h";
    $dbname = $_SESSION['db'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['Modificar-terceros'])) {

        $sql = "UPDATE terceros SET identi = '".$_POST['identi_terceros']."', identiClass = '".$_POST['identiclass_terceros']."', terceroClass = '".$_POST['terceroclass_terceros']."', nombre = '".$_POST['nombre_terceros']."', ciudad = '".$_POST['ciudad_terceros']."', direccion = '".$_POST['direccion_terceros']."', tel = '".$_POST['tel_terceros']."', detalles = '".$_POST['detalles_terceros']."' WHERE id = '".$_POST['ID_terceros_form']."'";

        if (mysqli_query($conn, $sql)){
            consolo.log("Tercero Actualizado!");
        }else {
            consolo.log("Error Update: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }

?>
