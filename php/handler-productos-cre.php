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

    if(isset($_POST['Crear-productos'])){
        $sql = "INSERT INTO productos (grupo, igv, nombre, unidad, peso, factor, stock, stocke, offset_stocka, stocka, moneda, compra) VALUES ('".$_POST['grupo_productos']."','".$_POST['zona_productos']."','".$_POST['nombre_productos']."','".$_POST['unidad_productos']."','".$_POST['peso_productos']."','".$_POST['factor_productos']."','".$_POST['stock_productos']."','".$_POST['stocke_productos']."','".$_POST['offset_productos']."','".$_POST['stocka_productos']."','".$_POST['moneda_productos']."','".$_POST['compra_productos']."')";

        if (mysqli_query($conn, $sql)){
            print_r ("Producto creado satisfactoriamente!");
        }else {
            print_r("Error Create: ". mysqli_error($conn));
        }
        mysqli_close($conn);
    }
?>
