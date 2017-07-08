<?php

include_once ('Controller/ClienteCtl.php');
include_once ('Controller/ContratoCtl.php');
include_once ('Controller/LoginCtl.php');

//include_once ('Utils/Logout.php');
if((!isset($_SESSION)))
{
	session_start();
}

        
    if(isset($_REQUEST['uso']))
    {
        switch ($_REQUEST['uso']) 
        {
            case 'cliente':
                $controlador = new ControladorCliente();
                require_once ('View/menu.html');  
                break;
            case 'contrato':
				include ('Utils/StatusSession.php');
                $controlador = new ControladorContrato();
                require_once ('View/menu.html');  
                break;
            case 'login':
                $controlador = new LoginCtl();
                require_once ('View/menu.html');  
                break;
            default:
				 include ('Utils/StatusSession.php');
				require_once ('View/menu.html');  
				break;
        }
        
        $controlador->ejecutar();
		
    }
    else
    {
    	if(isset($_SESSION['username']))
		{
			include ('Utils/StatusSession.php');
			require_once ('View/menu.html');
		}
		else {
		include ('View/login.html');
		}		
    }
 		

?>

