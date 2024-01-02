const dialog = document.getElementById('delete_post_dialog')
const form = document.getElementById('delete_post_form');
const input = document.getElementById('delete_post_input')
const submit = document.getElementById('delete_post_submit');
const anuncio_id_value = document.getElementById('anuncio');

function openDialog(event){
    anuncio.value = event.id;
    dialog.showModal();
}
function closeDialog(){
    input.value = "";
    anuncio.value = "";
    dialog.close();
}
function unlockPost(event){
    var unlock_length = 8;
    let value = event.value;
    if(value.length > unlock_length){
        submit.disabled = false;       
    }else{
        submit.disabled = true;    
    }
}


// DIALOG 2
const dialog2 = document.getElementById('delete_multiple_post_dialog')
const form2 = document.getElementById('delete_post_form_2');
const input2 = document.getElementById('delete_post_input_2')
const submit2 = document.getElementById('delete_post_submit_2');
const anuncio_id_value2 = document.getElementById('anuncios');

function openDialog2(event){
    let a = get_anuncios_selected();
    putValuesInForm(a);
    dialog2.showModal();
}
function closeDialog2(){
    input.value = "";
    anuncio_id_value2.value = "";
    dialog2.close();
}
function unlockPost2(event){
    var unlock_length = 8;
    let value = event.value;
    if(value.length > unlock_length){
        submit2.disabled = false;       
    }else{
        submit2.disabled = true;    
    }
}
function get_anuncios_selected(){
    let allPost = posts.children;
    let anuncios_selected = [];
    for(let i = 0; i < allPost.length; i++){
        let checkBox = buscarCheckbox(allPost[i]);
        if(checkBox.checked){
            let element_id = allPost[i].id;
            anuncios_selected.push(element_id.split('-')[1]);
        } 
    } 
    return anuncios_selected;
}
function putValuesInForm(anuncios_array = []){
    anuncio_id_value2.value = anuncios_array;
}