<?php


$id = $_GET['id'];
$nombre = $_GET['nombre'];

$filename = 'miarchivo.xls';
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $id;
echo $nombre;


?>