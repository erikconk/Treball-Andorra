<div id="upload-avatar-front-view" class="front-view">
    <div class="fw-center-container">
        <div class="uf-content">
            <div class="uf-title">
                <p>Selecciona un avatar</p>
            </div>
            <div id="defaults-avatar-container" class="ufc-images-container">
                <?php 
                    $dir = "defaults/";
                    $avatar_defaults = array_values(array_diff(scandir(AVATARS_DEFAULT), array('..', '.')));
    
                    foreach($avatar_defaults as $avatar){
                ?>
                    <img class="click fv-select" 
                        src="<?php echo constant('AVATARS'); echo 'defaults/' . $avatar;?>" id="<?php echo $dir; echo $avatar; ?>"
                        onclick="selectAvatar(this)"    
                    >    
                <?php }?>
                <input type="hidden" id="user_avatar_field" name="user_avatar">
            </div>
        </div>
        <div class="uf-content">
            <div class="uf-title">
                <p>O puja el teu propi avatar/logo</p>
            </div>
            <div class="uf-input-image">
                <img id="output" src="<?php echo constant('URL');?>/public/icons/photo.png"/>
                <input id="imageAvatarInput" type="file" name="user_avatar_image" accept="image/png, image/gif, image/jpeg" onchange="loadFile(event)" class="click"/>
            </div>
        </div>
        <div class="forms-nav">
            <button onclick="closeFrontView('upload-avatar-front-view')" type="button" class="fn-btn fn-left click">
                Cancel·lar
            </button>
            <button id="btnSaveUploadAvatar" type="button" onclick="save('upload-avatar-front-view')" class="fn-btn fn-rigth click" disabled id="netx-if-is-valid">
                Aceptar
            </button>
        </div>
    </div>
</div>
