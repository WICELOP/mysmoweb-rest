var index = 0;
var totale = 1;
var esercenteNonModificato = JSON.parse(esercenteNonModificatoJSON);
function aggiungiOpzione()
{
    index++;
    totale++;
    //
    var li = document.createElement("li");
    li.className = "mdl-list__item ftm";
    var label1 = document.createElement("label");
    label1.className = "mdl-textfield__label";
    label1.setAttribute("for","puntovendita"+index);
    label1.appendChild(document.createTextNode("Nuovo punto vendita"));
    var input1 = document.createElement("input");
    input1.className = "mdl-textfield__input puntoVendita";
    input1.setAttribute("type","text");
    input1.setAttribute("id","puntovendita"+index);
    var div1 = document.createElement("div");
    div1.className = "mdl-textfield mdl-js-textfield";
    var span1 = document.createElement("span");
    span1.className = "mdl-list__item-primary-content spc";
    var a = document.createElement("a");
    a.className = "mdl-list__item-secondary-action mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect";
    a.setAttribute("onclick","cancellaOpzione(this)");
    var i = document.createElement("i");
    i.className = "material-icons gr";
    i.appendChild(document.createTextNode("delete"));
    a.appendChild(i);
    div1.appendChild(input1);
    div1.appendChild(label1);
    span1.appendChild(div1);
    li.appendChild(span1);
    li.appendChild(a);
    document.getElementsByClassName("demo-list-control mdl-list")[0].appendChild(li);
    componentHandler.upgradeDom();
}
function cancellaOpzione(obj)
{
    if ($("li:visible").length != 1)
    {
        var s = obj.parentNode;
        $(s).hide();
        totale--;
    }
    else {
        messaggio("Devi avere almeno un punto vendita");
    }
}
function messaggio(testo)
{
    var handler = function (event) {
    }
    'use strict';
    var data = {
        message: testo,
        timeout: 3500,
        actionHandler: handler,
        actionText: 'Ok'
    };
    document.querySelector('#demo-snackbar-example').MaterialSnackbar.showSnackbar(data);
    setTimeout(function() {window.location.href = "listaEsercenti.php?evd="+getNome(); }, 3050);
}
function getNome()
{
    if (document.getElementById("nome").value == "" || document.getElementById("nome").value == "undefined") {
        return "Nome azienda";
    }
    else {
        return document.getElementById("nome").value;
    }
}

function getEmail()
{
    if (document.getElementById("email").value == "" || document.getElementById("email").value == "undefined") {
        return "email@gmail.com";
    }
    else {
        return document.getElementById("email").value;
    }
}

function getPuntiVendita()
{
    var listaEsercenti = new Array();
    var index = 0;
    var s = $(".puntoVendita");
    s.each(function () {
        if ($(this).val() == "" || $(this).val() == "undefined") {
            listaEsercenti[index] = "Nuovo punto vendita";
        }
        else {
            listaEsercenti[index] = $(this).val();
        }
        index++;
    });
    return listaEsercenti;
}

function uploadFile()
{
    var file_data = $('#file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $(".mdl-spinner").first().show();
    $(".loading").first().show();
    $.ajax({
        url: '../backEnd_json/upload.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (php_script_response) {
            $(".mdl-spinner").first().hide();
            $(".loading").first().hide();
        }
    });
}
function getFileName()
{
    try {
        var fileInput = document.getElementById('file');
        var fileName = fileInput.value.split(/(\\|\/)/g).pop();
        var str = "/var/uploads/" + fileName;
    } catch (err) {
        return "errore";
    }
    return str;
}
