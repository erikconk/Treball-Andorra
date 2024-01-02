<nav id="navBar">
    <div class="navBar-container">
        <div class="navBar-item click">
            <div id="menu" class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
        </div>
        <div id="logo" class="navBar-item click">
            <img class="logo-img" alt="logo" src="<?php echo constant('URL');?>/public/icons/logo.png">
        </div>
        <div id="user" class="navBar-item click">
            <?php if(isset($_SESSION['user_alias']) && isset($_SESSION['is_login'])){?>
                <div class="user-img-frame">
                    <img class="user-img" src="<?php echo constant('AVATARS'); echo $_SESSION['user_avatar'] ?>" alt="usuari-icon"> 
                </div>
            <?php }else { ?>
                <div class="user-img-frame">
                    <img class="user-img" src="<?php echo constant('URL');?>/public/icons/user.png" alt="usuari-icon">           
                </div>
            <?php } ?>
        
        </div>
    </div>
</nav>

<div id="mainMenu-container" class="mainMenu-container">
    <div class="main-menu">
        <p><a href="#">Mercat de treball</a></p>
        <p><a href="#">Mercat de serveis</a></p>
        <p><a href="#">Empreses</a></p>
    </div>
</div>
<div id="userMenu-container" class="userMenu-container">
    <div class="user-menu">
        <p class="welcome-user">Hola,<br><strong>
            <?php 
            if(isset($_SESSION['user_alias']) && isset($_SESSION['is_login'])){
                echo $_SESSION['user_alias'];
            }else{
                echo "usuari anònim";
            }?>
        </strong>
        </p>
    </div>
    <div class="user-menu">
        <?php 
            if(isset($_SESSION['is_login'])){?>
                <p class="user-menu-item"><a href="<?php echo constant('URL');?>/dash_board">Panell de control</a></p>
                <p class="user-menu-item"><a href="<?php echo constant('URL');?>/dash_board/profile">Perfil</a></p>
                <p class="user-menu-item"><a href="<?php echo constant('URL');?>/dash_board/config">Configuració</a></p>
                <p class="user-menu-item"><a href="<?php echo constant('URL');?>/login/logout">Tancar sessió</a></p>
            <?php }else{ ?>

                <p class="user-menu-item"><a href="<?php echo constant('URL');?>/login">Iniciar sessió</a></p>
                <p class="user-menu-item"><a href="<?php echo constant('URL');?>/new_acount">Crear un compte</a></p>
        <?php  } ?>
        
    </div>
</div>
