<?php
    SESSION_START();
    if(!isset($_SESSION['db'])){
        header("Location: http://www.merakisolutionsdev.com/rent/ms-invent/html/login.html");
        exit();
    }
    header("Access-Control-Allow-Origin: *");

    $servername = "localhost";
    $username = "merakiso";
    $password = "1nj7TkF94h";
    $dbname = $_SESSION['db'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['Crear-terceros'])){
        $sql = "INSERT INTO terceros (identi, identiClass, terceroClass,  nombre, ciudad, direccion, tel, detalles) VALUES ('".$_POST['identi_terceros']."','".$_POST['identiclass_terceros']."','".$_POST['terceroclass_terceros']."','".$_POST['nombre_terceros']."','".$_POST['ciudad_terceros']."','".$_POST['direccion_terceros']."','".$_POST['tel_terceros']."','".$_POST['detalles_terceros']."')";

        if (mysqli_query($conn, $sql)){
            print_r ("Tercero creado satisfactoriamente!");
        }else {
            print_r("Error Create: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }
?>
