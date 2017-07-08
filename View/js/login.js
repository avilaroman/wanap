function admin(){
	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetAdmin.php',true);
	else
		ajax.open('GET','../Codigo/Utils/GetAdmin.php',true);

	console.log(ajax.readyState);

	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4){
			var dropMod = document.getElementById('dropMod');
			var dropExp = document.getElementById('dropExp');
			var dropAct = document.getElementById('dropAct');
			var response = eval(ajax.responseText);

			if(dropMod!=null)
			var parent = dropMod.parentNode;

			if(response[0].admin == '0'){
				parent.removeChild(dropMod);
				parent.removeChild(dropExp);
				parent.removeChild(dropAct);
			}
		}
	}

	ajax.send(null);

}


function llenarEstados(){
	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetEstados.php',true);
	else
		ajax.open('GET','../Codigo/Utils/GetEstados.php',true);
	
	console.log(ajax.readyState);
	
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4)
		{
			var estados = document.getElementById('selectEstados');
			var response = eval(ajax.responseText);

			estados.options.length = 0;
			
			var defauult = document.createElement('option');
			var texto = document.createTextNode('Selecciona un estado...');
			defauult.appendChild(texto);
			defauult.setAttribute('value', -1);
			estados.appendChild(defauult);

			var defauult2 = defauult.cloneNode(true);
			var estados2 = document.getElementById('selectEstados2');
			estados2.appendChild(defauult2);
			
			for (estado in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[estado].estado);
				option.appendChild(text);
				option.setAttribute('value',response[estado].id_estado);
				estados.appendChild(option);

				var option2 = option.cloneNode(true);
    			estados2.appendChild(option2);

			}
		}
	}
	
	ajax.send(null);
}

function obtenerMunicipios(select)
{
	var seleccion = select.selectedIndex;
	var municipios = document.getElementById('selectMunicipios');
    municipios.options.length = 0;
    
    var defauult = document.createElement('option');
	var texto = document.createTextNode('Selecciona un municipio...');
	defauult.appendChild(texto);
	defauult.setAttribute('value', -1);
	municipios.appendChild(defauult);

	var defauult2 = defauult.cloneNode(true);
	var municipios2 = document.getElementById('selectMunicipios2');	
	municipios2.appendChild(defauult2);
	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname.split('/');
		if(url[3] == 'View')
			ajax.open('GET','../Utils/GetMunicipios.php?idEstado='+seleccion,true);
		else
			ajax.open('GET','../Codigo/Utils/GetMunicipios.php?idEstado='+seleccion,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				
				for (municipio in response){
					var option = document.createElement('option');
					var text = document.createTextNode(response[municipio].nombre_municipio);
					option.appendChild(text);
					option.setAttribute('value',response[municipio].id_municipio);
					var option2 = option.cloneNode(true);
					municipios.appendChild(option);
					municipios2.appendChild(option2);
				}
			}
		}
		
		ajax.send(null);
	}
}
/*
function llenarEstadosAlta(){
	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetEstados.php',true);
	else
		ajax.open('GET','../Codigo/Utils/GetEstados.php',true);
	
	
	
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4)
		{
			var estados = document.getElementById('selectEstados2');
			var response = eval(ajax.responseText);
			
			var defauult = document.createElement('option');
			var texto = document.createTextNode('Selecciona un estado...');
			defauult.appendChild(texto);
			defauult.setAttribute('value', -1);
			
			estados.appendChild(defauult);
			
			for (estado in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[estado].estado);
				option.appendChild(text);
				option.setAttribute('value',response[estado].id_estado);
				
				estados.appendChild(option);
			}
		}
	}
	
	ajax.send(null);
}

function obtenerMunicipiosAlta(select)
{
	var seleccion = select.selectedIndex;
	
	var municipios = document.getElementById('selectMunicipios2');
    municipios.options.length = 0;
    
    var defauult = document.createElement('option');
	var texto = document.createTextNode('Selecciona un municipio...');
	defauult.appendChild(texto);
	defauult.setAttribute('value', -1);
				
	municipios.appendChild(defauult);

	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname.split('/');
		if(url[3] == 'View')
			ajax.open('GET','../Utils/GetMunicipios.php?idEstado='+seleccion,true);
		else
			ajax.open('GET','../Codigo/Utils/GetMunicipios.php?idEstado='+seleccion,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				
				for (municipio in response){
					var option = document.createElement('option');
					var text = document.createTextNode(response[municipio].nombre_municipio);
					option.appendChild(text);
					option.setAttribute('value',response[municipio].id_municipio);
					
					municipios.appendChild(option);
				}
			}
		}
		
		ajax.send(null);
	}
}
*/
function clientes(){
	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetInfoCliente.php',true);
	else
		ajax.open('GET','../Codigo/Utils/GetInfoCliente.php',true);

	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4){
			var clientes = document.getElementById('selectClientes');
			var clientesCon = document.getElementById('selectClientesCon');
			var clientesModCon = document.getElementById('selectClientesModCon');
			var clientesEnt = document.getElementById('selectClientesEnt');
			var clientesEntModCon = document.getElementById('selectClientesEntModCon');
			var clientesPago = document.getElementById('selectClientesPago');
			var clientesGasto = document.getElementById('selectClientesGasto');
			var clientesExp = document.getElementById('selectClientesExp');
			var clientesExpCon = document.getElementById('selectClientesExpCon');

			var response = eval(ajax.responseText);

			/*clientes.options.length = 0;
			clientesCon.options.length = 0;
			clientesModCon.options.length = 0;
			clientesEnt.options.length = 0;
			clientesEntModCon.options.length = 0;
			clientesPago.options.length = 0;
			clientesGasto.options.length = 0;
			clientesExp.options.length = 0;
			clientesExpCon.options.length = 0;*/

			var elemento = document.createElement('option');
			var texto = document.createTextNode('selecciona Cliente...');
			elemento.appendChild(texto);
			elemento.setAttribute('value', -1);
			clientes.appendChild(elemento);

			var elementoCon = elemento.cloneNode(true);
			clientesCon.appendChild(elementoCon);
			var elementoEnt = elementoCon.cloneNode(true);
			clientesEnt.appendChild(elementoEnt);
			var elementoModCon = elementoEnt.cloneNode(true);
			clientesModCon.appendChild(elementoModCon);
			var elementoEntModCon = elementoModCon.cloneNode(true);
			clientesEntModCon.appendChild(elementoEntModCon);
			var elementoPago = elementoEntModCon.cloneNode(true);
			clientesPago.appendChild(elementoPago);
			var elementoGasto = elementoPago.cloneNode(true);
			clientesGasto.appendChild(elementoGasto);
			
			if(clientesExp!=null){
			var elementoExp = elementoGasto.cloneNode(true);
			clientesExp.appendChild(elementoExp);
			}

			if(clientesExpCon!=null){
			var elementoExpCon = elementoGasto.cloneNode(true);
			clientesExpCon.appendChild(elementoExpCon);
			}

			for(cliente in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[cliente].id_cliente);
				option.appendChild(text);
				option.setAttribute('value', response[cliente].id_cliente);
				clientes.appendChild(option);

				var optionCon = option.cloneNode(true);
				clientesCon.appendChild(optionCon);
				var optionEnt = optionCon.cloneNode(true);
				clientesEnt.appendChild(optionEnt);
				var optionModCon = optionEnt.cloneNode(true);
				clientesModCon.appendChild(optionModCon);
				var optionEntModCon = optionModCon.cloneNode(true);
				clientesEntModCon.appendChild(optionEntModCon);
				var optionPago = optionEntModCon.cloneNode(true);
				clientesPago.appendChild(optionPago);
				var optionGasto = optionPago.cloneNode(true);
				clientesGasto.appendChild(optionGasto);

				if(clientesExp){
				var optionExp = optionGasto.cloneNode(true); //response cliente
				clientesExp.appendChild(optionExp);
				}

				if(clientesExpCon){
				var optionExpCon = optionGasto.cloneNode(true); //response cliente
				clientesExpCon.appendChild(optionExpCon);
				}
			}

		}
	}

	ajax.send(null);
}

function obtenerDatos(select)
{
	var seleccion = select.selectedIndex;
	var valor = select.value;
	console.log(valor);
	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname.split('/');
		if(url[3] == 'View')
			ajax.open('GET','../Utils/GetInfoEntidad.php?idCliente='+valor,true);
		else
			ajax.open('GET','../Codigo/Utils/GetInfoEntidad.php?idCliente='+valor,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				var form = document.getElementById('datosClientes');
				var nombreC = document.getElementById('nombreDatos');
				var apMatC = document.getElementById('apMatDatos');
				var apPatC = document.getElementById('apPatDatos');
				var rfcC = document.getElementById('rfcDatos');
				var tdC = document.getElementById('tableD');
				var tdT = document.getElementById('tableT');

				if(nombreC != null)
					var namae = tdC.parentNode;
					//var namae2 = namae.parentNode;
				if(nombreC && nombreC!=null){
					/*namae.removeChild(nombreC);
					namae.removeChild(apMatC);
					namae.removeChild(apPatC);
					namae.removeChild(rfcC);*/
					namae.removeChild(tdC);
					namae.removeChild(tdT);
				}

				var td = document.createElement('td');
				td.setAttribute('id','tableD');
				var tdTitulos = document.createElement('td');
				tdTitulos.setAttribute('id','tableT');
				tdTitulos.setAttribute('width','30%');

				var numExtHead = document.createElement('div');
				var numExtTitulo = document.createTextNode('Numero exterior:');
				numExtHead.appendChild(numExtTitulo);

    			var numExt = document.createElement('div');
    			var numExtText = document.createTextNode(response[0].numExt);
    			numExt.appendChild(numExtText);
    			numExt.setAttribute('id','numext');
    			$(numExt).insertAfter($('#datosTitulo'));

				var numIntHead = document.createElement('div');
				var numIntTitulo = document.createTextNode('Numero interior:');
				numIntHead.appendChild(numIntTitulo);

    			var numInt = document.createElement('div');
    			var numIntText = document.createTextNode(response[0].numInt);
    			numInt.appendChild(numIntText);
    			numInt.setAttribute('id','numint');
    			$(numInt).insertAfter($('#datosTitulo'));

				var calleHead = document.createElement('div');
				var calleTitulo = document.createTextNode('Calle:');
				calleHead.appendChild(calleTitulo);

    			var calle = document.createElement('div');
    			var calleText = document.createTextNode(response[0].calle);
    			calle.appendChild(calleText);
    			calle.setAttribute('id','calle');
    			$(calle).insertAfter($('#datosTitulo'));

				var emailHead = document.createElement('div');
				var emailTitulo = document.createTextNode('Email:');
				emailHead.appendChild(emailTitulo);

    			var email = document.createElement('div');
    			var emailText = document.createTextNode(response[0].email);
    			email.appendChild(emailText);
    			email.setAttribute('id','email');
    			$(email).insertAfter($('#datosTitulo'));

				var telHead = document.createElement('div');
				var telTitulo = document.createTextNode('Telefono:');
				telHead.appendChild(telTitulo);

    			var tel = document.createElement('div');
    			var telText = document.createTextNode(response[0].telefono);
    			tel.appendChild(telText);
    			tel.setAttribute('id','tel');
    			$(tel).insertAfter($('#datosTitulo'));

				var rfcHead = document.createElement('div');
				var rfcTitulo = document.createTextNode('RFC:');
				rfcHead.appendChild(rfcTitulo);

    			var rfc = document.createElement('div');
    			var rfcText = document.createTextNode(response[0].rfc);
    			rfc.appendChild(rfcText);
    			rfc.setAttribute('id','rfcDatos');
    			//rfc.setAttribute('class','span8');
    			$(rfc).insertAfter($('#datosTitulo'));

    			var apMatHead = document.createElement('div');
				var apMatTitulo = document.createTextNode('Apellido Materno:');
				apMatHead.appendChild(apMatTitulo);

				var apMat = document.createElement('div');
    			var lastM = document.createTextNode(response[0].apellidoM);
    			apMat.appendChild(lastM);
    			apMat.setAttribute('id','apMatDatos');
    			//apMat.setAttribute('class','span8');
    			$(apMat).insertAfter($('#datosTitulo'));

    			var apPatHead = document.createElement('div');
				var apPatTitulo = document.createTextNode('Apellido Paterno:');
				apPatHead.appendChild(apPatTitulo);

    			var apPat = document.createElement('div');
    			var lastP = document.createTextNode(response[0].apellidoP);
    			apPat.appendChild(lastP);
    			apPat.setAttribute('id','apPatDatos');
    			//apPat.setAttribute('class','span8');
    			$(apPat).insertAfter($('#datosTitulo'));

    			var nombreHead = document.createElement('div');
				var nombreTitulo = document.createTextNode('Nombre:');
				nombreHead.appendChild(nombreTitulo);

    			var nombre = document.createElement('div');
    			var name = document.createTextNode(response[0].nombre);
    			console.log(name);
    			nombre.appendChild(name);
    			nombre.setAttribute('id','nombreDatos');
    			//mbre.setAttribute('class','span8');
    			$(nombre).insertAfter($('#datosTitulo'));
    			td.appendChild(nombre);
    			td.appendChild(apMat);
    			td.appendChild(apPat);
    			td.appendChild(rfc);
    			td.appendChild(tel);
    			td.appendChild(email);
    			td.appendChild(calle);
    			td.appendChild(numInt);
    			td.appendChild(numExt);
    			//tr.appendChild(td);

    			tdTitulos.appendChild(nombreHead);
    			tdTitulos.appendChild(apPatHead);
    			tdTitulos.appendChild(apMatHead);
    			tdTitulos.appendChild(rfcHead);
    			tdTitulos.appendChild(telHead);
    			tdTitulos.appendChild(emailHead);
    			tdTitulos.appendChild(calleHead);
    			tdTitulos.appendChild(numIntHead);
    			tdTitulos.appendChild(numExtHead);
    			
    			$(td).insertAfter($('#datosTitulo'));
    			$(tdTitulos).insertAfter($('#datosTitulo'));

			}
		}
		
		ajax.send(null);
	}
}

function obtenerDatosExp(select)
{
	var seleccion = select.selectedIndex;
	var valor = select.value;
	console.log(valor);
	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname.split('/');
		if(url[3] == 'View')
			ajax.open('GET','../Utils/GetInfoContrato.php?idCliente='+valor,true);
		else
			ajax.open('GET','../Codigo/Utils/GetInfoContrato.php?idCliente='+valor,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				var form = document.getElementById('datosClientes');
				var idElem = document.getElementById('idCon');
				var apMatC = document.getElementById('apMatDatos');
				var apPatC = document.getElementById('apPatDatos');
				var rfcC = document.getElementById('rfcDatos');
				var tdC = document.getElementById('tableD');
				var tdT = document.getElementById('tableT');
				var divnulo = document.getElementById('nulo');

				if(idElem != null || divnulo != null)
					var namae = tdC.parentNode;
					//var namae2 = namae.parentNode;
				if((idElem && idElem!=null)||(divnulo && divnulo!=null)){
					/*namae.removeChild(nombreC);
					namae.removeChild(apMatC);
					namae.removeChild(apPatC);
					namae.removeChild(rfcC);*/
					namae.removeChild(tdC);
					namae.removeChild(tdT);
				}

				var td = document.createElement('td');
				td.setAttribute('id','tableD');
				var tdTitulos = document.createElement('td');
				tdTitulos.setAttribute('id','tableT');
				tdTitulos.setAttribute('width','30%');

				if(response==null){
					var nulo = document.createElement('div');
					var nuloTitulo = document.createTextNode('Cliente seleccionado no tiene contrato');
					nulo.appendChild(nuloTitulo);
					nulo.setAttribute('id','nulo');
					td.appendChild(nulo);
					$(tdTitulos).insertAfter($('#datosTitulo'));
					$(td).insertAfter($('#datosTitulo'));
				}else{

				var saldadoHead = document.createElement('div');
				var saldadoTitulo = document.createTextNode('Saldado:');
				saldadoHead.appendChild(saldadoTitulo);

    			var saldado = document.createElement('div');
    			var saldadoText = document.createTextNode(response[0].saldado_);
    			saldado.appendChild(saldadoText);
    			saldado.setAttribute('id','saldado');
    			$(saldado).insertAfter($('#datosTitulo'));

				var renovacionHead = document.createElement('div');
				var renovacionTitulo = document.createTextNode('Renovacion:');
				renovacionHead.appendChild(renovacionTitulo);

    			var renovacion = document.createElement('div');
    			var renovacionText = document.createTextNode(response[0].renovacion_);
    			renovacion.appendChild(renovacionText);
    			renovacion.setAttribute('id','renovacion');
    			$(renovacion).insertAfter($('#datosTitulo'));

				var plazosHead = document.createElement('div');
				var plazosTitulo = document.createTextNode('Plazos:');
				plazosHead.appendChild(plazosTitulo);

    			var plazos = document.createElement('div');
    			var plazosText = document.createTextNode(response[0].plazos_);
    			plazos.appendChild(plazosText);
    			plazos.setAttribute('id','plazos');
    			$(plazos).insertAfter($('#datosTitulo'));

				var presHead = document.createElement('div');
				var presTitulo = document.createTextNode('Presupuesto:');
				presHead.appendChild(presTitulo);

    			var pres = document.createElement('div');
    			var presText = document.createTextNode(response[0].presupuesto_);
    			pres.appendChild(presText);
    			pres.setAttribute('id','pres');
    			$(pres).insertAfter($('#datosTitulo'));

				var periodoHead = document.createElement('div');
				var periodoTitulo = document.createTextNode('Periodo:');
				periodoHead.appendChild(periodoTitulo);

    			var periodo = document.createElement('div');
    			var periodoText = document.createTextNode(response[0].periodo_);
    			periodo.appendChild(periodoText);
    			periodo.setAttribute('id','periodo');
    			$(periodo).insertAfter($('#datosTitulo'));

				var fechaHead = document.createElement('div');
				var fechaTitulo = document.createTextNode('Fecha::');
				fechaHead.appendChild(fechaTitulo);

    			var fecha = document.createElement('div');
    			var fechaText = document.createTextNode(response[0].fecha_);
    			fecha.appendChild(fechaText);
    			fecha.setAttribute('id','fecha');
    			//rfc.setAttribute('class','span8');
    			$(fecha).insertAfter($('#datosTitulo'));

    			var idEntHead = document.createElement('div');
				var idEntTitulo = document.createTextNode('Id Contacto:');
				idEntHead.appendChild(idEntTitulo);

				var idEnt = document.createElement('div');
    			var idEntText = document.createTextNode(response[0].idEnt_);
    			idEnt.appendChild(idEntText);
    			idEnt.setAttribute('id','idEnt');
    			//apMat.setAttribute('class','span8');
    			$(idEnt).insertAfter($('#datosTitulo'));

    			var idCuenHead = document.createElement('div');
				var idCuenTitulo = document.createTextNode('Id Cuenta:');
				idCuenHead.appendChild(idCuenTitulo);

    			var idCuen = document.createElement('div');
    			var idCuenText= document.createTextNode(response[0].idCuenta_);
    			idCuen.appendChild(idCuenText);
    			idCuen.setAttribute('id','idCuen');
    			//apPat.setAttribute('class','span8');
    			$(idCuen).insertAfter($('#datosTitulo'));

    			var idHead = document.createElement('div');
				var idTitulo = document.createTextNode('Id:');
				idHead.appendChild(idTitulo);

    			var id = document.createElement('div');
    			var idText= document.createTextNode(response[0].id_);
    			id.appendChild(idText);
    			id.setAttribute('id','idCon');
    			//mbre.setAttribute('class','span8');
    			$(id).insertAfter($('#datosTitulo'));

    			td.appendChild(id);
    			td.appendChild(idCuen);
    			td.appendChild(idEnt);
    			td.appendChild(fecha);
    			td.appendChild(periodo);
    			td.appendChild(pres);
    			td.appendChild(plazos);
    			td.appendChild(renovacion);
    			td.appendChild(saldado);
    			//tr.appendChild(td);

    			tdTitulos.appendChild(idHead);
    			tdTitulos.appendChild(idCuenHead);
    			tdTitulos.appendChild(idEntHead);
    			tdTitulos.appendChild(fechaHead);
    			tdTitulos.appendChild(periodoHead);
    			tdTitulos.appendChild(presHead);
    			tdTitulos.appendChild(plazosHead);
    			tdTitulos.appendChild(renovacionHead);
    			tdTitulos.appendChild(saldadoHead);
    			
    			$(td).insertAfter($('#datosTitulo'));
    			$(tdTitulos).insertAfter($('#datosTitulo'));
    			}

			}
		}
		
		ajax.send(null);
	}
}



	function home(){
		var protocol = window.location.protocol;
		var host = window.location.host;
		var path = 'ControlGastos/Codigo/Menu.php';

		//alert(protocol);

		//if(protocol!="")
			var newURL = "/" + path;
		/*else
			var newURL = "/" + path;*/

		window.location.replace(newURL);
	}

function obtenerDatosMod(select)
{
	var seleccion = select.selectedIndex;
	var valor = select.value;
	console.log(valor);
	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname.split('/');
		if(url[3] == 'View')
			ajax.open('GET','../Utils/GetInfoEntidad.php?idCliente='+valor,true);
		else
			ajax.open('GET','../Codigo/Utils/GetInfoEntidad.php?idCliente='+valor,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				var form = document.getElementById('formularioMod');
				var usuario = document.getElementById('username');
				var pass = document.getElementById('passReg');
				var email = document.getElementById('email');
				var nombre = document.getElementById('nombre');
				var apPat = document.getElementById('apellidoP');
				var apMat = document.getElementById('apellidoM');
				var rfc = document.getElementById('rfc');
				var tel = document.getElementById('tel');
				var persona = document.getElementById('persona');
				var calle = document.getElementById('calle');
				var numInt = document.getElementById('numint');
				var numExt = document.getElementById('numext');
				var colonia = document.getElementById('col');
				var cp = document.getElementById('cp');
				var estado = document.getElementById('selectEstados');
				var municipio = document.getElementById('selectMunicipios');
				var evt = document.createEvent("HTMLEvents");
				evt.initEvent("change",true,true);
				
				$(usuario).val(response[0].usuario);
				$(pass).val(response[0].password);
				$(nombre).val(response[0].nombre);
				$(apPat).val(response[0].apellidoP);
				$(apMat).val(response[0].apellidoM);
				$(rfc).val(response[0].rfc);
				$(tel).val(response[0].telefono);
				$(persona).val(response[0].personaFisica);
				$(email).val(response[0].email);
				$(calle).val(response[0].calle);
				$(numInt).val(response[0].numInt);
				$(numExt).val(response[0].numExt);
				$(colonia).val(response[0].colonia);
				$(cp).val(response[0].cp);
				$(estado).val(response[0].estado);
				estado.dispatchEvent(evt);

				switch(response[0].estado){
					case 2:
						$(municipio).val(response[0].municipio - 11);
						break;
					case 3:
						$(municipio).val(response[0].municipio - 16);
						break;
					case 4:
						$(municipio).val(response[0].municipio - 21);
						break;
					case 5:
						$(municipio).val(response[0].municipio - 32);
						break;
					case 6:
						$(municipio).val(response[0].municipio - 154);
						break;
					case 7:
						$(municipio).val(response[0].municipio - 221);
						break;
					case 8:
						$(municipio).val(response[0].municipio - 259);
						break;
					case 9:
						$(municipio).val(response[0].municipio - 269);
						break;
					case 10:
						$(municipio).val(response[0].municipio - 309);
						break;
					case 11:
						$(municipio).val(response[0].municipio - 355);
						break;
					case 12:
						$(municipio).val(response[0].municipio - 436);
						break;
					case 13:
						$(municipio).val(response[0].municipio - 520);
						break;
					case 14:
						$(municipio).val(response[0].municipio - 645);
						break;
					case '15':
						$(municipio).val(response[0].municipio - 645);
						console.log(response[0].municipio - 645);
						break;
					case 16:
						$(municipio).val(response[0].municipio - 883);
						break;
					case 17:
						$(municipio).val(response[0].municipio - 916);
						break;
					case 18:
						$(municipio).val(response[0].municipio - 936);
						break;
					case 19:
						$(municipio).val(response[0].municipio - 987);
						break;
					case 20:
						$(municipio).val(response[0].municipio - 1557);
						break;
					case 21:
						$(municipio).val(response[0].municipio - 1774);
						break;
					case 22:
						$(municipio).val(response[0].municipio - 1792);
						break;
					case 23:
						$(municipio).val(response[0].municipio - 1802);
						break;
					case 24:
						$(municipio).val(response[0].municipio - 1860);
						break;
					case 25:
						$(municipio).val(response[0].municipio - 1878);
						break;
					case 26:
						$(municipio).val(response[0].municipio - 1950);
						break;
					case 27:
						$(municipio).val(response[0].municipio - 1967);
						break;
					case 28:
						$(municipio).val(response[0].municipio - 2010);
						break;
					case 29:
						$(municipio).val(response[0].municipio - 2070);
						break;
					case 30:
						$(municipio).val(response[0].municipio - 2282);
						break;
					case 31:
						$(municipio).val(response[0].municipio - 2388);
						break;
					default:
						console.log('ola k mira');
						break;
				}
				console.log(municipio);


				

			}
		}
		
		ajax.send(null);
	}
	else{
				var form = document.getElementById('formularioMod');
				var usuario = document.getElementById('username');
				var pass = document.getElementById('passReg');
				var email = document.getElementById('email');
				var nombre = document.getElementById('nombre');
				var apPat = document.getElementById('apellidoP');
				var apMat = document.getElementById('apellidoM');
				var rfc = document.getElementById('rfc');
				var tel = document.getElementById('tel');
				var persona = document.getElementById('persona');
				var calle = document.getElementById('calle');
				var numInt = document.getElementById('numint');
				var numExt = document.getElementById('numext');
				var colonia = document.getElementById('col');
				var cp = document.getElementById('cp');
				var estado = document.getElementById('selectEstados');
				var municipio = document.getElementById('selectMunicipios');
				//var evt = document.createEvent("HTMLEvents");
				//evt.initEvent("change",true,true);
				
				$(usuario).val("");
				$(pass).val("");
				$(nombre).val("");
				$(apPat).val("");
				$(apMat).val("");
				$(rfc).val("");
				$(tel).val("");
				$(persona).val("");
				$(email).val("");
				$(calle).val("");
				$(numInt).val("");
				$(numExt).val("");
				$(colonia).val("");
				$(cp).val("");
				$(estado).val("");
	}
}

function Contratos(select){
	var seleccion = select.selectedIndex;
	var valor = select.value;

	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetInfoContrato.php?idCliente='+valor,true);
	else
		ajax.open('GET','../Codigo/Utils/GetInfoContrato.php?idCliente='+valor,true);
	
	
	
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4)
		{
			var contratos = document.getElementById('selectContratos');
			var contratosGastos = document.getElementById('selectContratosGasto');
			var response = eval(ajax.responseText);
			
			contratos.options.length=0;
			contratosGastos.options.length=0;

			var defauult = document.createElement('option');
			var texto = document.createTextNode('Selecciona un contrato...');
			defauult.appendChild(texto);
			defauult.setAttribute('value', -1);
			defauult.setAttribute('id', 'defaultoption');

			if(!document.getElementById('defaultoption'))
				contratos.appendChild(defauult);

			var elementoGastos = defauult.cloneNode(true);
			contratosGastos.appendChild(elementoGastos);

			for (cont in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[cont].id_);
				option.appendChild(text);
				option.setAttribute('value',response[cont].id_);
				contratos.appendChild(option);

				var optionGastos = option.cloneNode(true);
				contratosGastos.appendChild(optionGastos);
			}
		}
	}
	
	ajax.send(null);
}

function ContratosId(valor){

	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetInfoContrato.php?idCliente='+valor,true);
	else
		ajax.open('GET','../Codigo/Utils/GetInfoContrato.php?idCliente='+valor,true);
	
	
	
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4)
		{
			var contratos = document.getElementById('selectContratos');
			var contratosGastos = document.getElementById('selectContratosGasto');
			var response = eval(ajax.responseText);
			
			contratos.options.length=0;
			contratosGastos.options.length=0;

			var defauult = document.createElement('option');
			var texto = document.createTextNode('Selecciona un contrato...');
			defauult.appendChild(texto);
			defauult.setAttribute('value', -1);
			defauult.setAttribute('id', 'defaultoption');

			if(!document.getElementById('defaultoption'))
				contratos.appendChild(defauult);

			var elementoGastos = defauult.cloneNode(true);
			contratosGastos.appendChild(elementoGastos);

			for (cont in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[cont].id_);
				option.appendChild(text);
				option.setAttribute('value',response[cont].id_);
				contratos.appendChild(option);

				var optionGastos = option.cloneNode(true);
				contratosGastos.appendChild(optionGastos);
			}
		}
	}
	
	ajax.send(null);
}

function obtenerDatosCon(select)
{
	var seleccion = select.selectedIndex;
	var valor = select.value;
	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname.split('/');
		if(url[3] == 'View')
			ajax.open('GET','../Utils/GetInfoContrato.php?id_contrato='+valor,true);
		else
			ajax.open('GET','../Codigo/Utils/GetInfoContrato.php?id_contrato='+valor,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				var form = document.getElementById('formularioMod');
				var usuario = document.getElementById('username');
				var pass = document.getElementById('passReg');
				var email = document.getElementById('email');
				var nombre = document.getElementById('nombre');
				var apPat = document.getElementById('apellidoP');
				var apMat = document.getElementById('apellidoM');
				var rfc = document.getElementById('rfc');
				var tel = document.getElementById('tel');
				var persona = document.getElementById('persona');
				var calle = document.getElementById('calle');
				var numInt = document.getElementById('numint');
				var numExt = document.getElementById('numext');
				var colonia = document.getElementById('col');
				var cp = document.getElementById('cp');
				var estado = document.getElementById('selectEstados');
				var municipio = document.getElementById('selectMunicipios');
				var evt = document.createEvent("HTMLEvents");
				evt.initEvent("change",true,true);
				
				$(usuario).val(response[0].usuario);
				$(pass).val(response[0].password);
				$(nombre).val(response[0].nombre);
				$(apPat).val(response[0].apellidoP);
				$(apMat).val(response[0].apellidoM);
				$(rfc).val(response[0].rfc);
				$(tel).val(response[0].telefono);
				$(persona).val(response[0].personaFisica);
				$(email).val(response[0].email);
				$(calle).val(response[0].calle);
				$(numInt).val(response[0].numInt);
				$(numExt).val(response[0].numExt);
				$(colonia).val(response[0].colonia);
				$(cp).val(response[0].cp);
				$(estado).val(response[0].estado);
				estado.dispatchEvent(evt);

				switch(response[0].estado){
					case 2:
						$(municipio).val(response[0].municipio - 11);
						break;
					case 3:
						$(municipio).val(response[0].municipio - 16);
						break;
					case 4:
						$(municipio).val(response[0].municipio - 21);
						break;
					case 5:
						$(municipio).val(response[0].municipio - 32);
						break;
					case 6:
						$(municipio).val(response[0].municipio - 154);
						break;
					case 7:
						$(municipio).val(response[0].municipio - 221);
						break;
					case 8:
						$(municipio).val(response[0].municipio - 259);
						break;
					case 9:
						$(municipio).val(response[0].municipio - 269);
						break;
					case 10:
						$(municipio).val(response[0].municipio - 309);
						break;
					case 11:
						$(municipio).val(response[0].municipio - 355);
						break;
					case 12:
						$(municipio).val(response[0].municipio - 436);
						break;
					case 13:
						$(municipio).val(response[0].municipio - 520);
						break;
					case 14:
						$(municipio).val(response[0].municipio - 645);
						break;
					case '15':
						$(municipio).val(response[0].municipio - 645);
						console.log(response[0].municipio - 645);
						break;
					case 16:
						$(municipio).val(response[0].municipio - 883);
						break;
					case 17:
						$(municipio).val(response[0].municipio - 916);
						break;
					case 18:
						$(municipio).val(response[0].municipio - 936);
						break;
					case 19:
						$(municipio).val(response[0].municipio - 987);
						break;
					case 20:
						$(municipio).val(response[0].municipio - 1557);
						break;
					case 21:
						$(municipio).val(response[0].municipio - 1774);
						break;
					case 22:
						$(municipio).val(response[0].municipio - 1792);
						break;
					case 23:
						$(municipio).val(response[0].municipio - 1802);
						break;
					case 24:
						$(municipio).val(response[0].municipio - 1860);
						break;
					case 25:
						$(municipio).val(response[0].municipio - 1878);
						break;
					case 26:
						$(municipio).val(response[0].municipio - 1950);
						break;
					case 27:
						$(municipio).val(response[0].municipio - 1967);
						break;
					case 28:
						$(municipio).val(response[0].municipio - 2010);
						break;
					case 29:
						$(municipio).val(response[0].municipio - 2070);
						break;
					case 30:
						$(municipio).val(response[0].municipio - 2282);
						break;
					case 31:
						$(municipio).val(response[0].municipio - 2388);
						break;
					default:
						console.log('ola k mira');
						break;
				}
				console.log(municipio);


				

			}
		}
		
		ajax.send(null);
	}
}

/*function llenarClientesCon(){
	var ajax2 = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax2.open('GET','../Utils/GetListaCtl.php',true);
	else
		ajax2.open('GET','../Codigo/Utils/GetListaCtl.php',true);
	
	
	
	ajax2.onreadystatechange = function()
	{
		if(ajax2.readyState == 4)
		{
			var ctlCon = document.getElementById('selectClientesCon');
			var response2 = eval(ajax2.responseText);
			
			var defauult2 = document.createElement('option');
			var texto2 = document.createTextNode('Selecciona un cliente...');
			defauult2.appendChild(texto2);
			defauult2.setAttribute('value', -1);
			ctlCon.appendChild(defauult2);
			
			for (lista2 in response2){
				var option2 = document.createElement('option');
				var text2 = document.createTextNode(response2[lista2].cliente);
				option2.appendChild(text2);
				option2.setAttribute('value',response2[lista2].id_cliente);
				ctlCon.appendChild(option2);

			}
		}
	}
	
	ajax2.send(null);
}*/