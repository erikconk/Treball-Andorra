function enable(event, input_id = []){
    let state = null;
    let icon = event.innerHTML.split(" ")[0];

    if( icon == '🔒') event.innerHTML = '🔓 Cambiar', state = true;
    else event.innerHTML = '🔒 Cambiar', state = false;

    if(state){
        for(let i = 0; i < input_id.length; i++){
            document.getElementById(input_id[i]).disabled = false;
        }
    }else{
        for(let i = 0; i < input_id.length; i++){
            document.getElementById(input_id[i]).disabled = true;
        }
    }
}