<?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        die("Invalid request method");
    }

    $servername = $_ENV['MYSQLDB_PORT_3306_TCP_ADDR'];
    $username = "root";
    $password = $_ENV['MYSQLDB_ENV_MYSQL_ROOT_PASSWORD'];
    $dbname = "sampledb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //TODO: sanitize these inputs
    $vendor = $_POST["vendor"];
    $ingredient = $_POST["ingredient"];

    $sql = "INSERT INTO submissions (vendor, ingredient) VALUES ('".$vendor."', '".$ingredient."')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    header( 'Location: success.html' ) ;
?>