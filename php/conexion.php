<?php

class conexion{
   
    //DB Local
    
    const user='root'; //nombre de usuario de la DB
    const pass=''; //Contraseña de la DB
    const db='temperin'; // Nombre de la DB
    const servidor='LOCALHOST'; //Nombre del HOST

    public function conectardb(){
        $conectar = new mysqli(self::servidor, self::user,self::pass,self::db);
        if($conectar->connect_error){
            die("Error en la conexion".$conectar->connect_error);
        }
        return $conectar;
    }  
    
    public function desconectarDB(){
        

        mysqli_close();
    }  
}

?>

