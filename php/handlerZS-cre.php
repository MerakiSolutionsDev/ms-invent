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

    if(isset($_POST['CrearZS'])){
        $sql = "INSERT INTO zonas_sucursales (nombre, dir, supervisor, mail, tel) VALUES ('".$_POST['nombre_ZonaSucursal']."','".$_POST['supervisor_ZonaSucursal']."','".$_POST['mail_ZonaSucursal']."','".$_POST['direccion_ZonaSucursal']."','".$_POST['telefono_ZonaSucursal']."')";

        if (mysqli_query($conn, $sql)){
            print_r ("Almacen creado satisfactoriamente!");
        }else {
            print_r("Error Create: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }
?>
