<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

    <div class="container xs">  

    </div>

    <div class="container text-center">
        

        <button><a href="./php/upload.php">CLICKEAMEEEEE</a></button>
        <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
            <div class="col">
                <h4></h4>
            </div>

            <div class="col">
                <?php require_once('php/conexion.php');

                $connect = mysqli_connect('localhost', 'root', '', 'temperin');

                $query = 'SELECT temperatura, humedad
                FROM estado
                WHERE fecha = (SELECT MAX( fecha ) FROM estado);';

                $result = mysqli_query($connect, $query);

                while($row = mysqli_fetch_assoc($result)) {
                    echo "<h2> " . $row["temperatura"]. "°  " . $row["humedad"]. "% </h2>";
                }


                ?>
            </div>

            <div class="col">
                <h4></h4>
            </div>
        </div>        
        
    </div>

    

    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.js"></script>
</body>
</html>