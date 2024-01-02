var elementExist = true;

document.addEventListener("DOMContentLoaded", function() {
    deleteItemByTime('message');
});


function deleteItemByTime(elementoId) {
    var elemento = document.getElementById(elementoId);
    // Verificar si el elemento existe
    if (elemento) {
        // Establecer un temporizador para eliminar el elemento después de 10 segundos
        setTimeout(function () {
            if(elementExist) elemento.parentNode.removeChild(elemento);
        }, 10000); // 10000 milisegundos = 10 segundos
    } 
}

function closeMessage(elementoId){
    var elemento = document.getElementById(elementoId);
    // Verificar si el elemento existe
    if (elemento) {
        elemento.parentNode.removeChild(elemento);
        elementExist = false;
    }
}