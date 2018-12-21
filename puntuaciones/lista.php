<?php
echo "Opening connection.\n";
$con = pg_connect(getenv("DATABASE_URL"));
if ($con->connect_errno) {
    echo 'Error al conectar base de datos: ', $con->connect_error;
    exit(); 
}

echo "Preparing statement.\n";

$sql = 'SELECT puntos, nombre FROM puntuaciones ORDER BY fecha DESC';

if (isset($_GET['max'])) {
   $sql .= ' LIMIT ?';
}

echo "Statement prepared: $sql.\n";
$result = pg_query($con, $sql);
if (!$result) {
    echo "An error occurred.\n";
    exit;
}
echo "Rows fetched!\n";
while ($score = pg_fetch_object($result)) {
    echo $score->puntos." - ".$score->nombre."\n";
}

echo "Closing connection.\n";
// Closing connection
pg_close($con);
?>