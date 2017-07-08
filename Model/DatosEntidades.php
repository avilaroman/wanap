<?php

require_once ('iTablaDB.php');


class Telefono extends iTablaDB
{
  	private $numero;
	private $id_propietario;
	
	public function __construct($id_propietario, $numero)
	{
		$this->id_propietario = $id_propietario;
		$this->numero = $numero;
	}
	
	public function getNumero()
	{
		return $this->numero;
	}
		
   	public function insertar()
   	{
   		
   		if(!$this->conecta())
		{
			die('DatosEntidades::Telefono: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " INSERT INTO
						Telefono(Entidad_id_entidad, telefono)
					VALUES
						($this->id_propietario,
						'$this->numero')";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::Telefono -> No se pudo insertar el Telefono: '.$this->conexion->errno.':'.$this->conexion->error;
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
			die('DatosEntidades::Telefono: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Telefono
					WHERE
						id_telefono = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::Telefono -> No se pudo eliminar el Telefono: '.$this->conexion->errno.':'.$this->conexion->error;
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
						Telefono
					SET
						$campo = '$valor'
					WHERE
						id_telefono = $this->id";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo del telefono: ".$this->conexion->errno.':'.$this->conexion->error;
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
						Telefono
				  WHERE
				  		$id = Entidad_id_entidad";

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
				$telefono[] = $fila;
			
			if(isset($telefono))
			{
				$this->numero 			= $telefono[0]['telefono'];
				$this->id_propietario	= $telefono[0]['Entidad_id_entidad'];
				$this->id 				= $telefono[0]['id_telefono'];
				return TRUE;	
			}
			return FALSE;
		}
	}
}

class CuentaBanco extends iTablaDB
{
	private $nombreBanco;
	private $numeroCuenta;
	private $idDuenio;
	
	public function __construct($idDuenio, $nombreBanco, $numeroCuenta)
	{
		$this->nombreBanco = $nombreBanco;
		$this->numeroCuenta = $numeroCuenta;
		$this->idDuenio = $idDuenio;
	}
	
	public function getNombreBanco()
	{
		return $this->nombreBanco;
	}
	
	public function getNumeroDeCuenta()
	{
		return $this->numeroCuenta;
	}
	
	public function insertar()
	{
		if(!$this->conecta())
		{
			die('DatosEntidades::CuentaBanco: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		//$this->nombreBanco = $this->limpiarCadena($this->nombreBanco);


		$query = "	INSERT INTO 
						Cuenta_Bancaria (Entidad_id_entidad,num_cuenta)
					VALUES 
						($this->idDuenio,
						'$this->numeroCuenta')";
		//$resultado = $this->consulta($query);
		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo 'DatosEntidades::CuentaBanco -> No se pudo insertar la cuenta bancaria: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			
			$this->id = $this->conexion->insert_id;
			
			$query = "  SELECT 
							id_banco
						FROM
							Banco
						WHERE
							nombre LIKE '$this->nombreBanco'";
							
			$resultado = $this->conexion->query($query);
							
			while ($fila = $resultado -> fetch_assoc())
				$banco[] = $fila;
			
			if(isset($banco))
			{
				$idBanco = $banco[0]['id_banco'];
				
				$query = "	INSERT INTO 
								Cuenta_Bancaria_has_Banco (Cuenta_Bancaria_id_cuenta_Bancaria, Banco_id_banco)
							VALUES 
								($this->id, $idBanco)";
				
				$resultado = $this->conexion->query($query);

				if(!$resultado)
				{
					echo 'DatosEntidades::CuentaBanco -> No se pudo relacionar la cuenta del banco: '.$this->conexion->errno.':'.$this->conexion->error;
					$retornable = FALSE;
				}
						
				$retornable = TRUE;
			}
			else
			{
				 $retornable = FALSE;
			}
			
		}

		$this->cerrar_conexion();

		return $retornable;
	}
    public function eliminar()
    {
    	if(!$this->conecta())
		{
			die('DatosEntidades::CuentaBanco: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Cuenta_Bancaria
					WHERE
						id_cuenta_Bancaria = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::CuentaBanco -> No se pudo eliminar la Cuenta Bancaria: '.$this->conexion->errno.':'.$this->conexion->error;
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
    {}
	
	public function recuperar($id)
	{
		if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}


		$query = "SELECT
						*
				  FROM
						Cuenta_Bancaria
				  WHERE
				  		Entidad_id_entidad = $id";

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
			

			while ($fila = $resultado -> fetch_assoc())
				$cuenta[] = $fila;
			
			if(isset($cuenta))
			{
				$this->numeroCuenta 	= $cuenta[0]['num_cuenta'];
				$this->id				= $cuenta[0]['id_cuenta_Bancaria'];
				
				$query = "SELECT
							nombre
				  		  FROM
							Banco
				  		  WHERE
				  			id_banco = (SELECT Banco_id_banco FROM Cuenta_Bancaria_has_Banco WHERE Cuenta_Bancaria_id_cuenta_Bancaria = $this->id)";
							
				while ($fila = $resultado -> fetch_assoc())
					$cuenta2[] = $fila;			
				$this->cerrar_conexion();
				if(isset($cuenta2))
				{
					$this->nombreBanco	= $cuenta2[0]['nombre'];
					
					return TRUE;
				}
				
				return FALSE;	
			}
			
			$this->cerrar_conexion();
			
			return FALSE;
					
		}
	}
}

class Email extends iTablaDB
{
	private $email;
	private $id_propietario;
	
	public function __construct($id_propietario, $email)
	{
		$this->id_propietario = $id_propietario;
		$this->email = $email;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
		
   	public function insertar()
   	{	
   		if(!$this->conecta())
		{
			die('DatosEntidades::Email: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " INSERT INTO
							Email(Entidad_id_entidad, email)
						VALUES
							($this->id_propietario,
							'$this->email')";				
		$resultado = $this->conexion->query($query);
			
		if(!$resultado)
		{
			echo 'DatosEntidades::Email -> No se pudo insertar el email: '.$this->conexion->errno.':'.$this->conexion->error;
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
			die('DatosEntidades::Email: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Email
					WHERE
						id_email = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::Email -> No se pudo eliminar el Email: '.$this->conexion->errno.':'.$this->conexion->error;
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
						Email
					SET
						$campo = '$valor'
					WHERE
						id_email = $this->id";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo del Email: ".$this->conexion->errno.':'.$this->conexion->error;
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
						Email
				  WHERE
				  		$id = Entidad_id_entidad";

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
				$email[] = $fila;
			
			if(isset($email))
			{
				$this->email 			= $email[0]['email'];
				$this->id_propietario	= $email[0]['Entidad_id_entidad'];
				$this->id 				= $email[0]['id_email'];
				return TRUE;	
			}
			
			return FALSE;
					
		}
	}
}

class Direccion extends iTablaDB
{
	private $calle;
	private $numInterior;
	private $numExterior;
	private $colonia;
	private $codigoPostal;
	private $estado;
	private $municipio;
	private $idDuenio;
	
	public function __construct($idDuenio, $calle, $numInterior, $numExterior, $colonia, $codigoPostal, $estado, $municipio)
	{
		$this->calle 		= $calle;
		$this->numInterior 	= $numInterior;
		$this->numExterior 	= $numExterior;
		$this->colonia 		= $colonia;
		$this->codigoPostal = $codigoPostal;
		$this->estado 		= $estado;
		$this->municipio 	= $municipio;
		$this->idDuenio		= $idDuenio;
		
		if($this->numExterior == '')
		{
			$this->numExterior = 0;
		}
	}
	
	public function getCalle()
	{
		return $this->calle;
	}
	
	public function getNumInterior()
	{
		return $this->numInterior;
	}
	
	public function getNumExterior()
	{
		if($this->numExterior != 0)
		{
			return "-".$this->numExterior;
		}
		else 
		{
			return "";
		}
	}
	
	public function getColonia()
	{
		return $this->colonia;
	}
	
	public function getCodigoPostal()
	{
		return $this->codigoPostal;
	}
	
	public function getEstado()
	{
		return $this->estado;
	}
	
	public function getMunicipio()
	{
		return $this->municipio;
	}
	
	public function insertar()
	{
		if(!$this->conecta())
		{
			die('DatosEntidades::Direccion: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$this->calle 		= $this->limpiarCadena($this->calle);
		$this->colonia 		= $this->limpiarCadena($this->colonia);
		$this->estado 		= $this->limpiarCadena($this->estado);
		$this->municipio 	= $this->limpiarCadena($this->municipio);


		$query = "	INSERT INTO 
						Domicilio (calle, num_interior, num_exterior, colonia, codigo_postal, stado, municipio)
					VALUES 
						('$this->calle',
						$this->numInterior,
						$this->numExterior,
						'$this->colonia',
						$this->codigoPostal,
						'$this->estado',
						'$this->municipio')";
		
		//$resultado = $this->consulta($query);
		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo 'DatosEntidades::Direccion -> Error al insertar la direccion: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->id = $this->conexion->insert_id;
			
			$query = " INSERT INTO
							Entidad_has_Domicilio(Entidad_id_entidad, Domicilio_id_domicilio)
						VALUES
							($this->idDuenio, $this->id)";
			$resultado = $this->conexion->query($query);
			
			if(!$resultado)
			{
				echo 'DatosEntidades::Direccion -> Error al relacionar una direccion con una entidad: '.$this->conexion->errno.':'.$this->conexion->error;
				$retornable = FALSE;
			}
			else
			{
				$retornable = TRUE;
			}
			
		}

		$this->cerrar_conexion();

		return $retornable;
	}
	
    public function eliminar()
    {
    	if(!$this->conecta())
		{
			die('DatosEntidades::Direccion: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Domicilio
					WHERE
						id_domicilio = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::Direccion -> No se pudo eliminar la Direccion: '.$this->conexion->errno.':'.$this->conexion->error;
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
						Domicilio
					SET
						$campo = '$valor'
					WHERE
						id_domicilio = $this->id";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo del Domicilio: ".$this->conexion->errno.':'.$this->conexion->error;
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
						Domicilio
				  WHERE
				  		id_domicilio = (SELECT Domicilio_id_domicilio FROM Entidad_has_Domicilio WHERE $id = Entidad_id_entidad)";
				  		

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
				$domiclio[] = $fila;
			
			if(isset($domiclio))
			{
				$this->calle			= $domiclio[0]['calle'];
				$this->numInterior		= $domiclio[0]['num_interior'];
				$this->numExterior		= $domiclio[0]['num_exterior'];
				$this->colonia			= $domiclio[0]['colonia'];
				$this->codigoPostal		= $domiclio[0]['codigo_postal'];
				$this->estado			= $domiclio[0]['stado'];
				$this->municipio		= $domiclio[0]['municipio'];
				$this->idDuenio			= $id;
				$this->id				= $domiclio[0]['id_domicilio'];
				return TRUE;	
			}
			
			return FALSE;
					
		}
	}
}
?>