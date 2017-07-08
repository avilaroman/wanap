<?php

require_once('Model/CuentasClass.php');
require_once('Model/ContratoClass.php');
require_once('Model/PagoClass.php');
require_once('Model/GastoClass.php');
require_once('Utils/Cleaner.php');
//require_once('View/html.html');
class ControladorContrato{
	public $model;

	function ejecutar(){
		if(isset($_POST['accion'])){
		      $_REQUEST = Cleaner::LimpiarTodo($_POST);
		     switch ($_POST['accion']){

			case 'crear':
                if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
                $this->crearContrato();
                else{
                    echo "Shit happened or u t not Admin";
                }
				break;
			case 'pago':
				$this->realizarPago();
				break;
			case 'gasto':
				$this->realizarGasto();
				break;
                
            case 'consultar':
                //posible if que indique si es pago o gasto
                $usuario = $this->model->ConsultarPago();
                $usuario = $this->model->ConsultarGasto();
                break;
            case 'balance':
				$this->realizaBalance();
                break;
			
			default:
				echo 'Ola k ase?, ekivokandose o k ase? :v';
				break;
		}
		}

		$_REQUEST['uso'] = '';	
	}

    private function crearContrato()
    {
        $cuenta = new Cuentas();
		
        $usuario = $cuenta->recuperarCliente($_POST['idCliente']);
        $idEnt_Cont = $_POST['idEntidad'];
        $idCuenta = $cuenta->getIdCuenta();
        $fecha = $_POST['fecha'];
        $periodo = $_POST['periodo'];
        $presupuesto = $_POST['presupuesto'];
		
		if(isset($_POST['plazos']))
		{
			$plazos = TRUE;
		}
		else
		{
			$plazos = FALSE;
		}
		
        $renovacion = $_POST['renovacion'];
		
		if(isset($_POST['saldado']))
		{
			$saldado = TRUE;
		}
		else
		{
			$saldado = FALSE;
		}
		
		$asunto = $_POST['asunto'];
        
		$contrato = new Contrato($idCuenta, $idEnt_Cont, $fecha, $periodo, $presupuesto, $plazos, $renovacion, $saldado, $asunto);
		
		$contrato->insertar();
                
    }

    private function realizarPago()
    {
    	$idContrato = $_POST['idContrato'];
        $monto 		= $_POST['monto'];
        $fecha 		= $_POST['fecha'];
		
		$pago = new Pago($idContrato, $monto, $fecha);
		
		$pago->insertar();
    }
	
	private function realizarGasto()
    {
		$id_contrato	= $_POST['idContrato'];
		$costo 			= $_POST['costo'];
		$comentario 	= $_POST['comentario'];
		$categoria 		= $_POST['categoria'];
		$cuenta_origen 	= $_POST['cuenta_origen'];
		$cuenta_destino = $_POST['cuenta_destino'];
		$comision 		= $_POST['comision'];
		
		$precio			= $costo + $comision;
		
		$gasto = new Gasto($id_contrato, $costo, $precio, $comentario, $categoria, $cuenta_origen, $cuenta_destino, $comision);
		
		$gasto->insertar();
    }
	
	private function realizaBalance()
	{
		$idContrato = $_POST['idContrato'];
		$contrato = new Contrato();
		$contrato->recuperar($idContrato);
		
		$pagos = $contrato->obtenerTodosLosPagos();
		$gastos = $contrato->obtenerTodosLosGastos();
		
		
		$tam = count($gastos);
		
		$gasto = 0;
		
		for($i = 0; $i < $tam; $i++)
		{
			$gasto = $gasto + $gastos[$i]['precio'];
		}
		
		$tam = count($pagos);
		
		$pago = 0;
		
		for($i = 0; $i < $tam; $i++)
		{
			$pago = $pago + $pagos[$i]['monto'];
		}
		
		
		echo 'BALANCE $ '.($gasto - $pago);
	}
}


?>
