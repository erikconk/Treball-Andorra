<?php $_SESSION['token'] = md5(uniqid(mt_rand(), true)); ?>
<form action="" method="post" id=newAcountForm>
    <div class="form-element">
        <div class="forms-head">
            <h1 class="fh-title">Crear un compte</h1>
            <p class="fh-subtitle">
                Selecciona quin tipus de perfil vols crear:
            </p>
        </div>
        <input type="hidden" name="token" id="csrf_token" value="<?php echo $_SESSION['token'] ?? '' ?>">
        <div class="forms-content">
            <div class="fc-doubles">
                <div class="fc-doubles-inputs">
                    <div class="input-radio-container" onclick="handle_description('text-1')">
                        <input class="user_type" type="radio" name="perfil" id="empresa" value="Empresa">
                        <label for="empresa">Empresa</label>
                    </div>
                    <div class="input-radio-container">
                        <input class="user_type" type="radio" name="perfil" id="freelance" value="Freelance"  onclick="handle_description('text-2')">
                        <label for="freelance">Freelance</label>
                    </div>
                    <div class="input-radio-container" onclick="handle_description('text-3')">
                        <input class="user_type" type="radio" name="perfil" id="colaborador" value="Col·laborador" >
                        <label for="colaborador">Col·laborador</label>
                    </div>
                </div>
                <div class="fc-doubles-text" id="text-description">
                    <div class="fc-hiden-text"  id="text-1">
                        <p>
                            Crear un perfil empresarial i puja els teus anuncis de feina de forma gratuïta. Perfil ideal per si tens una empresa o gestiones els recursos humans d'aquesta.
                        </p>
                    </div>
                    <div class="fc-hiden-text" id="text-2">
                        <p>
                            Vols oferir els teus serveis com a freelance? Anunciat de forma gratuïta i fes-te conèixer. Perfil ideal per oferir els teus serveis.
                        </p>
                    </div>
                    <div class="fc-hiden-text" id="text-3">
                        <p>
                            Col·labora amb nosaltres i puja anuncis de feina puntuals com a col·laborador de forma gratuïta. Perfil ideal per donar a conèixer ofertes de treball.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="forms-nav">
            <button type="button" class="fn-btn fn-rigth click" disabled id="form-1" onclick="change_page('next')">
                Següent
            </button>
        </div>
    </div>

    <div class="form-element">
        <div class="forms-head">
            <h1 class="fh-title">Crear un compte</h1>
            <p class="fh-subtitle">
                Ingressi un correu electrònic vàlid i crea una nova contrasenya:
            </p>
        </div>
        <div class="forms-content">
            <div class="fc-single">
                <div>
                    <div class="single-text-input-icon">
                        <img src="<?php echo constant('URL');?>/public/icons/email.png" alt="email-icon" >
                        <input type="email" name="user_email" id="user_mail" placeholder="Correu electrònic" required onkeyup="validate_input('user_mail')">
                    </div>
                    <div class="single-text-input-icon">
                        <img src="<?php echo constant('URL');?>/public/icons/password.png" alt="password-icon" >
                        <input type="password" name="user_key" id="user_key" placeholder="Contrasenya (min. 8 caràcters)" required onkeyup="validate_input('user_key')">
                    </div>
                    <!--
                    <div class="single-text-input-icon">
                        <img src="<?php echo constant('URL');?>/public/icons/password.png" alt="password-icon" >
                        <input type="password" name="user_key_repeat" id="user_key_repeat" placeholder="Repeteixi la contrasenya" required onkeyup="validate_input('user_key_repeat')">
                    </div>
                    -->
                </div>
                <div class="fc-errors" id="error-mail">

                </div>
            </div>
        </div>
        <div class="forms-nav">
            <button type="button" onclick="change_page('back')" class="fn-btn fn-left click">
                Enrrere
            </button>
            <button type="button" onclick="change_page('next')" class="fn-btn fn-rigth click" disabled id="netx-if-is-valid">
                Següent
            </button>
        </div>
    </div>

    <div class="form-element">
        <div class="forms-head">
            <h1 class="fh-title">Crear un compte</h1>
            <p class="fh-subtitle">
                Llegeix la nostra política de privacitat de dades
            </p>
        </div>
        <div class="privaci-text">
                <?php echo file_get_contents(URL . '/public/documents/politica-de-privacitat.html'); ?>
        </div>
        <div class="account-check-input">
            <input class="click" type="checkbox" name="accept" id="accept-disclaimer" onclick="accept_for_next(this)">
            <label for="accept-disclaimer">Accepto la Política de privacitat de dades.</label>
        </div>
        <div class="forms-nav">
            <button type="button" onclick="change_page('back')" class="fn-btn fn-left click">
                Enrrere
            </button>
            <button type="button" onclick="submit_newAcount()" class="fn-btn fn-rigth click" disabled id="netx-if-is-valid-2">
                Següent
            </button>
        </div>
    </div>

    <div class="form-element">
        <div class="forms-head">
            <h1 class="fh-title">Crear un compte</h1>
            <p class="fh-subtitle">
                Processant les seves dades. 
                <br>
                <strong>No refresqui la pàgina, si us plau.</strong>
            </p>
        </div>
        <div class="forms-content center" id="error_or_load">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>

    <div class="form-element">
        <div class="forms-head">
            <h1 class="fh-title">Crear un compte</h1>
            <p class="fh-subtitle">
                Finalitzat. 
            </p>
        </div>
        <div class="forms-content center">
            <div>
                <p id="submit_status" class="alert-messages">
                </p>
            </div>
        </div>
        <div class="forms-nav">
            <button type="button" onclick="redirect('/')" class="fn-btn fn-rigth click" id="netx-if-is-valid-2">
                Finalitzar
            </button>
        </div>
    </div>
</form>
