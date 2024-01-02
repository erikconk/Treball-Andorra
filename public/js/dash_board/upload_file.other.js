var win_state = false;

const data_set= {
    // ID of main frontView
    frontWindow : 'upload-avatar-front-view',
    // Items selectionables class array
    selectItems : 'fv-select',
    // Id's of buttons open and close
    controllers : {
        openFrontView : openCloseFrontView,
        closeFrontView : openCloseFrontView,
    },
    selectItem : selectItem,
}

function assingFunctionsInDOM(){
    for (let [key, value] of Object.entries(data_set['controllers'])) {
        let element = document.getElementById(key);
        //element.addEventListener('click', value)
        element.onclick = value;
    }

    let selectionableItems = document.getElementsByClassName('fv-select');
    for( let i = 0; i < selectionableItems.length; i++){
        selectionableItems[i].onclick = selectItem;
    }
}

function openCloseFrontView() {
    if( !win_state ) document.getElementById(data_set['frontWindow']).style.display = 'Block'; 
    else document.getElementById(data_set['frontWindow']).style.display = 'none', console.log('here');
    win_state = !win_state
}

function selectItem(){
    let selectionableItems = document.getElementsByClassName('fv-select');
    for( let i = 0; i < selectionableItems.length; i++){
        selectionableItems[i].classList.remove('selected-avatar');
    }
    this.classList.add('selected-avatar');
}










assingFunctionsInDOM();