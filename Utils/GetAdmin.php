<?php
require('../Model/CuentasClass.php');
//require_once('DebugerPHP.php');

if(!isset($_SESSION))
    session_start();

$Getter = new Cuentas();

$Getter->recuperarCliente($_SESSION['id']);

//var_dump($Getter);

//logConsole('$clientes var', $clientes, true);

/*if($admin==null)
{
	logConsole('NO SACA LA INFO CORRECTAMENTE', $Getter, true);
}*/

$arreglo = array(array('admin' => $Getter->isAdmin()));

echo json_encode($arreglo);

?>