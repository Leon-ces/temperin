<?php require_once('conexion.php');

$connect = mysqli_connect('localhost', 'root', '', 'temperin');

$query = 'SELECT temperatura, humedad
FROM estado
WHERE fecha = (SELECT MAX( fecha ) FROM estado);';

$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($result)) {
    echo "<h1 class='estado' id='temp'>  " . $row["temperatura"]. "°  " . $row["humedad"]. "% </h1>";
}


?>