<?php 
        if(isset($this->args['message'])){?>
            <div id="message" class="<?php if($this->args['action'] == true){
                echo "succes-container";
            }else{
                echo "error-container";
            }
            ?>
            ">
                <p><?php echo $this->args['message'];?></p>
            </div>
        <?php } ?> 
<div class="dash-board-container">
    <div class="db-head">
        <div>
            <p>Nou anunci</p>
        </div>      
    </div>
    <form method="POST" action="">
    <div class="db-content">
        <div class="dbc-submenu">
            <div class="dbc-submenu-title">
                <p>Imatge</p>
            </div>
            <div class="dbc-submenu-content">
                <div class="dbc-submenu-content-img">
                    <label for="user_avatar">Imatge descriptiva</label>
                    <div class="anuncio-img-container">
                        <img 
                            id="image_output" 
                            class="anuncio-img" 
                            <?php if(isset($this->args['data_post']['anuncio_imagen'])){
                                echo 'src=' . constant('POST') . $this->args['data_post']['anuncio_imagen'];
                            }else{
                                echo 'src=' . constant('POST') . '/min/default-0.jpg';
                            }
                            ?>
                            alt="avatar">
                    </div>
                    <p onclick="openFrontView(['upload-avatar-front-view', 'Block'])" class="click link">Cambiar</p>
                    </div>
                    <div style="width: 1px; opacity:0; height: 1px;" id="hidden_img_avatar_upload">
                        <input 
                            type="hidden" 
                            id="user_avatar_field" 
                            name="anuncio_imagen" 
                            <?php if(isset($this->args['data_post']['anuncio_imagen'])){
                                echo 'value=' . $this->args['data_post']['anuncio_imagen'];
                            }else{
                                echo 'value="min/default-0.jpg"';
                            } 
                            ?>
                            >
                    </div> 
                </div>
        </div>

        <div class="dbc-submenu">
            <div class="dbc-submenu-title">
                <p>Tipus de fiena</p>
            </div>
            <div class="dbc-submenu-content">
                <div class="dbc-submenu-content-input">
                    <label for="anuncio_sector">Sector de treball</label>
                    <select id="anuncio_sector" name="anuncio_sector" required>
                        <option value="">Selecciona una categoría...</option>
                        <?php foreach($this->args['categorias'] as $categoria) { 
                            if(isset($this->args['data_post']['anuncio_sector']) && $this->args['data_post']['anuncio_sector'] == $categoria['categoria_id']){
                                echo '<option value="' . $categoria['categoria_id'] . '" selected >' . $categoria['categoria_name'] . '</option>';
                            }else{
                                echo '<option value="' . $categoria['categoria_id'] . '">' . $categoria['categoria_name'] . '</option>';
                            }
                        } ?>
                    </select>
                </div>
                <div class="dbc-submenu-content-input">
                    <label for="anuncio_vacante">Tipus de vacant</label>
                    <input 
                        tipe="anuncio_vacante" 
                        id="anuncio_vacante" 
                        name="anuncio_vacante" 
                        placeholder="Caixer/a, comptable, mecànic d'automòbils..." 
                        maxlength="50" 
                        value="<?php if(isset($this->args['data_post']['anuncio_vacante'])) echo htmlspecialchars($this->args['data_post']['anuncio_vacante'], ENT_QUOTES, 'UTF-8');?>"
                        required>
                   
                </div>
            </div>
        </div>

        <div class="dbc-submenu">
            <div class="dbc-submenu-title">
                <p>Descripció de la feina</p>
            </div>
            <div class="dbc-submenu-content">
                    <div class="dbc-submenu-content-input">
                        <label for="anuncio_descripcion">Descripció de la vacant</label>
                        <textarea 
                            id="anuncio_descripcion" 
                            name="anuncio_descripcion" 
                            type="text" 
                            maxlength="500" 
                            rows="10" 
                            required><?php if(isset($this->args['data_post']['anuncio_descripcion'])) echo $this->args['data_post']['anuncio_descripcion'];?></textarea>
                        <p id="counter">0/500</p>
                    </div>
                    <div class="dbc-submenu-content-input">
                        <label for="anuncio_sueldo">Sou mensual aproximat</label>
                        <input 
                            id="anuncio_sueldo" 
                            name="anuncio_sueldo" 
                            type="text" 
                            placeholder="Escriure solament la xifra sense el símbol d'euro." 
                            <?php if(isset($this->args['data_post']['anuncio_sueldo'])) echo 'value=' . $this->args['data_post']['anuncio_sueldo'];?>
                            maxlength="20">
                    </div>
                    <div class="dbc-submenu-content-input">
                        <label for="anuncio_ubicacion">Ubicació del lloc de treball</label>
                        <select id="anuncio_ubicacion" name="anuncio_ubicacion" required>
                            <option value="">Seleccioni una parròquia...</option>
                            <?php foreach($this->args['ubicacion'] as $ubicacion) { 
                                if(isset($this->args['data_post']['anuncio_ubicacion']) && $this->args['data_post']['anuncio_ubicacion'] == $ubicacion['ubicacion_id']){
                                    echo '<option value="' . $ubicacion['ubicacion_id'] . '" selected >' . $ubicacion['ubicacion_name'] . '</option>';
                                }else{
                                    echo '<option value="' . $ubicacion['ubicacion_id'] . '">' . $ubicacion['ubicacion_name'] . '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
        </div>

        <div class="dbc-submenu">
            <div class="dbc-submenu-title">
                <p>Característiques</p>
            </div>
            <div class="dbc-submenu-content">
                <div class="dbc-submenu-radio-container">
                    <div class="radio-selecttion-section">
                        <p>Contracte</p>
                        <div>
                            <div class="radio-container">
                                <input 
                                    id="anuncio_tag_contrato_1" 
                                    name="anuncio_tag_contrato" 
                                    type="radio" 
                                    <?php if(isset($this->args['data_post']['anuncio_tag_contrato']) && $this->args['data_post']['anuncio_tag_contrato'] == '1') echo 'checked';?>
                                    value="1">
                                <label for="anuncio_tag_contrato_1">Indefinit</label>
                            </div>
                            <div class="radio-container">
                                <input 
                                    id="anuncio_tag_contrato_2" 
                                    name="anuncio_tag_contrato" 
                                    type="radio" 
                                    <?php if(isset($this->args['data_post']['anuncio_tag_contrato']) && $this->args['data_post']['anuncio_tag_contrato'] == '2') echo 'checked';?>
                                    value="2">
                                <label for="anuncio_tag_contrato_2">Temporal</label>
                            </div>
                        </div>
                    </div>
                    <div class="radio-selecttion-section">
                        <p>Lloc de treball</p>
                        <div>
                            <input 
                                id="anuncio_tag_ubicacion_1" 
                                name="anuncio_tag_ubicacion" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_ubicacion']) && $this->args['data_post']['anuncio_tag_ubicacion'] == '3') echo 'checked';?>
                                value="3">
                            <label for="anuncio_tag_ubicacion_1">Presencial</label>
                            <br>
                            <input 
                                id="anuncio_tag_ubicacion_2" 
                                name="anuncio_tag_ubicacion" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_ubicacion']) && $this->args['data_post']['anuncio_tag_ubicacion'] == '4') echo 'checked';?>
                                value="4">
                            <label for="anuncio_tag_ubicacion_2">Teletreball</label>
                            <br>
                            <input 
                                id="anuncio_tag_ubicacion_3" 
                                name="anuncio_tag_ubicacion" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_ubicacion']) && $this->args['data_post']['anuncio_tag_ubicacion'] == '5') echo 'checked';?>
                                value="5">
                            <label for="anuncio_tag_ubicacion_3">Dinàmic</label>
                        </div>
                    </div>
                    <div class="radio-selecttion-section">
                        <p>Formació</p>
                        <div>
                            <input 
                                id="anuncio_tag_formacion_1" 
                                name="anuncio_tag_formacion" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_formacion']) && $this->args['data_post']['anuncio_tag_formacion'] == '6') echo 'checked';?>
                                value="6">
                            <label for="anuncio_tag_formacion_1">A càrrec de l'empresa</label>
                        </div>
                        <div>
                            <input 
                                id="anuncio_tag_formacion_2" 
                                name="anuncio_tag_formacion" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_formacion']) && $this->args['data_post']['anuncio_tag_formacion'] == '12') echo 'checked';?>
                                value="12">
                            <label for="anuncio_tag_formacion_2">Es requereix estudis acadèmics</label>
                        </div>
                        <div>
                            <input 
                                id="anuncio_tag_formacion_3" 
                                name="anuncio_tag_formacion" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_formacion']) && $this->args['data_post']['anuncio_tag_formacion'] == '13') echo 'checked';?>
                                value="13">
                            <label for="anuncio_tag_formacion_3">Es requereix experiència</label>
                        </div>
                        <div>
                            <input 
                                id="anuncio_tag_formacion_4" 
                                name="anuncio_tag_formacion" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_formacion']) && $this->args['data_post']['anuncio_tag_formacion'] == '14') echo 'checked';?>
                                value="14">
                            <label for="anuncio_tag_formacion_4">No es requereix experiència</label>
                        </div>
                    </div>
                    <div class="radio-selecttion-section">
                        <p>Dies festius</p>
                        <div>
                            <input 
                                id="anuncio_tag_festivo_1" 
                                name="anuncio_tag_festivo" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_festivo']) && $this->args['data_post']['anuncio_tag_festivo'] == '7') echo 'checked';?>
                                value="7">
                            <label for="anuncio_tag_festivo_1">Caps de setmana</label>
                            <br>
                            <input 
                                id="anuncio_tag_festivo_2" 
                                name="anuncio_tag_festivo" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_festivo']) && $this->args['data_post']['anuncio_tag_festivo'] == '8') echo 'checked';?>
                                value="8">
                            <label for="anuncio_tag_festivo_2">Entre setmana</label>
                        </div>
                    </div>
                    <div class="radio-selecttion-section">
                        <p>Horari</p>
                        <div>
                            <input 
                                id="anuncio_tag_horario_1" 
                                name="anuncio_tag_horario" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_horario']) && $this->args['data_post']['anuncio_tag_horario'] == '9') echo 'checked';?>
                                value="9">
                            <label for="anuncio_tag_horario_1">Jornada completa</label>
                            <br>
                            <input 
                                id="anuncio_tag_horario_2" 
                                name="anuncio_tag_horario" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_horario']) && $this->args['data_post']['anuncio_tag_horario'] == '10') echo 'checked';?>
                                value="10">
                            <label for="anuncio_tag_horario_2">Mitja jornada</label>
                            <br>
                            <input 
                                id="anuncio_tag_horario_3" 
                                name="anuncio_tag_horario" 
                                type="radio" 
                                <?php if(isset($this->args['data_post']['anuncio_tag_horario']) && $this->args['data_post']['anuncio_tag_horario'] == '11') echo 'checked';?>
                                value="11">
                            <label for="anuncio_tag_horario_3">A hores</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dbc-submenu">
            <div class="dbc-submenu-content-submit">
                <input class="click" type="submit" value="Publicar">
            </div>
        </div>
    </div>
    </form>
</div>