<?php require_once('conexion.php');

$connect = mysqli_connect('localhost', 'root', '', 'temperin');

$query = 'SELECT temperatura, humedad
FROM estado
WHERE fecha = (SELECT MAX( fecha ) FROM estado);';

$result = mysqli_query($connect, $query);
$json_result = array();


while($row = mysqli_fetch_assoc($result)) {
    $json_result[] = $row;
}

echo json_encode($json_result);


?>