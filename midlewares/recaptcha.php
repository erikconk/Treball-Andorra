<?php
    function recaptchaValid(){
        $captcha = [];

        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            $secret = '6LdLa1IoAAAAAGe1iBfBYJj1nN5Psf39Dj4DcWnC';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if($responseData->success || $result !== true){
                return True;
            }else{
                $captcha = "La verificació de robot ha caducat. Si us plau, esperi un màxim de 2 minuts sense tancar la pàgina fins que torni a demanar-li la verificació de robot.";
                return [ "succes" => False, "getMessage" => $captcha];
            }
        }else{
            $captcha = "Si us plau, fes clic en la verificació de robot.";
            return [ "succes" => False, "getMessage" => $captcha];
        }
    }
?>