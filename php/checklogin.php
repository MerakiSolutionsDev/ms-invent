<?php
    SESSION_START();

    $servername = "localhost";
    $username = "root";
    $password = "1nj7TkF94h";
    $dbname = "merakiso_ms-invent";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $uname = test_input($_POST["uname"]);
        $psw = test_input($_POST["psw"]);
    }

    if (!preg_match("/^[a-zA-Z]*$/",$uname) or !preg_match("/^[a-zA-Z0-9]*$/",$psw)) {
      $loginMsg = "Parece que no se ingreso un nombre o clave correcta!";
    }else{
        $loginMsg = "Bienvenido! ... lo estamos redireccionando ...";
        echo $loginMsg;
        if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                if (($row["uname"] == $uname)and($row["psw"] == $psw)){

                    $_SESSION['uname'] = $row['uname'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['mail'] = $row['mail'];
                    $_SESSION['type'] = $row['type'];
                    $_SESSION['db'] = $row['db'];


                    header("Location: http://localhost/Trammo/app/php/home.php");

                    break;
                }else{
                  $loginMsg = "Parece que el usuario no esta registrado! ... redireccionando a la pagina de login";

                  echo $loginMsg;

                  header("Location: http://localhost/Trammo/app/html/login.html");
                }
              }
        } else {
              echo "Parece que la lista esta vacia";
        }

        mysqli_close($conn);
    }

    function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
 ?>
