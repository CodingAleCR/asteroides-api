<?php
$con = pg_connect(getenv("DATABASE_URL"));
if ($con->connect_errno) {
    echo 'Error al conectar base de datos: ', $con->connect_error;
    exit(); 
}

$sql = 'SELECT puntos, nombre FROM puntuaciones ORDER BY fecha DESC';

if (isset($_GET['max'])) {
   $sql .= ' LIMIT ?';
}

$result = pg_query($con, $sql);
if (!$result) {
    echo "An error occurred.\n";
    exit;
}
  
while ($score = pg_fetch_object($result)) {
    echo $score->puntos." - ".$score->nombre."\n";
}

// Closing connection
pg_close($con);
?>