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

    if(isset($_POST['Crear-terceros'])){
        $sql = "INSERT INTO terceros (identi, identiClass, terceroClass,  nombre, direccion, contacto, mail, tel) VALUES ('".$_POST['identi_terceros']."','".$_POST['identiclass_terceros']."','".$_POST['terceroclass_terceros']."','".$_POST['nombre_terceros']."','".$_POST['ciudad_terceros']."','".$_POST['direccion_terceros']."','".$_POST['contacto_terceros']."','".$_POST['mail_terceros']."','".$_POST['tel_terceros']."')";

        if (mysqli_query($conn, $sql)){
            print_r ("Tercero creado satisfactoriamente!");
        }else {
            print_r("Error Create: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }
?>
