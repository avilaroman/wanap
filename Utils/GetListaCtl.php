<?php
require('../Model/cliente.php');

$Getter = new Cliente();

$lista = $Getter -> obtenerClientes();

echo json_encode($lista);
?>