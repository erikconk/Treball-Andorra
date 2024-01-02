<div class="dash-board-container">
    <div class="db-head">
        <div>
            <p>Perfil</p>
        </div>      
    </div>
    <div class="db-content">
        <?php 
        if(isset($this->args['message'])){?>
            <div class="<?php if($this->args['action'] == true){
                echo "succes-container";
            }else{
                echo "error-container";
            }
            ?>
            ">
                <p><?php echo $this->args['message'];?></p>
            </div>
        <?php } ?>  
        <div class="dbc-submenu">
            <div class="dbc-submenu-title">
                <p>Dades del perfil</p>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="action" name="action" value="profile">
            <div class="dbc-submenu-content">
                        <div class="dbc-submenu-content-img">
                            <label for="user_avatar">Avatar</label>
                            <div class="image-container centered-flex">
                                <img class="avatar-img" id="image_output" src="<?php echo constant('AVATARS'); echo $_SESSION['user_avatar'];?>" alt="avatar">
                            </div>
                            <p onclick="openFrontView(['upload-avatar-front-view', 'Block'])" class="click link"> Cambiar</p>
                        </div>
                        <div class="dbc-submenu-content-input">
                        <div style="width: 1px; opacity:0; height: 1px;" id="hidden_img_avatar_upload">
                        </div>      
                        <label for="user_alias">Alias</label>
                            <input id="user_alias" name="user_alias" type="text" value="<?php echo $_SESSION['user_alias'];?>" disabled  maxlength="20">
                            <p onclick="enable(this, ['user_alias'])" class="click link">🔒 Cambiar</p>
                    </div>
                    <div class="dbc-submenu-content-input">
                        <label for="user_email">Correu electrònic</label>
                            <input id="user_email" name="user_email" type="email" value="<?php echo $_SESSION['user_email'];?>" disabled  maxlength="50">
                            <p onclick="enable(this, ['user_email'])" class="click link">🔒 Cambiar</p>
                    </div>
                    <div class="dbc-submenu-content-submit">
                        <input class="click" type="submit" value="Guardar">
                    </div>
                </div>
            </form>
        </div>
        <div class="dbc-submenu">
            <div class="dbc-submenu-title">
                <p>Canviar contrasenya</p>
            </div>
            <form action="" method="POST">
            <input type="hidden" class="action" name="action" value="key">
                <div class="dbc-submenu-content">
                    <div>
                        <p onclick="enable(this, ['user_old_key', 'user_key'])" class="click link">🔒 Cambiar</p>
                    </div>
                    <div class="dbc-submenu-content-input">
                        <label for="user_old_key">Antiga contrasenya</label>
                        <input id="user_old_key" name="user_old_key" type="password" disabled>
                    </div>
                    <div class="dbc-submenu-content-input">
                        <label for="user_key">Nova contrasenya</label>
                        <input id="user_key" name="user_key" type="password" disabled>
                    </div>
                    <div>
                    <div class="dbc-submenu-content-submit">
                            <input class="click" type="submit" value="Guardar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="dbc-submenu">
            <div class="dbc-submenu-title">
                <p>Donar-se de baixa</p>
            </div>
            <div class="dbc-submenu-content">

            </div>
        </div>
        
    </div>
</div>