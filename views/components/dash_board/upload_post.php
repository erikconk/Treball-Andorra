<div id="upload-avatar-front-view" class="front-view">
    <div class="fw-center-container">
        <div class="uf-content">
            <div class="uf-title">
                <p>Selecciona una imatge descriptiva</p>
            </div>
            <div id="defaults-avatar-container" class="ufc-images-container-post">
                <?php 
                    $dir = "min/";
                    $avatar_defaults = array_values(array_diff(scandir(POST_DEFAULT), array('..', '.')));
    
                    foreach($avatar_defaults as $avatar){
                ?>
                    <img class="click fv-select"
                        src="<?php echo constant('POST'); echo 'min/' . $avatar;?>" id="<?php echo $dir; echo $avatar; ?>"
                        onclick="selectAvatar(this)"    
                    >    
                <?php }?>
                <input type="hidden" id="user_avatar_field" name="anuncio_imagen">
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
