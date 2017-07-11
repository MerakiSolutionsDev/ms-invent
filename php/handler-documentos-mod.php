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

    if (isset($_POST['Modificar-documentos'])) {

        $sql = "UPDATE documentos SET abrev = '".$_POST['abrev_documentos']."', nombre = '".$_POST['nombre_documentos']."', tipo = '".$_POST['tipo_documentos']."', naturaleza = '".$_POST['naturaleza_documentos']."', uso = '".$_POST['uso_documentos']."', detalles = '".$_POST['detalles_documentos']."' WHERE id = '".$_POST['ID_documentos_form']."'";

        if (mysqli_query($conn, $sql)){
            consolo.log("Documento Actualizado!");
        }else {
            consolo.log("Error Update: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }

?>
