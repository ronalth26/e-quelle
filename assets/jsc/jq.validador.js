var vMensajeOk = "*";
var vMensajeEr1 = "Req";
var vMensajeEr2 = "Formato incorrecto";

function acumula_coment(pAcum, pValor) {
    if (pAcum != "")
        pAcum = pAcum + ", ";
    pAcum = pAcum + pValor;
    return pAcum;
}

function valSimpleAjx1(pForm, pCapaAlerta, pCapaCarga, pTipoEnvio, pLinkEnlace, pIntVertical) {
    var varError = "";
    var varAuxFileFormat = "";
    var varAuxFileFound = "";
    var varTinError = "";

    var arrAsinc = new Array();

    $("#" + pForm).find(':input').each(function() {
        var elemento = this;
        if (parseInt(elemento.className.indexOf('req')) > 0) {
            varTinError = 0;
            switch (elemento.type) {
                case "text":
                    if (elemento.value == '') {
                        varError = acumula_coment(varError, elemento.title);
                        varTinError = 1;
                    }
                    break;
                case "textarea":
                    if (elemento.value == '') {
                        varError = acumula_coment(varError, elemento.title);
                        varTinError = 1;
                    }
                    break;
                case "select-one":
                    if (elemento.value == '') {
                        varError = acumula_coment(varError, elemento.title);
                        varTinError = 1;
                    }
                    break;
                case "radio":
                    if ($("input[name='" + elemento.name + "']:checked").length == 0) {
                        varError = acumula_coment(varError, elemento.title);
                        varTinError = 1;
                    }
                    break;
                case "checkbox":
                    if ($("input[name='" + elemento.name + "']:checked").length == 0) {
                        varError = acumula_coment(varError, elemento.title);
                        varTinError = 1;
                    }
                    break;
                case "file":
                    if (($("#" + elemento.name + "Act").val() == "") && (elemento.value == '')) {
                        varError = acumula_coment(varError, elemento.title);
                        varTinError = 1;
                    } else {
                        varAuxFileFormat = $("#" + elemento.name + "Lib").val().split(",");
                        varAuxFileFound = '';
                        if (elemento.value != "") {
                            for (j = 0; j < parseInt(varAuxFileFormat.length); j++)
                                if (elemento.value.indexOf("." + varAuxFileFormat[j]) != '-1')
                                    varAuxFileFound = 'ok';
                            if (varAuxFileFound != 'ok') {
                                varError = acumula_coment(varError, elemento.title + " formato incorrecto");
                                varTinError = 1;
                            }
                        }
                    }
                    break;
            }
            if (varTinError == 1) { //Error
                $("#" + elemento.name).removeClass(elemento.type + " req");
                $("#" + elemento.name).addClass(elemento.type + "_er req");
            } else {
                $("#" + elemento.name).removeClass(elemento.type + "_er req");
                $("#" + elemento.name).addClass(elemento.type + " req");
            }
        }
        if (parseInt(elemento.className.indexOf('err')) > 0) {
            varTinError = 0;
            switch (elemento.type) {
                case "file":
                    if (elemento.value != '') {
                        varAuxFileFormat = $("#" + elemento.name + "Lib").val().split(",");
                        varAuxFileFound = '';
                        if (elemento.value != "") {
                            for (j = 0; j < parseInt(varAuxFileFormat.length); j++)
                                if (elemento.value.indexOf("." + varAuxFileFormat[j]) != '-1')
                                    varAuxFileFound = 'ok';
                            if (varAuxFileFound != 'ok') {
                                varError = acumula_coment(varError, elemento.title + " formato incorrecto");
                                varTinError = 1;
                            }
                        }
                    }
                    break;
            }
            if (varTinError == 1) { //Error
                $("#" + elemento.name).removeClass(elemento.type + " err");
                $("#" + elemento.name).addClass(elemento.type + "_er err");
            } else {
                $("#" + elemento.name).removeClass(elemento.type + "_er err");
                $("#" + elemento.name).addClass(elemento.type + " err");
            }
        }
        //alert("ID="+ elemento.id + ", NOMBRE=" + elemento.name + ", VALOR=" + elemento.value + ", TIPO=" + elemento.type + ", CLASE=" + elemento.className); 
    });

    if (varError != "") {
        if (pIntVertical != "")
            window.scrollTo(0, pIntVertical);
        $("#" + pCapaAlerta).removeClass("alerta2");
        $("#" + pCapaAlerta).addClass("alerta2");
        $("#" + pCapaAlerta).html("<strong>Ingrese los siguientes datos: " + varError + "</strong><br clear='all' />");
        return false;
    } else {
        $("#" + pCapaAlerta).removeClass("alerta2");
        $("#" + pCapaAlerta).addClass("alerta2");
        $("#" + pCapaAlerta).html("<span>Cargando</span>");

        if (pTipoEnvio == "FORM") {
            return true;
        } else {
            if (pTipoEnvio == "AJAX") {
                $.ajax({
                    type: "POST",
                    url: $("#" + pForm).attr("action"),
                    data: $("#" + pForm).serialize(),
                    success: function(data) {
                        $("#" + pCapaCarga).html(data);
                        $("#" + pForm)[0].reset();
                    },
                    error: function(err) {
                        alert(err);
                    }
                });
            } else
                return (true);
        }
    }
}

function cambiarReq(pValor) {
    var pTot = document.getElementById('totalReq').value;
    var pVal = '';
    for (var i = 0; i < pTot; i++) {
        pVal = document.getElementById('requeridos' + i).value;
        pVal = pVal.split('/');
        if (pValor == 0) {
            document.getElementById(pVal[0]).className = pVal[1] + " req";
            document.getElementById("cel_" + pVal[0]).innerHTML = '(*)';
        } else {
            document.getElementById(pVal[0]).className = pVal[1];
            document.getElementById("cel_" + pVal[0]).innerHTML = '';
        }
    }
}