function validar_miembro(pEnlace){
	var vError='';
	if($("#log_uss").val()=="")
		vError=$("#log_uss").attr("title");
	if($("#log_pss").val()==""){
		if(vError!="")
			vError=vError+", ";
		vError=vError+$("#log_pss").attr("title");
	}
	if(vError!=""){
		$("#alerta").html("<div class='alerta2'>Ingrese: "+vError+"</div>");
	}else{
		$("#alerta").html("<div class='alerta2'>Validando, un momento por favor</div>");
		var loc = window.location;
		var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
		var pLoc=loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
		//alert(pEnlace+'uss='+$("#log_uss").val()+'&pss='+$("#log_pss").val()+'&acc=2');
		$.ajax
		({	type: 'post',
			url: pEnlace,
			data: 'uss='+$("#log_uss").val()+'&pss='+$("#log_pss").val()+'&acc=2',
			cache: false,
			success: function(html)
			{	console.log(html);
				var jsonData=eval(html);
				if(jsonData.status=='1')//OK
					location.href=pLoc;
				else//Error
					$("#alerta").html("<div class='alerta2'>Usuario y/o contraseña equivocados, por favor vuelva a intentarlo</div>");
			} 
		});
	}
}
function cerrar_sesion_miembro(pEnlace){
	var loc = window.location;
	var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
	var pLoc=loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
	$.ajax
	({	type: 'post',
		url: pEnlace,
		data: '&acc=3',
		cache: false,
		success: function(html)
		{	location.href=pLoc;
		} 
	});
}
function cargar_directorio(pEnlace,pPeriodo,pCapa){
	$.ajax
	({	type: 'post',
		url: pEnlace,
		data: '&opc=2&per='+pPeriodo,
		cache: false,
		success: function(html)
		{	$("#"+pCapa).html(html);
		} 
	});
}
function cargar_comite(pEnlace,pPeriodo,pCapa){
	$.ajax
	({	type: 'post',
		url: pEnlace,
		data: '&opc=2&per='+pPeriodo,
		cache: false,
		success: function(html)
		{	$("#"+pCapa).html(html);
		} 
	});
}
function cargar_publicacion(pEnlace,pTipo,pTitulo,pPagina,pCapa){
	$.ajax
	({	type: 'post',
		url: pEnlace,
		data: '&opc=2&cat='+pTipo+"&txt="+pTitulo+"&pag="+pPagina,
		cache: false,
		success: function(html)
		{	$("#"+pCapa).html(html);
		} 
	});
}
function cargar_form(pCapa,pStrRuta){
	$.ajax
	({	type: 'post',
		url: pStrRuta+'box_form.php',
		data: '',
		cache: false,
		success: function(html)
		{	$("#"+pCapa).html(html);
		} 
	});
}
function validar_email(valor){
	var regex=/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	var valtxtemail=valor.val();
	if(!(valtxtemail.match(regex))){
		//valor.focus();
		valor.val("");
		valor.css("border-color", "#F00");
	}
	else{
		valor.css("border-color", "#c6c6c6");	
	}
}
function is_null(pObject){
	if ($('#'+pObject).length)
		return true;
	else
		return false;
}
function cambiar_pag(layer,pag){
	$.ajax
	({	type: 'get',
		url: pag,
		data: '',
		cache: false,
		success: function(html)
		{	$("#"+layer).html(html);
		} 
	});
}
function popup(mypage,myname,w,h,scrollbar,resi){
	LeftPosition = (screen.width-w)/2
	TopPosition = (screen.height-h)/2 
	settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scrollbar+',resizable='+resi+',toolbar=no,directories=no,menubar=no,status=no'
	//window.open(mypage,myname,settings);
	var vent ;
	 vent =open(mypage,vent,settings);
	 vent.focus();
}

function print_sec(pValor,pUrl){
	var ventana = window.open("","","");
	var contenido = "<html><link rel='stylesheet' type='text/css' href='"+pUrl+"css/imprimir.css' /><body style='background:#FFFFFF' onload='window.print();window.close();'><div style='width:720px; background:#FFFFFF; text-align:left;'>" + document.getElementById(pValor).innerHTML + "</div></body></html>";
	ventana.document.open();
	ventana.document.write(contenido);
	ventana.document.close();
}