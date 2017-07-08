<?php
require_once('baseDatos.php');
require_once('ContratoClass.php');
require_once ('cliente.php');
require_once ('iTablaDB.php');

class Cuentas extends iTablaDB
{
	private $esAdmin;
	private $idCliente;
	
	public function getidCliente()
	{
		return $this->idCliente;
	}
	
	public function getIdCuenta()
	{
		return $this->id;
	}
	
	public function isAdmin()
	{
		return $this->esAdmin;
	}
	
	
	public function recuperarCliente($id)
	{
		if(!$this->conecta())
		{
			die('Cuentas::obtenCuentas: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = "SELECT
					*
				  FROM
				  	Cuenta
				  WHERE
				  	Cliente_id_cliente = $id";
					
		$resultado = $this->conexion->query($query);
		
		while ($fila = $resultado -> fetch_assoc())
				$cuenta[] = $fila;	

		if(isset($cuenta))
		{
			$usuario = new Cliente();
			$usuario->reconstruirCliente($cuenta[0]['Cliente_id_cliente']);
			$cuentaObtenida['nombre_usuario'] 	=  $cuenta[0]['nombre_usuario'];
			$cuentaObtenida['clave_acceso']	 	=  $cuenta[0]['clave_acceso'];
			$cuentaObtenido['admin']			=  $cuenta[0]['admin'];
			$cuentaObtenida['idCliente']		=  $usuario->getIdCliente();
			$cuentaObtenida['esPersonaFisica'] 	=  $usuario->getPersonaFisica();
			$cuentaObtenida['nombre'] 			=  $usuario->getName();
			$cuentaObtenida['apellidoPat'] 		=  $usuario->getApellidoPaterno();
			$cuentaObtenida['apellidoMat']		=  $usuario->getApellidoMaterno();
			$cuentaObtenida['RFC'] 				=  $usuario->getRFC();
			$cuentaObtenida['telefonos'] 		=  $usuario->getTelefono();
			$cuentaObtenida['cuentasBancarias'] =  $usuario->getCuentaBancaria();
			$cuentaObtenida['emails']			=  $usuario->getEmail();
			$cuentaObtenida['domicilios'] 		=  $usuario->getDomicilio();
			$cuentaObtenida['idEntidad'] 		=  $usuario->getIdEntidad();
			
			$this->id 							= $cuenta[0]['id_cuenta'];
			$this->esAdmin						= $cuenta[0]['admin'];
			$this->idCliente					= $usuario->getIdCliente();
		}
		
		$this->cerrar_conexion();
		
		return $cuentaObtenida;
	}		

	public function recuperar($id)
	{
		if(!$this->conecta())
		{
			die('Cuentas::obtenCuentas: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = "SELECT
					*
				  FROM
				  	Cuenta
				  WHERE
				  	id_cuenta = $id";
					
		$resultado = $this->conexion->query($query);
		
		while ($fila = $resultado -> fetch_assoc())
				$cuenta[] = $fila;	

		$this->cerrar_conexion();
		
		if(isset($cuenta))
		{
			$cuentaObtenido['admin']			=  $cuenta[0]['admin'];
			$cuentaObtenida['nombre_usuario'] 	=  $cuenta[0]['nombre_usuario'];
			$cuentaObtenida['clave_acceso']	 	=  $cuenta[0]['clave_acceso'];
			$this->id 							= $cuenta[0]['id_cuenta'];
			$this->idCliente					= $cuenta[0]['Cliente_id_cliente'];
			$this->esAdmin						= $cuenta[0]['admin'];
			
			return TRUE;
		}
		else
		{
			return FALSE;	
		}
	}

	public  function insertar(){}
    public  function eliminar(){}
    public  function modificar($campo, $valor)
    {
    	if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$query = "	UPDATE  
						Cuenta
					SET
						$campo = '$valor'
					WHERE
						id_cuenta = $this->id";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo de la cuenta: ".$this->conexion->errno.':'.$this->conexion->error;
			$exito = FALSE;
		}
		else
		{
			$exito = TRUE;
		}

		$this->cerrar_conexion();

		return $exito;
    }
	
	
	/**
	 * Se puede sacar un array con todos los contratos relacionados con esta cuenta
	 */
	public function obtenerContratos()
	{
		if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = "SELECT
					id_contrato
				  FROM
				  	Contrato
				  WHERE
				  	Cuenta_id_cuenta = $this->id";
					
		$resultado = $this->conexion->query($query);
		
		if($this->conexion->errno)
		{
			echo 'FALLO al obtener contratos de la cuenta'.$this->conexion->errno.' : '.$this->conexion->error;
			
			$this->conexion -> close();
			return null;
		}
		else
		{
			$this->cerrar_conexion();

			while ($fila = $resultado -> fetch_assoc())
				$resultados[] = $fila;
			
			if(isset($resultados))
			{
				$tam = count($resultados);
			
				for($i = 0; $i < $tam; $i++)
				{
					$contrato = new Contrato();
					$contrato->recuperarChafa($resultados[$i]['id_contrato']);
					$contratos[] = $contrato;
				}

				
				return $contratos;	
			}
			
			return null;
					
		}
	}
}
?>
	