const api_url = 'http://localhost:80/new_acount/exist_acount';
const api_url_post = 'http://localhost:80/new_acount/validate_acount';


const new_acount_form = document.getElementById('newAcountForm');

var form_page = document.getElementsByClassName('form-element');
var current_page = 0;

var input_mail = document.getElementById('user_mail');
var input_key = document.getElementById('user_key');
var input_rep_key = document.getElementById('user_key_repeat');
var token = document.getElementById('csrf_token');
var submit_placeholder = document.getElementById('submit_status');
var mail;
var key;
var rep_key;


function accept_for_next(event){
    let pass_btn = document.getElementById('netx-if-is-valid-2')
    if(event.checked) pass_btn.disabled = false;
    else pass_btn.disabled = true;
}
function handle_description(text_id){
    handle_clean(2);
    handle_display(text_id);
}

function handle_display(text_id){
    let next = document.getElementById('form-1');
    let div = document.getElementById(text_id);
    div.style.display = "Block";
    next.disabled = false;
}

function handle_clean(iter){
    let parent_div = document.getElementById("text-description");
    for(let i = 0; i <= iter; i++){
        parent_div.children[i].style.display = "none";
    } 
}

function change_page(value){
    clean_page(current_page);
    if(value == "next") current_page++; 
    else current_page--;
    show_form(current_page);
}

function show_form(page){
    form_page[page].style.display = "flex";
}
function clean_page(page){
    form_page[page].style.display = "none";
}
function ValidateEmail(value) {
    var validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    if (value.match(validRegex)) return true;
    else return false;  
}
function ValidateKey(value){
    if(value.length < 8) return false;
    else return true;
}
function ValidateKeyRepeat(id, value){
    let key = document.getElementById(id).value;
    if(value == key) return true;
    else return false;
}
function getDataExist(){
    data = {};
    data["user_email"] = input_mail.value;
    return data;
}
function throwErrorMail(data){
    let divError = document.getElementById('error-mail');
    if(data == false){
        divError.innerHTML = "";
    }else{
        divError.innerHTML = `El correu electrònic <strong><i>${data['user_email']}</i></strong> ja està donat d'alta.` 
    }
}
function getUserType(){
    let types = document.getElementsByClassName('user_type');
    var type_check;
    for(let i = 0; i < types.length; i++){
        if(types[i].checked) type_check = types[i].value;
    }
    return type_check
}
function enable_valid(id){
    document.getElementById(id).classList.add("valid-input")
}
function disable_valid(id){
    document.getElementById(id).classList.remove("valid-input")
}
async function validate_input(id){
    let input = document.getElementById(id).value;
    switch(id){
        case "user_mail":
            mail = ValidateEmail(input)
            if(mail){
                let values = getDataExist();
                postData_x_www(api_url, values).then((data) => {
                    if(data['exist']) disable_valid(id), throwErrorMail(values);
                    else enable_valid(id), throwErrorMail(false);
                });
            } 
            else disable_valid(id);
            break;
        case "user_key":
            key = ValidateKey(input)
            if(key) enable_valid(id);
            else disable_valid(id)
            break;
    }
    if(mail && key){
        document.getElementById('netx-if-is-valid').disabled = false;
    }else{
        document.getElementById('netx-if-is-valid').disabled = true;
    }
}

async function postData_x_www(url = "", data = {}) {
    var formBody = [];
    for (var property in data) {
      var encodedKey = encodeURIComponent(property);
      var encodedValue = encodeURIComponent(data[property]);
      formBody.push(encodedKey + "=" + encodedValue);
    }
    formBody = formBody.join("&");
    const response = await fetch(url, {
      method: "POST", 
      mode: "cors", // no-cors, *cors, same-origin
      cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
      credentials: "same-origin", // include, *same-origin, omit
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: "follow", // manual, *follow, error
      referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: formBody // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
}

function get_data_post(){
    let data = {};
    data['user_type'] = getUserType();
    data['user_email'] = input_mail.value;
    data['user_key'] = input_key.value;
    data['user_alias'] = input_mail.value.split("@")[0];
    data['token'] = token.value;

    return data;
}
async function submit_newAcount(){
    change_page('next');
    let data = get_data_post();
    try {
        postData_x_www(api_url_post, data).then((data) => {
            console.log(data);
            if(data['succes']){
                submit_succes();
                change_page('next');
            }else{
                submit_error();
                change_page('next');
            }
        });
        
    } catch (error) {
        console.log(error)
        submit_error();
        change_page('next');
    }
}
function submit_succes(){
    submit_status.classList.add("succes-message");
    submit_status.innerHTML = `La seva petició ha sigut processada amb èxit. Per terminar de validar el seu compte, rebrà un correu electrònic a l'adreça <strong >${input_mail.value}</strong> per acabar de confirmar el seu compte. <br><br> Un cop hagi ingressat al seu compte, podrà editar el seu perfil i començar a pujar anuncis.`
}
function submit_error(){
    submit_status.classList.add("error-message");
    submit_status.innerHTML = "Hi ha hagut algun error amb la seva petició i no s'ha pogut processar correctament. <br><br>Si us plau, torni a intentar-ho o posis en contacte amb nosaltres."
}