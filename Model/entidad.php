<?php

require_once('iTablaDB.php');
require_once('DatosEntidades.php');

class Entidad extends iTablaDB
{
	protected $nombre;
	protected $apellidoPat;
	protected $apellidoMat;
	protected $RFC;
	protected $telefonos;
	protected $cuentasBancarias;
	protected $emails;
	protected $domicilios;
	protected $idEntidad;

	public function __construct($nombre, $apellidoPat, $apellidoMat, $RFC)
	{
		$this->nombre 			= $nombre;
		$this->apellidoPat 		= $apellidoPat;
		$this->apellidoMat 		= $apellidoMat;
		$this->RFC 				= $RFC;
	}
	
	public function getName()
	{
		return $this->nombre;
	}
	
	public function getApellidoPaterno()
	{
		return $this->apellidoPat;
	}
	
	public function getApellidoMaterno()
	{
		return $this->apellidoMat;
	}
	
	public function getRFC()
	{
		return $this->RFC;
	}
	
	public function getTelefono()
	{
		return $this->telefonos;
	}
	
	public function getCuentaBancaria()
	{
		return $this->cuentasBancarias;
	}
	
	public function getEmail()
	{
		return $this->emails;
	}
	
	public function getDomicilio()
	{
		return $this->domicilios;
	}
	
	public function getIdEntidad()
	{
		return $this->idEntidad;
	}
	
	public function agregarTelefono($telefono)
	{
		$this->telefonos = $telefono;
	}
	
	public function agregarEmail($email)
	{
		$this->emails = $email;
	}
	
	public function agregarCuentaBancaria($cuentaBancaria)
	{
		$this->cuentasBancarias = $cuentaBancaria;
	}
	
	public function agregarDomicilio($domicilio)
	{
		$this->domicilios = $domicilio;
	}
	/////////////////////////////////////////////
	///    Implementaciones de iTablaDB        //
	/////////////////////////////////////////////
	
	public function insertar()
	{
		if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$this->nombre 			= $this->limpiarCadena($this->nombre);
		$this->apellidoPat 		= $this->limpiarCadena($this->apellidoPat);
		$this->apellidoMat 		= $this->limpiarCadena($this->apellidoMat);
		$this->RFC 				= $this->limpiarCadena($this->RFC);


		$query = "	INSERT INTO 
						Entidad (nombre, apellido_paterno, apellido_materno, RFC)
					VALUES
						('$this->nombre',
						'$this->apellidoPat',
						'$this->apellidoMat',
						'$this->RFC')";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo 'No se logro insertar la entidad: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->idEntidad = $this->conexion->insert_id;
			$retornable = $this -> idEntidad;
		}

		$this->cerrar_conexion();

		return $retornable;
	}

    public function eliminar()
    {
    	//No implementado porque venderemos despues esta info al FBI
    }
	
	
    public function modificar($campo, $valor)
    {
    	if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$query = "	UPDATE  
						Entidad
					SET
						$campo = '$valor'
					WHERE
						id_entidad = $this->idEntidad";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo de la entidad: ".$this->conexion->errno.':'.$this->conexion->error;
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
						Entidad
				  WHERE
				  		$id = id_entidad";

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
				$entidad[] = $fila;
			
			$this->nombre 			= $entidad[0]['nombre'];
			$this->apellidoPat 		= $entidad[0]['apellido_paterno'];
			$this->apellidoMat 		= $entidad[0]['apellido_materno'];
			$this->RFC 				= $entidad[0]['RFC'];
			$this->idEntidad		= $entidad[0]['id_entidad'];
			
			$telefono = new Telefono(0, 0);
			
			if($telefono->recuperar($this->idEntidad))
			{
				$this->agregarTelefono($telefono);
			}
			
			$email = new Email(0," ");
			
			if($email->recuperar($this->idEntidad))
			{
				$this->agregarEmail($email);
			}
			
			$domicilio = new Direccion(0," ", 0,0," ", 0, " ", " ");
			
			if($domicilio->recuperar($this->idEntidad))
			{
				$this->agregarDomicilio($domicilio);
			}
			
			return $entidad;			
		}
	}
}
?>