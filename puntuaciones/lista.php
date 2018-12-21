<?php
$con = new pg_connect(
    "host=ec2-174-129-25-182.compute-1.amazonaws.com port=5432 
    dbname=dfkl0aljghn8kt 
    user=rbplczgwhcoxmo 
    password=08098b73d31e842c91345d0464308801f1d09578d88acb0523ac6767fc0b5fab"
); 
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