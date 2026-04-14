document.addEventListener("DOMContentLoaded", () => {
    // validacion formularios




    // borrados
    const btnOpciones = document.querySelectorAll(".btnOpciones");
    const panelOpciones = document.querySelectorAll(".panel-opciones");
    const cancelarOpciones = document.querySelectorAll(".cancelarOpciones");


    // desplegar opciones
    btnOpciones.forEach((btn, id) => {
        btn.addEventListener("click", () => {
            panelOpciones[id].removeAttribute("hidden");
        })
    })

    // cancelar y ocultar las opciones
    cancelarOpciones.forEach((cancelador, id) => {
        cancelador.addEventListener("click", () => {
            panelOpciones[id].setAttribute("hidden", true);
        })
    })




    // comprobacion contraseñas
    // etiquetas de contraseña
    const contra_input = document.getElementById("password_hash");
    const contra_error = document.getElementById("password_error");

    // funcion verificar contraseña
    contra_input.addEventListener("input", function() {
        const valor = contra_input.value;

        

        // revisar que no este vacio el input
        
        if (valor.length === 0) {
            contra_error.textContent = "";
            contra_input.classList.remove("is-invalid");
            return;
        }

        // comprobar que hay al menos un numero y una letra
        const tipo_contra = /^(?=.*[A-Za-z])(?=.*\d).+$/;
        if (!tipo_contra.test(valor)) {
            contra_error.textContent = "La contraseña debe contener letras y números.";
            contra_input.classList.add("is-invalid");
        } else {
            contra_error.textContent = "";
            contra_input.classList.remove("is-invalid");
            contra_input.classList.add("is-valid");
        }
    })
})


