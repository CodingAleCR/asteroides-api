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

$cursor = $con->stmt_init(); 
if ($cursor->prepare($sql)) { 
    if (isset($_GET['max'])) {
        $cursor->bind_param("s",$_GET['max']);
    }
    $cursor->execute(); $cursor->bind_result($puntos, $nombre); while($cursor->fetch()) {
        echo $puntos.' '.$nombre."\n";
    }
    echo "\n";
    $cursor->close();
}

$con->close();
?>