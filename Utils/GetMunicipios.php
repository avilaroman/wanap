<?php
require_once('../Model/EstadoMunicipio.php');

$Getter = new Localidades();

$municipios = $Getter->obtenMunicipios($_GET['idEstado']);

echo json_encode($municipios);

?>