// JavaScript Document
function validar() {
    var pUs = document.getElementById('txt_uss');
    var pPs = document.getElementById('txt_pss');
    var pFr = document.getElementById('frm_log');
    if ((pUs.value == "") || (pPs.value == "")) {
        alert("Ingrese usuario y contraseña");
        return;
    } else {
        pFr.action = "index.php?err=1";
        pFr.submit();
    }
}

function val_adm() {
    var pFrm = document.frm_edit;
    var pNom = document.getElementById('txt_nombre');
    var pUss = document.getElementById('txt_uss');
    var pPss = document.getElementById('txt_pss');

    if ((pNom.value == "") || (pNom.value == "") || (pPss.value == "")) {
        alert("Ingrese los datos requeridos(*)");
        return;
    } else {
        pFrm.submit();
    }
}

function imprimir(pLayout) {
    var ventana = window.open("", "", "");
    var contenido = "<html><link rel='stylesheet' type='text/css' href='cs/print.css' /><link rel='stylesheet' type='text/css' href='css/css_form.css' /><body style='background:#FFFFFF' onload='window.print();window.close();'><div style='width:720px; background:#FFFFFF; text-align:left;'>" + document.getElementById(pLayout).innerHTML + "</div></body></html>";
    ventana.document.open();
    ventana.document.write(contenido);
    ventana.document.close();
}

function enlace(pEnlace) {
    location.href = pEnlace;
}