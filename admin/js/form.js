// JavaScript Documentvar vStrMsjOk="(*)";
var vMensajeOk="*";
var vMensajeEr1="Req";
var vMensajeEr2="Formato incorrecto";

function acumulaComent(pAcum,pValor)
{	if(pAcum!="")
		pAcum=pAcum+", ";
	pAcum=pAcum+pValor;
	return pAcum;
}
function mostrarMensaje(pPref,pCampo,pMensaje)
{	if(pPref!="")
		document.getElementById(pPref+pCampo).innerHTML=pMensaje;
}
function valSimpleAjx1(pStrMsj,pForm,pCapaAlerta,pCapaCarga,pTipoEnvio,pTipoCarga,pLinkEnlace,pIntVertical)
{	var accum="";
	var varCmpClass="";
	var varCmpType="";
	var varCmpName="";
	var varEnlace="";
	var varCmpAlt="";
	var varAuxFile1="";
	var varAuxFile2="";
	var frm=eval('document.'+pForm);
	var frmTxt="document."+pForm;
	var parPost="";
	var total=0;
	
	var arrAsinc = new Array();
	var accAsinc = 0;
	var varIntError=0;
	
	for (i=0;i<frm.elements.length;i++)
	{	varCmpClass=frm.elements[i].className;
		varCmpType=frm.elements[i].type;
		varCmpName=frm.elements[i].name;
		varCmpAlt=frm.elements[i].alt;
		if(varIntError>0)
			varIntError=0;
		
		if(varCmpName==undefined){
			varCmpName='';
		}else{
			if(varCmpName=="txtSv")
			{	varEnlace=frm.elements[i].value;	}
			else
			{	if(parseInt(varCmpName.indexOf('noenviar'))>0)
				{	arrAsinc[accAsinc]=frm.elements[i].value;
					accAsinc=accAsinc+1;
				}
				else
				{	if(parPost!="")
						parPost=parPost+"&";
					if(varCmpType=="radio")
						parPost=parPost+varCmpName+"=";
					else
						parPost=parPost+varCmpName+"="+frm.elements[i].value;
				}
			}
			if(parseInt(varCmpClass.indexOf('req'))>0)
			{	switch(varCmpType)
				{	case "select-one":	
									varCmpType=varCmpType.replace("-one","");
									if((frm.elements[i].value=="")||(frm.elements[i].value=="0")||(frm.elements[i].value=="n"))
									{	accum=acumulaComent(accum,frm.elements[i].title);
										varIntError=varIntError+1;
									}
									break;
					case "file":	varAuxFile1=parseInt(i)-1;
									varAuxFile1=frm.elements[varAuxFile1].value;
									if((varAuxFile1=="")&&(frm.elements[i].value==""))
									{	//mostrarMensaje(pStrMsj,varCmpName,vMensajeEr1);
										accum=acumulaComent(accum,varCmpAlt);
										varIntError=varIntError+1;
									}else{
										varAuxFile2=varCmpName+"lib";
										varAuxFile2=eval(frmTxt+'.'+varAuxFile2+'.value');
										varAuxFile2=varAuxFile2.split(",");
										if(frm.elements[i].value!="")
										{	adres1 = frm.elements[i].value;
											for(j=0;j<parseInt(varAuxFile2.length);j++)
											{	if(j==0)
												{	index1 = adres1.indexOf("."+varAuxFile2[j]);	}
												else
												{	index1 = index1 + adres1.indexOf("."+varAuxFile2[j]);	}
											}
											//Si no es del formato establecido
											if (index1 == eval("-"+varAuxFile2.length))
											{	//mostrarMensaje(pStrMsj,varCmpName,vMensajeEr2);
												accum=acumulaComent(accum,varCmpAlt+" formato incorrecto");
												varIntError=varIntError+1;
											}
										}
									}
									break;
					case "radio":	total=0;
									varAuxFile1=eval(frmTxt+'.'+varCmpName+'.length');
									varAuxFile2=0;
									for ( var j = 0; j < eval(frmTxt+'.'+varCmpName+'.length'); j++ )
									{	if(eval(frmTxt+'.'+varCmpName+'['+j+'].checked')) 
										{	total=parseInt(total)+1;
											varAuxFile2=eval(frmTxt+'.'+varCmpName+'['+j+'].value');
										}
									}
									if(total=="0")
									{	mostrarMensaje(pStrMsj,varCmpName,vMensajeEr1);
										accum=acumulaComent(accum,varCmpAlt);
									}
									parPost=parPost+varAuxFile2;
									i=parseInt(j)+parseInt(i)-1;
									break;
					case "checkbox":total=0;
									if(parseInt(varCmpName.indexOf('[]'))>0)
										varCmpName=varCmpName.replace('[]','');
									if(varAuxFile2!=varCmpName){
										varAuxFile1=eval(frmTxt+'.'+varCmpName+'.length');
										if(varAuxFile1<=1)
										{	if (!frm.elements[i].checked){//Elemento type=checkbox 
												//mostrarMensaje(pStrMsj,varCmpName,vMensajeEr1);
												accum=acumulaComent(accum,varCmpAlt);
											}
										}else{
											if(eval(frmTxt+'.'+varCmpName+'.length'))
											{	for ( var j = 0; j < eval(frmTxt+'.'+varCmpName+'.length'); j++ )
												{	if(eval(frmTxt+'.'+varCmpName+'['+j+'].checked')) 
													{	total=parseInt(total)+1;	}
												}
											}else{
												if(eval(frmTxt+'.'+varCmpName+'.checked')) 
												{	total=parseInt(total)+1;	}
											}
											varAuxFile1='';
											if(parseInt(varCmpClass.indexOf('chkGrupo'))>0)
												varAuxFile1=frm.elements[i].title;
											if(total=="0")
											{	//mostrarMensaje(pStrMsj,varCmpName,vMensajeEr1);
												accum=acumulaComent(accum,varCmpAlt);
												if(varAuxFile1!="")
													document.getElementById(varAuxFile1).className='boxEr';
											}else{
												if(varAuxFile1!="")
													document.getElementById(varAuxFile1).className='box';
											}
											i=parseInt(j)+parseInt(i)-1;
											varAuxFile2=varCmpName;
										}
									}
									break;
					default:		if(frm.elements[i].value=="")
									{	//mostrarMensaje(pStrMsj,varCmpName,vMensajeEr1);
										if(varCmpType=="textarea")
											varCmpAlt=frm.elements[i].title;
										accum=acumulaComent(accum,varCmpAlt);
										varIntError=varIntError+1;
									}
									break;
				}
			}
			if(parseInt(varCmpClass.indexOf('compar'))>0)
			{	varAuxFile1=eval(frmTxt+'.'+varCmpName+'compar');
				if(frm.elements[i].value!=varAuxFile1.value)
				{	frm.elements[i].className=varCmpType+'Er req compar';
					varAuxFile1.className=varCmpType+'Er req';
					varAuxFile2=eval(frmTxt+'.'+varCmpName+'comparLib').value;
					mostrarMensaje(pStrMsj,varCmpName,vMensajeEr1);
					accum=acumulaComent(accum,varAuxFile2);
				}
				else
				{	varAuxFile1.className=varCmpType+' req';
					mostrarMensaje(pStrMsj,varCmpName,vMensajeOk);
				}
			}
			if(parseInt(varCmpClass.indexOf('err'))>0)
			{	switch(varCmpType)
				{	case "text":	break;
					case "textarea":break;
					case "select-one":	break;
					case "file":	varAuxFile2=varCmpName+"lib";
									varAuxFile2=eval(frmTxt+'.'+varAuxFile2+'.value');
									varAuxFile2=varAuxFile2.split(",");
									if(frm.elements[i].value!="")
									{	adres1 = frm.elements[i].value;
										for(j=0;j<parseInt(varAuxFile2.length);j++)
										{	if(j==0)
											{	index1 = adres1.indexOf("."+varAuxFile2[j]);	}
											else
											{	index1 = index1 + adres1.indexOf("."+varAuxFile2[j]);	}
										}
										if (index1 == eval("-"+varAuxFile2.length))
										{	//frm.elements[i].className=varCmpType+'Er req';
											mostrarMensaje(pStrMsj,varCmpName,vMensajeEr2);
											accum=acumulaComent(accum,varCmpAlt+" formato incorrecto");
											varIntError=varIntError+1;
										}
									}
									break;
				}
			}
			if(parseInt(varCmpClass.indexOf('num'))>0)
			{	if(frm.elements[i].value!="")
				{	if(!valNumeros(frm.elements[i].value))
					{	accum=acumulaComent(accum,varCmpAlt+": número válido");
						varIntError=varIntError+1;
					}
				}
			}
			if(parseInt(varCmpClass.indexOf('mail'))>0)
			{	if(frm.elements[i].value!="")
				{	if(!valMail(frm.elements[i].value))
					{	accum=acumulaComent(accum," email válido");
						varIntError=varIntError+1;
					}
				}
			}
			if((varCmpType!="radio")&&(varCmpType!="checkbox"))
			{	varCmpClass=varCmpClass.replace("Er","");
				if(varIntError>0){//ERROR
					varCmpClass=varCmpClass.replace(varCmpType,varCmpType+"Er");
				}
				frm.elements[i].className=varCmpClass;
			}
		}
	}
	if(accum!="")
	{	if(pIntVertical=="")
			pIntVertical=80;
		window.scrollTo(0,pIntVertical);
		document.getElementById(pCapaAlerta).className="alerta1";
		document.getElementById(pCapaAlerta).innerHTML="Ingrese: <strong>"+accum+"</strong>";
		return;
	}
	else
	{	document.getElementById(pCapaAlerta).className="alerta2";
		document.getElementById(pCapaAlerta).innerHTML="Cargando, un momento por favor<br clear='all' />";
		if(pTipoEnvio=="1"){
			recibeid2(varEnlace,"",parPost,pCapaCarga,1,pTipoCarga,pLinkEnlace);}
		else
		{	if(pTipoEnvio=="2"){
				recibeid2(varEnlace,parPost,"",pCapaCarga,1,pTipoCarga,pLinkEnlace);
			}else{
				frm.action=varEnlace;
				frm.submit();
			}
		}
		for(i=0;i<accAsinc;i++)
		{	setTimeout (arrAsinc[i], 1500);	}
	}
}

function valMail(parTexto)
{	var Template = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; //Formato de direccion de correo electronico
	if(parTexto!="") 
	{	if (Template.test(parTexto)) 
		{	return true; 
		}
		else
		{	return false;
		}		
	}else{
		return true;
	}
}

function valNumeros(parNumero)
{	var Template = /^[0-9]+$/i //Formato de alfanumerico	
	if(parNumero!="") 
	{	if (Template.test(parNumero)) 
		{	return true; 
		}
		else
		{	return false;
		}	
	}else{
		return true;
	}
}
function valAcceso()
{	if(document.frmLogin.txtAcc1.value=="")
	{	alert("Por favor ingrese su nombre de usuario");document.frmLogin.txtAcc1.focus();return;	}
	if(document.frmLogin.txtAcc2.value=="")
	{	alert("Por favor ingrese su clave de usuario");document.frmLogin.txtAcc2.focus();return;	}
	document.frmLogin.action="index.php?err=0";
	document.frmLogin.submit();
}

//Funciones
function cargarExcel()
{	if(document.frmList.txtExcel.value!="")
	{	adres1 = document.frmList.txtExcel.value;
		index1 = adres1.indexOf(".xls");
		index1 = index1 + adres1.indexOf(".XLS");
		index1 = index1 + adres1.indexOf(".csv");
		index1 = index1 + adres1.indexOf(".CSV");
		//Si no es del formato establecido
		if (index1 == -4)
		{	alert("Error. Solo XLS o CSV");document.frmList.txtExcel.focus();return;	}
	}
	else
	{	alert("Cargue su archivo");document.frmList.txtExcel.focus();return;
	}
	document.frmList.action="bol-susc.php?acc=7";
	document.frmList.submit();
}



//Envío de boletines
function enviarSuscritos(pAcc,pIdNew,pIdEnvio,pStrNews)
{	recibeid("news_grupo.php","acc="+pAcc+"&itemN="+pIdNew+"&itemE="+pIdEnvio+"&nws="+pStrNews,"","lay_seleccionados",1);
	setTimeout ('cargaDisponibles(2,"'+pIdNew+'","'+pIdEnvio+'","");', 2500);
}
function cargaDisponibles(pAcc,pIdNew,pIdEnvio,pPost)
{	recibeid("news_grupo.php","acc="+pAcc+"&itemN="+pIdNew+"&itemE="+pIdEnvio+"&tipo=2",pPost,"lay_seleccionables",2);
}
function buscarSuscritos(pForm)
{	cargaDisponibles(2,pForm.itemN.value,pForm.itemE.value,"txtNombre1="+pForm.txtNombre.value+"&cmbOrigen1="+pForm.cmbOrigen.value+"&cmbAnio1="+pForm.cmbAnio.value+"&cmbMes1="+pForm.cmbMes.value+"&cmbDia1="+pForm.cmbDia.value+"&cmbIdioma1="+pForm.cmbIdioma.value+"&txtReferencia1="+pForm.txtReferencia.value);
}
function subirSuscritos(pForm,pAcc)
{	var vLongitud="";
	var vItems="";
	if(pAcc==3)
	{	vLongitud = pForm.chkUns.length;
		for (i=1; i < vLongitud; i++) {
			if(pForm.chkUns[i].checked)
			{	if(vItems!="")
					vItems=vItems+",";
				vItems=vItems+pForm.chkUns[i].value;
			}
		}
	}else{
		vLongitud = pForm.chkSel.length;
		for (i=1; i < vLongitud; i++) {
			if(pForm.chkSel[i].checked)
			{	if(vItems!="")
					vItems=vItems+",";
				vItems=vItems+pForm.chkSel[i].value;
			}
		}
	}
	enviarSuscritos(pAcc,pForm.itemN.value,pForm.itemE.value,vItems);
}
function checkAll(pFormCheck,pValor)
{	for (i = 0; i < pFormCheck.length; i++)
		if(pValor=="1")
			pFormCheck[i].checked = true ;
		else
			pFormCheck[i].checked = false ;
}

//Tipo
function cargarTipos(pLayer,pAcc,pOpc,pItemNm,pItemId,pItem,pOrden)
{	recibeid("tipo.php","acc="+pAcc+"&opc="+pOpc+"&"+pItemNm+"="+pItemId+"&item="+pItem+"&ord="+pOrden,"",pLayer,1);
	if(pOrden=="")
		setTimeout ('listarTipos("lay_seleccionables","'+pAcc+'",1,"'+pItemNm+'","'+pItemId+'","",2);', 2500);
}
function listarTipos(pLayer,pAcc,pOpc,pItemNm,pItemId,pItem,pOrden)
{	recibeid("tipo.php","acc="+pAcc+"&opc="+pOpc+"&"+pItemNm+"="+pItemId+"&item="+pItem,"",pLayer,pOrden);
}

//TopViajes
function recargaTop(pLink,pItemV)
{	listarTop(pLink,'lay_seleccionables',8,1,pItemV,'',1);
	listarTop(pLink,'lay_seleccionados',8,2,pItemV,'',2);
}
function listarTop(pLink,pLayer,pAcc,pOpc,pItemV,pItem,pOrden)
{	recibeid(pLink,"acc="+pAcc+"&opc="+pOpc+"&itemV="+pItemV+"&item="+pItem,"",pLayer,pOrden);
}
function cargarTop(pLink,pLayer,pAcc,pOpc,pItemV,pItem,pOrden)
{	recibeid(pLink,"acc="+pAcc+"&opc="+pOpc+"&itemV="+pItemV+"&item="+pItem+"&ord="+pOrden,"",pLayer,1);
	if(pOrden=="")
		setTimeout ('listarTop("'+pLink+'","lay_seleccionables","'+pAcc+'",1,"'+pItemV+'","",2);', 1000);
}

//Resaltados
function pregunta1()
{	return confirm('Confirme eliminar elemento');}

function cambiarReq(pValor)
{	var pTot=document.getElementById('totalReq').value;
	var pVal='';
	for(var i=0;i<pTot;i++){
		pVal=document.getElementById('requeridos'+i).value;
		pVal=pVal.split('/');
		if(pValor==0){
			document.getElementById(pVal[0]).className=pVal[1]+" req";
			document.getElementById("cel_"+pVal[0]).innerHTML='(*)';
		}else{
			document.getElementById(pVal[0]).className=pVal[1];
			document.getElementById("cel_"+pVal[0]).innerHTML='';
		}
	}
}