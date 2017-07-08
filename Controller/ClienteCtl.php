<?php

require('Model/cliente.php');
require('Model/CuentasClass.php');
//require_once('View/html.html');
//require_once('Utils/DebugerPHP.php');

class ControladorCliente
{
	public $modelo;
	
	public function ejecutar()
	{
		if(!isset($_SESSION))
		{
			session_start();
		}
		
		//si no hya parametros, nomas listar los usuarios
		if(!isset($_REQUEST['accion']) )
		{
			die('No se definio que accion tomar');	
		}
		else
		{
		    $_REQUEST = Cleaner::LimpiarTodo($_REQUEST);
			
            switch ($_REQUEST['accion']) 
			{
				case 'insertar':
					if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
						//if(isset ($_POST['name']) && !isset($_POST['exito'])){
							$modelo = $this->InsertarCliente();
							$this->enviarEmail();
							$_REQUEST['uso'] = '';	
						//}
						//elseif(isset($_POST['exito'])){
							//llamar vista exito
						//}
						//elseif(empty($_POST)){
							//llamar vista formulario
						//}
					}
					break;
				case 'modificar':
					if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
						//if(isset($_POST['name']) && !isset($_POST['exito'])){
							$this->modelo = new Cliente();
							$this->modelo->reconstruirCliente($_POST['seleccionado']);
							
							$this->modificarCliente();
							$_REQUEST['uso'] = '';
						//}
					}
					//{
						
					//}
					//else
					//{
					//	echo "No tienes poderes de super vaca";
					//}
					
					break;
	
				default:
					echo 'DAFUQ AR U DOIN =_=';
					$usuario = 'groar*';
					break;
			}
        }
		
		//Ya no se requiere mostrar el contenido del usuario, confio en que ya sirve :v
		//if(isset($usuario))
		//	include ('View/vista.php');

	}
	
	private function InsertarCliente()
	{
		if(isset($_REQUEST['nombre']) && isset($_REQUEST['apellidoPat']) && isset($_REQUEST['apellidoMat']) && isset($_REQUEST['RFC']))
		{
		   	$nombre = $_REQUEST['nombre'];
			$apellidoPat = $_REQUEST['apellidoPat'];
			$apellidoMat = $_REQUEST['apellidoMat'];
			$RFC = $_REQUEST['RFC'];
			$esPersonaFisica = $_REQUEST['esPersonaFisica'];
			
			if(isset($_REQUEST['esPersonaFisica']))
			{
				$esPersonaFisica = TRUE;
			}
			else
			{
				$esPersonaFisica = FALSE;
			}
				
			$this->modelo = new Cliente($nombre, $apellidoPat, $apellidoMat, $RFC, $esPersonaFisica);
			$usuario = $this->modelo;
			if(!$usuario->insertar())
			{
				die('ERRORES CREANDO AL CLIENTE');
			}
			
			$usuario->crearCliente($usuario->getIdEntidad());
			
			if(isset($_REQUEST['telefono']))
			{
				$telefono = new Telefono($usuario->getIdEntidad(), $_REQUEST['telefono']);
				
				if($telefono->insertar())
				{
					$usuario->agregarTelefono($telefono);
				}
			}
	
			if(isset($_REQUEST['email']))
			{
				$email = new Email($usuario->getIdEntidad(), $_REQUEST['email']);
				
				if($email->insertar())
				{
					$usuario->agregarEmail($email);
				}
			}
			
			if(isset($_REQUEST['direccion']))
			{
				$this->InsertarDireccion($usuario);
			}
			
			if(isset($_REQUEST['cuentaBancaria']))
			{
				$this->InsertarCuentaBancaria($usuario);
			}
			
			$this->modelo = $usuario;
			
			return $usuario;
		}
		else
		{
			return null;		
		}
	
			
				
	}

	private function InsertarDireccion($usuario)
	{
		//direccion es un arreglo
		$tmp = $_REQUEST['direccion'];
			
			
		$calle 			= $tmp['calle'];
		$numInterior 	= $tmp['numInterior'];
		$numExterior 	= $tmp['numExterior'];
		$colonia 		= $tmp['colonia'];
		$codigoPostal 	= $tmp['cp'];
		$estado 		= $tmp['estado'];
		$municipio 		= $tmp['municipio'];
		
		$direccion = new Direccion($usuario->getIdEntidad(), $calle, $numInterior, $numExterior, $colonia, $codigoPostal, $estado, $municipio);
		
		if($direccion->insertar())
		{
			$usuario->agregarDomicilio($direccion);
		}
	} 

	private function InsertarCuentaBancaria($usuario)
	{
		//cuentaBancaria es un arreglo
		$tmp = $_REQUEST['cuentaBancaria'];
			
		$nombreBanco 	= $tmp['nombreBanco'];
		$numeroCuenta 	= $tmp['numeroCuenta'];
		
		$cuenta = new CuentaBanco($usuario->getIdEntidad(), $nombreBanco, $numeroCuenta);
		
		if($cuenta->insertar())
		{
			$usuario->agregarCuentaBancaria($cuenta);
		}
	} 
	
	private function enviarEmail()
	{
		//require('Utils/phpmailer/class.phpmailer.php');
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$nombre = $this->modelo->getName()." ";
		$nombre .= $this->modelo->getApellidoPaterno()." ";
		$nombre .= $this->modelo->getApellidoMaterno();
		$telefono = $this->modelo->getTelefono()->getNumero();
		$direccion = $this->modelo->getDomicilio()->getCalle(). " #";
		$direccion .= $this->modelo->getDomicilio()->getNumInterior();
		$direccion .= $this->modelo->getDomicilio()->getNumExterior();
		$cp = $this->modelo->getDomicilio()->getCodigoPostal();
		
		$para = $_REQUEST['email'];
		$asunto = 'Bienvenido al Gestor de Gastos personal';
		$mensaje = "
					<html>
					<head></head>
					<body>
					
					<h1 style=\"color: red\">ola k ase, kalifikandonoz o k ase</h1>
					<h3 style=\"color: blue\">Bienvenido</h3>
					Se te da acceso a la pagina de <a href=\"http://alanturing.cucei.udg.mx/cc409/gastosse/index.php\"> Control de Gastos </a> <br> <br>
					
					<strong>username: </strong> $username <br>
					<strong>password: </strong>$password <br>
					
					<strong>Nombre:</strong>\t $nombre <br>
					<strong>Telefono:</strong>\t $telefono <br>
					<strong>Direccion:</strong>\t $direccion <br>
					<strong>Codigo Postal:</strong>\t $cp <br>
					</body>
					</html>	
					";
		$headers  = 'From: administracion@gastos.com'."\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		if ( mail($para,$asunto,$mensaje,$headers) )
		{
			//echo 'Se mando el correo';
		}
		else {
			//echo 'Hubo algun error al enviar el correo';
		}
	}

	private function modificarCliente(){
		
		if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
			$cuenta = new Cuentas();
			$cuenta->recuperar($_POST['seleccionado']);
			
			$cuenta->modificar('nombre_usuario', $_POST['username']);
			$cuenta->modificar('clave_acceso', $_POST['password']);
			$tmp = $_POST['direccion'];
			
			$this->modelo->modificar('nombre',$_POST['nombre']);
			$this->modelo->modificar('apellido_paterno',$_POST['apellidoPat']);
			$this->modelo->modificar('apellido_materno',$_POST['apellidoMat']);
			$this->modelo->modificar('RFC',$_POST['RFC']);
			$this->modelo->getTelefono()->modificar('telefono',$_POST['telefono']);
			$this->modelo->getDomicilio()->modificar('calle',$tmp['calle']);
			$this->modelo->getDomicilio()->modificar('num_interior',$tmp['numInterior']);
			$this->modelo->getDomicilio()->modificar('num_exterior',$tmp['numExterior']);
			$this->modelo->getDomicilio()->modificar('colonia',$tmp['colonia']);
			$this->modelo->getDomicilio()->modificar('codigo_postal',$tmp['cp']);
			$this->modelo->getDomicilio()->modificar('stado',$tmp['estado']);
			$this->modelo->getDomicilio()->modificar('municipio',$tmp['municipio']);
		}
	}
}

?>
