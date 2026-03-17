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
})


