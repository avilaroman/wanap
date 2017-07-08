<?php

require_once ('iTablaDB.php');

class Gasto extends iTablaDB
{
	private $id_contrato;
	private $costo;
	private $precio;
	private $comentario;
	private $categoria;
	private $cuenta_origen;
	private $cuenta_destino;
	private $comision;
	private $fecha;
	
	public function __construct($id_contrato="", $costo="", $precio="", $comentario="", 
								$categoria="", $cuenta_origen="", $cuenta_destino="", $comision="", $fecha = "")
	{
		$this->id_contrato 		= $id_contrato;
		$this->costo 			= $costo;
		$this->precio 			= $precio;
		$this->comentario 		= $comentario;
		$this->categoria 		= $categoria;
		$this->cuenta_origen 	= $cuenta_origen;
		$this->cuenta_destino 	= $cuenta_destino;
		$this->comision 		= $comision;
		$this->fecha			= $fecha;
	}
	
	public function getCosto()
	{
		return $this->costo;
	}
	
	public function getPrecio()
	{
		return $this->precio;
	}
	
	public function getComentario()
	{
		return $this->comentario;
	}
	
	public function getCategoria()
	{
		return $this->categoria;
	}
	
	public function getCuentaOrigen()
	{
		return $this->cuenta_origen;
	}
	
	public function getCuentaDestino()
	{
		return $this->cuenta_destino;
	}
	
	public function getComision()
	{
		return $this->comision;
	}
	
	public function getFecha()
	{
		return $this->fecha;
	}
		
   	public function insertar()
   	{	
   		if(!$this->conecta())
		{
			die('Gasto: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " INSERT INTO
							Gasto(Contrato_id_contrato, costo, precio, comentario, categoria, cuenta_origen, cuenta_destino, comision, fecha)
						VALUES
							($this->id_contrato,
							$this->costo,
							$this->precio,
							'$this->comentario',
							'$this->categoria',
							'$this->cuenta_origen',
							'$this->cuenta_destino',
							'$this->comision',
							'$this->fecha
							)";		
									
		$resultado = $this->conexion->query($query);
			
		if(!$resultado)
		{
			echo 'Gasto::Insertar -> No se pudo insertar el gasto: '.$this->conexion->errno.':'.$this->conexion->error;
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
			die('Gasto::Eliminar: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Gasto
					WHERE
						id_gasto = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'Gasto::Eliminar -> No se pudo eliminar el gasto: '.$this->conexion->errno.':'.$this->conexion->error;
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
						Gasto
					SET
						$campo = '$valor'
					WHERE
						id_gasto = $this->id";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo del gasto: ".$this->conexion->errno.':'.$this->conexion->error;
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
						Gasto
				  WHERE
				  		id_gasto = $id";

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
				$gasto[] = $fila;
			
			if(isset($gasto))
			{
				$this->id_contrato		= $gasto[0]['Contrato_id_contrato'];
				$this->costo 			= $gasto[0]['costo'];
				$this->precio			= $gasto[0]['precio'];
				$this->id 				= $gasto[0]['id_gasto'];
				$this->comentario 		= $gasto[0]['comentario'];
				$this->categoria 		= $gasto[0]['categoria'];
				$this->cuenta_origen 	= $gasto[0]['cuenta_origen'];
				$this->cuenta_destino 	= $gasto[0]['cuenta_destino'];
				$this->comision 		= $gasto[0]['comision'];
				$this->fecha			= $gasto[0]['fecha'];
				return TRUE;	
			}
			
			return FALSE;
					
		}
	}
}
?>