<?php $_SESSION['token'] = md5(uniqid(mt_rand(), true)); ?>
<div class="form-element-fit">
    <div class="forms-head">
        <h1 class="fh-title">Login</h1>
    </div>
    <div class="forms-content">
        <div class="fc-single">
            <form method="POST" action="<?php echo constant('URL') ?>/login/authenticate">      
            <?php if(isset($this->args['error_login'])){?>
                    <div class="error-container">
                        <p><?php echo $this->args['error_login'];?></p>
                    </div>
                    
                <?php }; ?>
                <input type="hidden" name="token" id="csrf_token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <div class="single-text-input-icon">
                    <img src="<?php echo constant('URL');?>/public/icons/email.png" alt="mail-icon">
                    <input type="email" placeholder="Correu electrònic" name="user_email" required
                    <?php if(isset($this->args['error_email'])){?>
                        value="<?php echo $this->args['error_email']; ?>"
                    <?php }; ?>
                    >
                </div>
                <div class="single-text-input-icon">
                    <img src="<?php echo constant('URL');?>/public/icons/password.png" alt="mail-icon">
                    <input type="password" placeholder="Contrasenya" name="user_key" required
                    <?php if(isset($this->args['error_key'])){?>
                        value="<?php echo $this->args['error_key']; ?>"
                    <?php }; ?>
                    >
                </div>
                <div class="submit-input click">
                    <button id="login-btn" type="submit">Aceptar</button>
                </div>
            </form>
            <a class="link" href="#">Has olvidat la teva contrasenya?</a>
        </div>
    </div>
</div>