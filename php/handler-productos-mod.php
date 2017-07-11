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

    if (isset($_POST['Modificar-productos'])) {
        $sql = "UPDATE productos SET grupo = '".$_POST['grupo_productos']."', zona = '".$_POST['zona_productos']."', nombre = '".$_POST['nombre_productos']."', unidad = '".$_POST['unidad_productos']."', stock = '".$_POST['stock_productos']."', stocke = '".$_POST['stocke_productos']."', offset_stocka = '".$_POST['offset_productos']."', stocka = '".$_POST['stocka_productos']."', moneda = '".$_POST['moneda_productos']."', compra = '".$_POST['compra_productos']."', venta = '".$_POST['venta_productos']."', detalles = '".$_POST['detalles_productos']."' WHERE id = '".$_POST['ID_productos_form']."'";

        if (mysqli_query($conn, $sql)){
            print_r("Producto Actualizado!");
        }else {
            print_r("Error Update: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }

?>
