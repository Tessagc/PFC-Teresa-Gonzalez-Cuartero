document.addEventListener("DOMContentLoaded", () => {
    // validacion formularios




    // borrados
    const btnBorrar = document.querySelectorAll(".btnBorrar");
    const panelBorrar = document.querySelectorAll(".panel-borrado");
    const cancelarBorrado = document.querySelectorAll(".cancelarBorrado");


    // desplegar opciones de borrado
    btnBorrar.forEach((btn, id) => {
        btn.addEventListener("click", () => {
            panelBorrar[id].removeAttribute("hidden");
        })
    })

    // cancelar el borrado y ocultar las opciones de borrado
    cancelarBorrado.forEach((cancelador, id) => {
        cancelador.addEventListener("click", () => {
            panelBorrar[id].setAttribute("hidden", true);
        })
    })
})


