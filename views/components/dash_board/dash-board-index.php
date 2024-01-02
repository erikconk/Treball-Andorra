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
            <p>Panell de control</p>
        </div>      
    </div>
    <div class="db-content">
        <a class="btn-a" href="/dash_board/new_post"><span style="font-size: 1rem;">+</span> Afegir nou anunci</a>
    </div>
    <div class="db-content">
        <div class="dbc-submenu">
            <div class="dbc-submenu-title">
                <p>El meus anuncis</p>
            </div>
            <div class="dbc-submenu-content">
                <div class="dbc-anuncios-admin-head">
                    <p>
                        Referència
                    </p>
                    <p>
                        Treball
                    </p>
                    <p>
                        Categoria
                    </p>
                    <p>
                        Data de publicació
                    </p>
                    <p>
                        Operacions
                    </p>
                </div>
                <section id="posts-container" class="dbc-anuncios-admin">
                    <?php if(isset($this->args['anuncios']) && !empty($this->args['anuncios'])) { ?>
                        <?php foreach($this->args['anuncios'] as $anuncio) { ?>
                            <article id="post-<?php echo $anuncio['anuncio_id'];?>">
                                <p>
                                    <?php echo $anuncio['anuncio_id']; ?>
                                </p>
                                <p>
                                    <?php echo $anuncio['anuncio_vacante']; ?>
                                </p>
                                <p>
                                    <?php echo $anuncio['categoria_name']; ?>
                                </p>
                                <p>
                                    <?php echo date("d-m-Y", strtotime($anuncio['anuncio_creado'])); ?>
                                </p>
                                <p class="anuncios-edit-field">
                                    <a href="/dash_board/edit_post/<?php echo $anuncio['anuncio_id'];?>">✏️</a>
                                    <span id="<?php echo $anuncio['anuncio_id'];?>" onclick="openDialog(this)">❌</span>
                                    <span>
                                        <input class="click" type="checkbox" name="<?php echo $anuncio['anuncio_id']; ?>" onclick="selectSwitch(this, 'post-<?php echo $anuncio['anuncio_id'];?>')">
                                    </span>                             
                                </p>
                            </article>
                        <?php } ?>
                    <?php } else{ ?>
                        <p class="msg-empty">
                        No hi ha cap anunci per mostrar.
                        </p>
                    <?php } ?>                   
                </section>
                <dialog id="delete_post_dialog"> 
                    <form id="delete_post_form" method="POST" action="/dash_board">
                        <input type="hidden" name="form_action" value="delete_post">
                        <input id="anuncio" type="hidden" name="anuncio_id" >
                        <span class="nm-close click" onclick="closeDialog()">✖️</span>
                        <h3>Eliminar</h3>
                        <p><strong>Està segur què desitja eliminar el seu anunci?</strong></p>
                        <p> Ingressi la seva contrasenya per eliminar-lo, si us plau.</p>
                        <input id="delete_post_input" class="d-input" type="password" placeholder="Contrasenya" onkeyup="unlockPost(this)" name="user_key"/>
                        <input id="delete_post_submit" class="d-submit nm-rigth" type="submit" value="Eliminar" disabled/>
                    </form>
                </dialog> 
                <div class="dbc-anuncios-admin-footer">
                    <div class="dbc-anuncios-admin-footer-insider">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div class="dbc-control">
                            <div></div>
                            <span class="click" id="eliminar" onclick="openDialog2(this)">❌</span>
                            <div>
                                <input class="click"  type="checkbox" id="checkbox" onclick="selectAllSwitch(this)">
                            </div>
                        </div>
                    </div>
                </div>
                <dialog id="delete_multiple_post_dialog"> 
                    <form id="delete_post_form_2" method="POST" action="/dash_board">
                        <input type="hidden" name="form_action" value="delete_multiple_post">
                        <input id="anuncios" type="hidden" name="anuncios_id" >
                        <span class="nm-close click" onclick="closeDialog2()">✖️</span>
                        <h3>Eliminar</h3>
                        <p><strong>Està segur què desitja eliminar el anuncis seleccionats?</strong></p>
                        <p> Ingressi la seva contrasenya per eliminar-lo, si us plau.</p>
                        <input id="delete_post_input_2" class="d-input" type="password" placeholder="Contrasenya" onkeyup="unlockPost2(this)" name="user_key"/>
                        <input id="delete_post_submit_2" class="d-submit nm-rigth" type="submit" value="Eliminar" disabled/>
                    </form>
                </dialog> 
            </div>
        </div>
    </div>
