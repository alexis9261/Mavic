<?php
include_once 'common/conexion.php';
//Leer el valor de dolar en base de datos
$sql= "SELECT VALUE FROM VARIABLES WHERE NOMBRE ='TASAUSD' LIMIT 1";
$res= $conn->query($sql);

while($f=$res->fetch_assoc()){
    $tasa_usd = $f['VALUE'];
}
?>
