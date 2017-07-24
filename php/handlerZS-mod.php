<?php
    SESSION_START();
    header("Access-Control-Allow-Origin: *");
    if(!isset($_SESSION['db'])){
        header("Location: http://localhost/meraki-rent/ms-invent/html/login.html");
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "1nj7TkF94h";
    $dbname = $_SESSION['db'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['ModificarZS'])) {
        $sql = "UPDATE zonas_sucursales SET abrev = '".$_POST['abrev_ZonaSucursal']."', nombre = '".$_POST['nombre_ZonaSucursal']."', dir = '".$_POST['direccion_ZonaSucursal']."', supervisor = '".$_POST['supervisor_ZonaSucursal']."', mail = '".$_POST['mail_ZonaSucursal']."' ,tel = '".$_POST['tel_ZonaSucursal']."' WHERE id = '".$_POST['ID_ZonaSucursal_form']."'";

        if (mysqli_query($conn, $sql)){
            print_r("Zona o Sucursal Actualizada!");
        }else {
            print_r("Error Update: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }

?>
