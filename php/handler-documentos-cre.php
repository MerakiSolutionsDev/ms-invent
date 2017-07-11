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

    if(isset($_POST['Crear-documentos'])){
        $sql = "INSERT INTO documentos (abrev, nombre, tipo, naturaleza, uso, detalles) VALUES ('".$_POST['abrev_documentos']."','".$_POST['nombre_documentos']."','".$_POST['tipo_documentos']."','".$_POST['naturaleza_documentos']."','".$_POST['uso_documentos']."','".$_POST['detalles_documentos']."')";

        if (mysqli_query($conn, $sql)){
            print_r ("Documento creado satisfactoriamente!");
        }else {
            print_r("Error Create: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }
?>
