<?php
require_once('../Model/CuentasClass.php');
//require_once('DebugerPHP.php');

$Getter = new Cuentas();

$Getter->recuperar($_GET['idCliente']);

//logConsole('GETTER', $Getter, true);

$contrato = $Getter->obtenerContratos();
//var_dump($Getter);

//echo '------------------------------------';
if($contrato==null)
{
	//logConsole('NO SACA LA INFO CORRECTAMENTE', $Getter, true);
}

//var_dump($arreglo);
echo json_encode($contrato);

?>