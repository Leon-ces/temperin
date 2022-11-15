<?php require_once('conexion.php');

$connect = mysqli_connect('localhost', 'root', '', 'temperin');

$query = 'SELECT temperatura, humedad
FROM estado
WHERE fecha = (SELECT MAX( fecha ) FROM estado);';

$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($result)) {
    echo "
    <div class='column has-text-centered'>
        <h2 class='is-size-4 has-text-warning'>Temperatura Registrada</h2>
        <h2 class='is-size-1'>" . $row["temperatura"]. " °C</h2>
    </div>
    <div class='column has-text-centered'>
        <h2 class='is-size-4 has-text-warning'>Humedad Registrada</h2>
        <h2 class='is-size-1'>" . $row["humedad"]. " %</h2>
    </div></h1>";
}


?>