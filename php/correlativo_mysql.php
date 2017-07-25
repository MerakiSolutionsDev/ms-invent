<?php
    SESSION_START();
    header("Access-Control-Allow-Origin: *");
    if(!isset($_SESSION['db'])){
        header("Location: http://www.merakisolutionsdev.com/rent/ms-invent/html/login.html");
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

    $query1 = "SELECT id_transaction FROM `regdocumentos` ORDER BY id DESC LIMIT 1";

    $result = mysqli_query($connect,$query1);

    while ($row = mysqli_fetch_assoc($result)) {
        $id_transaction = $row['id_transaction'];
    }

    $id_transaction = intval($id_transaction) + 1;

    $outp .= '{"CORR":"' . $id_transaction . '"}';
    $outp ='{"records":['.$outp.']}';

    mysqli_close($conn);

    echo $outp;
?>
