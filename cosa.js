$("#tabla").dataTable({ searching: false });


function abrirModal() {
    var camposObligatorio = document.getElementsByClassName("form");
    var ncampos = camposObligatorio.length;
    for (var i = 0; i < ncampos; i++) {
        camposObligatorio[i].value = "";
    }

}

function llenarModal() {

    var camposObligatorio = document.getElementsByClassName("form");
    var ncampos = camposObligatorio.length;
    for (var i = 0; i < ncampos; i++) {
        camposObligatorio[i].value = "";
    }

    var reg = document.getElementById("edit").innerHTML;
    alert(reg);
    var lista = reg.split('-');
    document.getElementById("txtNombre").value = lista[1];
    document.getElementById("txtCorreo").value = lista[2];
    document.getElementById("txtCel").value = lista[3];
    document.getElementById("txtContra").value = lista[4];
    document.getElementById("cboRol").value = lista[5];
    document.getElementById("txtCiudad").value = lista[6];
    document.getElementById("txtBarrio").value = lista[7];

}