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

    if (isset($_POST['Modificar-grupos'])) {
        $sql = "UPDATE grupos SET nombre = '".$_POST['nombre_grupos']."', detalles = '".$_POST['detalles_grupos']."' WHERE id = '".$_POST['ID_grupos_form']."'";

        if (mysqli_query($conn, $sql)){
            print_r("Grupo Actualizada!");
        }else {
            print_r("Error Update: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }

?>
