function edit(lapiz){
    var tr = lapiz.parentNode.parentNode;
    var selects = tr.querySelectorAll("select");
    var title_white = document.getElementById("title_white");
    title_white.value = selects[0].value;
    var title_black = document.getElementById("title_black");
    title_black.value = selects[1].value;
    var result = document.getElementById("result");
    result.value = selects[2].value;
    var inputs = tr.querySelectorAll("input");
    //id, email, name, pass, rol
    var form = document.getElementById("form");
    var form_inputs = form.querySelectorAll("input");
    for(var i = 0; i < inputs.length; i++){
        form_inputs[i].value = inputs[i].value;
    }
    var type = document.getElementById("type");
    type.value = "edit";
    form.submit();
}


function insert(add){
    var tr = add.parentNode.parentNode;
    var inputs = tr.querySelectorAll("input");
    var selects = tr.querySelectorAll("select");
    var title_white = document.getElementById("title_white");
    title_white.value = selects[0].value;
    var title_black = document.getElementById("title_black");
    title_black.value = selects[1].value;
    var result = document.getElementById("result");
    result.value = selects[2].value;
    //email, name, pass
    var form = document.getElementById("form");
    var form_inputs = form.querySelectorAll("input");
    //saltamos el 0 porque no necesitamos el id
    var j = 0;
    var ok = true;
    for(var i = 0; i < inputs.length && ok; i++){
        j = i + 1;
        if(i==7){
            var ultimo = true;
        }
        if(form_inputs[j].id=="movements"){
            var esPartida = isGame(inputs[i].value);
            if(esPartida){
                form_inputs[j].value = inputs[i].value;
            }
            else{
                alert("Los movimientos de la partida no son correctos.");
                ok = false;
            }
        }
        else{
            form_inputs[j].value = inputs[i].value;
        }
    }
    var type = document.getElementById("type");
    type.value = "insert";
    if(ok){
        form.submit();
    }
}

function borrar(x){
    var tr = x.parentNode.parentNode;
    var inputs = tr.querySelectorAll("input");
    //id, email, name, pass, rol
    var form = document.getElementById("form");
    var form_inputs = form.querySelectorAll("input");
    var salir = false;
    //no importa nada más a que asigne bien el id, es el atributo que usaremos para borrar
    for(var i = 0; i < inputs.length && !salir; i++){
        form_inputs[i].value = inputs[i].value;
        if(form_inputs[j].id=="id"){
            salir = true;
        }
    }
    var type = document.getElementById("type");
    type.value = "delete";
    form.submit();
}


//funcion
function isGame(movements){
    var chess = new Chess();
    return chess.load_pgn(movements);
}