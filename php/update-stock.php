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
    $counter = 0;

    $connect = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $data = json_decode(file_get_contents("php://input"));

    if (count($data) > 0) {

        for ($i=0; $i < count($data); $i++) {

            $_index = mysqli_real_escape_string($connect, $data[$i]->index);
            $_stock = mysqli_real_escape_string($connect, $data[$i]->stock);


            $query = "UPDATE productos SET stock = '$_stock' WHERE id = $_index";

            if(mysqli_query($connect,$query)){
                $counter = $counter + 1;
            }else{
                $counter = 0;
            }
        }

        if($counter > 0){
            echo "Stock Actualizado";
        }else{
            echo "Revise su conexión a internet : //stock";
        }
        mysqli_close($connect);
    }
?>
