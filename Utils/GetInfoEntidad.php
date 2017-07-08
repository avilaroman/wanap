<?php
require('../Model/CuentasClass.php');
//require_once('DebugerPHP.php');

$cuenta = new Cuentas();
$cuenta = $cuenta->recuperarCliente($_GET['idCliente']);

if($cuenta==null)
{
	logConsole('NO SACA LA INFO CORRECTAMENTE', $usuario, true);
}
else 
{
	$domicilio = $cuenta['domicilios'];
	$telefono = $cuenta['telefonos'];
	$cuentaBancaria = $cuenta['cuentasBancarias'];
	$email = $cuenta['emails'];
	
	$arreglo = array(
					array(
					 'usuario' => $cuenta['nombre_usuario'],
					 'password' => $cuenta['clave_acceso'],
					 'nombre' => $cuenta['nombre'],
					 'apellidoP' => $cuenta['apellidoPat'],
					 'apellidoM' => $cuenta['apellidoMat'],
					 'rfc' => $cuenta['RFC'],
					 'telefono' => $telefono->getNumero(),
					 'personaFisica' => $cuenta['esPersonaFisica'],
					 'email' => $email->getEmail(),
					 //'cuentaBanco' => $cuentaBancaria->getCuentaBancaria(),
					 'calle' => $domicilio->getCalle(),
					 'numInt' => $domicilio->getNumInterior(),
					 'numExt' => $domicilio->getNumExterior(),
					 'colonia' => $domicilio->getColonia(),
					 'cp' => $domicilio->getCodigoPostal(),
					 'estado' => $domicilio->getEstado(),
					 'municipio' => $domicilio->getMunicipio()

	));
	echo json_encode($arreglo);
}

?>