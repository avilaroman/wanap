<?php

require_once ('iTablaDB.php');

class Pago extends iTablaDB
{
	private $monto;
	private $fecha;
	private $id_contrato;
	
	public function __construct($id_contrato="", $monto="", $fecha="")
	{
		$this->id_contrato = $id_contrato;
		$this->monto = $monto;
		$this->fecha = $fecha;
	}
	
	public function getMonto()
	{
		return $this->monto;
	}
	
	public function getFecha()
	{
		return $this->fecha;
	}
		
   	public function insertar()
   	{	
   		if(!$this->conecta())
		{
			die('Pago: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " INSERT INTO
							Pago(Contrato_id_contrato, monto, fecha_pago)
						VALUES
							($this->id_contrato,
							$this->monto,
							'$this->fecha')";				
		$resultado = $this->conexion->query($query);
			
		if(!$resultado)
		{
			echo 'Pago::Insertar -> No se pudo insertar el pago: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->id = $this->conexion->insert_id;
			$retornable = TRUE;
		}
		
		$this->cerrar_conexion();
		return $retornable;
   	}
	
    public function eliminar()
    {
    	if(!$this->conecta())
		{
			die('Pago::Eliminar: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Pago
					WHERE
						id_pago = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'Pago::Eliminar -> No se pudo eliminar el pago: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$retornable = TRUE;
		}
		
		$this->cerrar_conexion();
		
		return $retornable;
    }
    public function modificar($campo, $valor)
    {
    	if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$query = "	UPDATE  
						Pago
					SET
						$campo = '$valor'
					WHERE
						id_pago = $this->id";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo del Pago: ".$this->conexion->errno.':'.$this->conexion->error;
			$exito = FALSE;
		}
		else
		{
			$exito = TRUE;
		}

		$this->cerrar_conexion();

		return $exito;
    }
	public function recuperar($id)
	{
		if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}


		$query = "SELECT
						*
				  FROM
						Pago
				  WHERE
				  		id_pago = $id";

		//Ejecutar el query
		$resultado = $this->conexion->query($query);

		if($this->conexion->errno)
		{
			echo 'FALLO '.$this->conexion->errno.' : '.$this->conexion->error;
			
			$this->conexion -> close();
			return FALSE;
		}
		else
		{
			$this->cerrar_conexion();

			while ($fila = $resultado -> fetch_assoc())
				$pago[] = $fila;
			
			if(isset($pago))
			{
				$this->id_contrato		= $pago[0]['Contrato_id_contrato'];
				$this->monto 			= $pago[0]['monto'];
				$this->fecha			= $pago[0]['fecha_pago'];
				$this->id 				= $pago[0]['id_pago'];
				return TRUE;	
			}
			
			return FALSE;
					
		}
	}
}
?>