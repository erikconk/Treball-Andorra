try {
    window.onload = default_img = outupImage.src;
    
} catch (error) {
    //
}
var image_to_save = null;
var upload_img = document.getElementById('hidden_img_avatar_upload');
var upload_img_field = document.getElementById('imageAvatarInput');
var name_image_avatar = document.getElementById('user_avatar_field')
var image_output = document.getElementById('image_output');
var ouput_src = null;
var avatarOrUpload = null; // Avatar true, image false


function openFrontView([id, displayStyle]){
    return document.getElementById(id).style.display = `${displayStyle}`;
}
function closeFrontView(id){
    resetUploadAvatarContainer();
    document.getElementById(id).style.display = "none";
}


function save(id){
    pushOutImg(ouput_src);
    deleteClones();
    let newClone = null;

    // Case Avatar = true
    if(avatarOrUpload){
        // Save title avatar
        name_image_avatar.value = image_to_save;
        newClone = name_image_avatar.cloneNode(true);
    // Case Upload = false
    }else if(!avatarOrUpload){
        // Save upload file
        newClone = upload_img_field.cloneNode(true);
    // Case error = null
    }
    
    
    document.getElementById(id).style.display = "none";
    upload_img.appendChild(newClone);
}
function resetUploadAvatarContainer(){
    deseletcAvatars(avatars);
    btnSave.disabled = true;
}

function deselectImageUpload(){
    try{
        outupImage.src = default_img;
        imageInput.value = "";
    }catch{
        //
    }
    avatarOrUpload = null;
}
function deseletcAvatars(avatars){
    for(let i = 0; i < avatars.length; i++){
        avatars[i].classList.remove('selected-avatar');
    }
    image_to_save = null;
    avatarOrUpload = null;
}

function selectAvatar(image){
    deselectImageUpload();
    deseletcAvatars(avatars);
    image.classList.add('selected-avatar');
    avatar_selected = image.id;
    enableSaveBtn();
    image_to_save = image.id;
    ouput_src = image.src;
    avatarOrUpload = true;
}

var loadFile = function(event) {
    deseletcAvatars(avatars);
    enableSaveBtn();
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
    ouput_src = output.src;
    avatarOrUpload = false;
}

function pushOutImg(source){
    image_output.src = source;
}
function deleteClones(){
    let clones = upload_img.children;
    for(let i = 0; i < clones.length; i++){
        upload_img.removeChild(clones[i]);
    }
}
function enableSaveBtn(){
    btnSave.disabled = false;
}