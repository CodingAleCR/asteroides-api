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
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    foreach ($line as $col_value) {
        echo "$col_value<br />\n";
    }
}
pg_free_result($result);
echo "Closing connection.<br/>";
// Closing connection
pg_close($con);
?>