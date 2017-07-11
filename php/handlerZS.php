<?php
    $servername = "localhost";
    $username = "root";
    $password = "mecanos2017";
    $dbname = "mecanosa_cardex";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['ModificarZS'])) {
        $sql = "UPDATE zonas_sucursales SET nombre = '".$_POST['nombre_ZonaSucursal']."', detalles = '".$_POST['detalles_ZonaSucursal']."' WHERE id = '".$_POST['ID_ZonaSucursal_form']."'";

        if (mysqli_query($conn, $sql)){
            print_r("Zona o Sucursal Actualizada!");
            //header("Location: http://localhost/Kardex/html/cardexZS.html");
        }else {
            print_r("Error Update: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }

    if(isset($_POST['CrearZS'])){
        $sql = "INSERT INTO zonas_sucursales (nombre,detalles) VALUES ('".$_POST['nombre_ZonaSucursal']."','".$_POST['detalles_ZonaSucursal']."')";

        if (mysqli_query($conn, $sql)){
            print_r ("Zona o Sucursal creada correctamente !");
            //header("Location: http://localhost/Kardex/html/cardexZS.html");
        }else {
            print_r("Error Create: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }

?>
