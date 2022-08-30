<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temperin";

$temperatura = "60.0";
$humedad = "17";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO estado (fecha, temperatura, humedad)
VALUES (null, $temperatura, $humedad)";

if ($conn->query($sql) === TRUE) {
  echo "Temperatura añadida jaja";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 