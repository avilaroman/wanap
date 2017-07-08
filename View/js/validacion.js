function validaLogin(){
	form = document.getElementById('well');
	var input_User = document.getElementById('user');
	var input_Pass = document.getElementById('pass');

	if(!/^\w+$/.test(input_User.value) && !/^{graph}+$/.test(input_Pass.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','user_error');
		var msg = document.createTextNode('Usuario o Contraseña Incorrecto');
		div.appendChild(msg);
//		form.insertBefore(div,input_User.nextSibling);
	}
	else{
		var dir_error = document.getElementById('user_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}
}

function validaForm(index){
	if(index==1){
	form = document.getElementById('formulario');
	var input_User = document.getElementById('username');
	var input_Pass = document.getElementById('passReg');
	var input_Email = document.getElementById('email');
	var input_Nombre = document.getElementById('nombre');
	var input_ApellidoP = document.getElementById('apellidoP');
	var input_ApellidoM = document.getElementById('apellidoM');
	var input_Rfc = document.getElementById('rfc');
	var input_Tel = document.getElementById('tel');
	var input_Calle = document.getElementById('calle');
	var input_NumInt = document.getElementById('numint');
	var input_NumExt = document.getElementById('numext');
	var input_Colonia = document.getElementById('col');
	var input_CP = document.getElementById('cp');
	var input_Estado = document.getElementById('selectEstados');
	var input_Municipio = document.getElementById('selectMunicipios');
	var flag = true;
	}
	else{
	form = document.getElementById('formularioAlta');
	var input_User = document.getElementById('username2');
	var input_Pass = document.getElementById('passReg2');
	var input_Email = document.getElementById('email2');
	var input_Nombre = document.getElementById('nombre2');
	var input_ApellidoP = document.getElementById('apellidoP');
	var input_ApellidoM = document.getElementById('apellidoM');
	var input_Rfc = document.getElementById('rfc');
	var input_Tel = document.getElementById('tel');
	var input_Calle = document.getElementById('calle');
	var input_NumInt = document.getElementById('numint');
	var input_NumExt = document.getElementById('numext');
	var input_Colonia = document.getElementById('col');
	var input_CP = document.getElementById('cp');
	var input_Estado = document.getElementById('selectEstados');
	var input_Municipio = document.getElementById('selectMunicipios');
	var flag = true;
	}

	//var input_User = $('#formulario #username');
	//var input_Pass = $('#formulario #passReg');
	//var input_Email = $('#formulario #email');
	//var input_Nombre = $('#formulario #nombre');
	//var input_ApellidoP = $('#formulario #apellidoP');
	//var input_ApellidoM = $('#formulario #input_ApellidoM');
	//var input_Rfc = $('#formulario #rfc');
	//var input_Tel = $('#formulario #tel');
	//var input_Calle = $('#formulario #calle');
	//var input_NumInt = $('#formulario #numint');
	//var input_NumExt = $('#formulario #numext');
	//var input_Colonia = $('#formulario #col');
	//var input_CP = $('#formulario #cp');
	//var input_Estado = $('#formulario #selectEstados');
	//var input_Municipio = $('#formulario #selectMunicipios');

	console.log(input_User.value);
	console.log(input_Pass.value);

	if(!/^[a-zA-Z]+$/.test(input_User.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','user_error');
		var msg = document.createTextNode('Usuario o Contraseña Incorrecto');
		div.appendChild(msg);
		$('<div>Mensaje error</div>').insertAfter($('#username'));
		flag=false;
		//input_User.nextSibling.insertBefore(div,input_User.nextSibling);
	}
	else{
		var dir_error = document.getElementById('user_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^[a-zA-Z]+$/.test(input_Pass.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','user_error');
		var msg = document.createTextNode('Usuario o Contraseña Incorrecto');
		div.appendChild(msg);
		$('<div>Mensaje error</div>').insertAfter($('#passReg'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('pass_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	/*if(!/^\w[@]$/.test(input_Email.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','email_error');
		var msg = document.createTextNode('Email Incorrecto');
		div.appendChild(msg);
		$('Mensaje error').insertAfter($('#email'));
	}
	else{
		var dir_error = document.getElementById('email_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}*/

	if(!/^[a-zA-Z\s]+$/.test(input_Nombre.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','nombre_error');
		var msg = document.createTextNode('Nombre Incorrecto');
		div.appendChild(msg);
		$('<div>Error: Campo nombre solo acepta valores A-Z a-z</div>').insertAfter($('#nombre'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('nombre_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^[a-zA-Z\s]+$/.test(input_ApellidoM.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','apellidoM_error');
		var msg = document.createTextNode('Incorrecto');
		div.appendChild(msg);
		$('<div>Error: Campo apellido solo acepta valores A-Z a-z</div>').insertAfter($('#apellidoM'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('apellidoM_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^[a-zA-Z\s]+$/.test(input_ApellidoP.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','apellidoP_error');
		var msg = document.createTextNode('Incorrecto');
		div.appendChild(msg);
		$('<div>Error: Campo apellido solo acepta valores A-Z a-z</div>').insertAfter($('#apellidoP'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('apellidoM_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^[a-zA-Z]{4}\d{6}[a-zA-Z]{3}$/.test(input_Rfc.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','rfc_error');
		var msg = document.createTextNode('Incorrecto');
		div.appendChild(msg);
		$('<div>Error: RFC 4 letras 6 digitos 3 letras</div>').insertAfter($('#rfc'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('rfc_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^\d{10}$/.test(input_Tel.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','tel_error');
		var msg = document.createTextNode('Incorrecto');
		div.appendChild(msg);
		$('<div>Error: Solo 10 digitos</div>').insertAfter($('#tel'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('tel_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^[a-zA-Z\s]+$/.test(input_Calle.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','calle_error');
		var msg = document.createTextNode('Incorrecto');
		div.appendChild(msg);
		$('<div>Error: Solo acepta letras</div>').insertAfter($('#calle'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('calle_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^\d+$/.test(input_NumInt.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','numint_error');
		var msg = document.createTextNode('Incorrecto');
		div.appendChild(msg);
		$('<div>Error: Solo acepta numeros</div>').insertAfter($('#numint'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('numint_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^\d+$/.test(input_NumExt.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','numext_error');
		var msg = document.createTextNode('Incorrecto');
		div.appendChild(msg);
		$('<div>Error: Solo acepta numeros</div>').insertAfter($('#numext'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('numext_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^[a-zA-Z\s]+$/.test(input_Colonia.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','colonia_error');
		var msg = document.createTextNode('Incorrecto');
		div.appendChild(msg);
		$('<div>Error: Solo acepta letras</div>').insertAfter($('#col'));
		flag=false;
	}
	else{
		var dir_error = document.getElementById('colonia_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(flag == false){
		return 0;
	}
	//if(form.selectMunicipios.selectedIndex == 0){
	//	alert('Debe seleccionar un municipio');
	//}


}