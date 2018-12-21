<?php
$con = pg_connect(getenv("DATABASE_URL")) or die ("Could not connect to server\n"); 

   $puntos = $_GET['puntos'];
   $nombre = htmlspecialchars($_GET['nombre']);
   $fecha  = $_GET['fecha'];


   $sql = "INSERT INTO puntuaciones VALUES (null,$puntos, $nombre, $fecha)";

   pg_query($con, $sql) or die("Cannot execute query: $query\n");

   echo 'OK\n';
pg_close($con);
?>