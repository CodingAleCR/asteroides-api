<?php
echo "Opening connection.<br/>";
$con = pg_connect(getenv("DATABASE_URL"));
if ($con->connect_errno) {
    echo 'Error al conectar base de datos: ', $con->connect_error;
    exit(); 
}

echo "Preparing statement.<br/>";

$sql = 'SELECT puntos, nombre FROM puntuaciones ORDER BY fecha DESC';

if (isset($_GET['max'])) {
   $sql .= ' LIMIT ?';
}

echo "Statement prepared: $sql.<br/>";
$result = pg_query($con, $sql);
if (!$result) {
    echo "An error occurred.<br/>";
    exit;
}
echo "Rows fetched!<br/>";
while ($data = pg_fetch_object($result)) {
    echo $data->puntos . " - ";
    echo $data->nombre . "<br />";
  }
pg_free_result($result);
echo "Closing connection.<br/>";
// Closing connection
pg_close($con);
?>