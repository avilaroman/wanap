<?php
require_once('../Model/EstadoMunicipio.php');
//require_once('DebugerPHP.php');
$Getter = new Localidades();

$estados = $Getter->obtenEstados();

//logConsole('$estados var', $estados, true);

echo json_encode($estados);

?>