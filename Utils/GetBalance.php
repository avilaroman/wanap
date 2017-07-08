<?php
require_once('../Model/ContratoClass.php');
require_once('../Model/PagoClass.php');
require_once('../Model/GastoClass.php');
//require_once('DebugerPHP.php');
		$idContrato = $_GET['idContrato'];
		$contrato = new Contrato();
		$contrato->recuperar($idContrato);

		
		$pagos = $contrato->obtenerTodosLosPagos();
		$gastos = $contrato->obtenerTodosLosGastos();
		
		
		$tam = count($gastos);
		
		$gasto = 0;
		
		for($i = 0; $i < $tam; $i++)
		{
			$gasto = $gasto + $gastos[$i]->getPrecio();
		}
		
		$tam = count($pagos);
		
		$pago = 0;
		
		for($i = 0; $i < $tam; $i++)
		{
			$pago = $pago + $pagos[$i]->getMonto();
		}
		
		$balance = $gasto - $pago;
		
		$arreglo = array('balance' => $balance);
		
		echo json_encode($arreglo);

?>