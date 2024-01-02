const posts = document.getElementById('posts-container');

function selectSwitch(input, id){
    let element = document.getElementById(id);
    if(input.checked) element.style.backgroundColor = " #e2e8ee ", element.style.transition = "background-color 0.5s";
    else element.style.backgroundColor = "white";
}

function selectAllSwitch(event){
    let allPost = posts.children;
    
    if(event.checked){
        for(let i = 0; i < allPost.length; i++){
            let checkBox = buscarCheckbox(allPost[i]);
            if(checkBox) checkBox.checked = false, checkBox.click();
        } 
    }else{
        for(let i = 0; i < allPost.length; i++){
            let checkBox = buscarCheckbox(allPost[i]);
            if(checkBox) checkBox.checked = true, checkBox.click();
        } 
    }
}
function buscarCheckbox(elemento) {
    // Verificar si el elemento actual es un checkbox
    if (elemento.tagName === 'INPUT' && elemento.type === 'checkbox') {
        return elemento;
    }

    // Recorrer los descendientes del elemento actual
    for (var i = 0; i < elemento.children.length; i++) {
        var resultado = buscarCheckbox(elemento.children[i]);

        // Si se encuentra un checkbox, retornarlo
        if (resultado) {
            return resultado;
        }
    }

    // Retornar null si no se encuentra ningún checkbox
    return null;
}