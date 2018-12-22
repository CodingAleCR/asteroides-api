<?php
$con = pg_connect(getenv("DATABASE_URL")) or die ("Could not connect to server\n"); 

$sql = 'SELECT puntos, nombre FROM puntuaciones ORDER BY fecha DESC';

if (isset($_GET['max'])) {
   $sql .= " LIMIT ".$_GET['max'];
}

$result = pg_query($con, $sql) or die("Cannot execute query: $query\n");

while ($row = pg_fetch_assoc($result)) {
    echo $row['puntos'] . " - " . $row['nombre'];
    echo "\n";
}

pg_free_result($result);
pg_close($con);
?>