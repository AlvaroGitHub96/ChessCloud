function inicializarVariables(){
    var edit = document.getElementById("edit").textContent;


    var del = document.getElementById("delete").textContent;


    var add = document.getElementById("add").textContent;


}

function edit(lapiz){
    var tr = lapiz.parentNode.parentNode;
    var inputs = tr.querySelectorAll("input");
    //id, email, name, pass, rol
    var form = document.getElementById("form");
    var form_inputs = form.querySelectorAll("input");
    for(var i = 0; i < inputs.length; i++){
        form_inputs[i].value = inputs[i].value;
    }
    var type = document.getElementById("type");
    type.value = "edit"
    form.submit();
}
