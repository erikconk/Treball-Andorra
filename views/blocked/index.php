<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error d'Accés</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            background-color: #000;
            color: #0f0;
            text-align: left;
            padding: 20px;
            margin: 0;
            position: relative;
            overflow: hidden;
            line-height: 1.5;
            background-image: repeating-linear-gradient(90deg, rgba(0, 15, 0, 0.5), rgba(0, 15, 0, 0.5) 1px, transparent 1px, transparent 10px);       
        }

        h1 {
            color: #0f0;
        }

        .window {
            border: 2px solid #0f0;
            padding: 10px;
            max-width: 600px;
            margin: 20px auto;
            position: relative;
            overflow: hidden;
        }

        .cursor::after {
            content: '';
            display: inline-block;
            width: 10px;
            height: 20px;
            background-color: #0f0;
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        #contact-btn {
            width: fit-content;
            border: 1px solid #0f0;
            color: #0f0;
            padding: 5px 10px;
            text-decoration: none;
            display: block;
            margin: 10px auto;
            text-align: center;
            transition: background-color 0.5s, color 0.5s;
        }

        #contact-btn:hover{
            background-color: #0f0;
            color: black;           
            transition: background-color 0.5s, color 0.5s;
        }

    </style>
</head>
<body>
    <div class="window">
        <h1>Error d'Accés</h1>
        <div class="cursor">
            <p>S'ha detectat una petició maliciosa per la seva part.</p>
            <p>Quedarà bloquejat de la nostra pàgina temporalment.</p>
            <p>Si es tracta d'un error, posi's en contacte amb nosaltres.</p>
        </div>
    </div>

    <a href="mailto:contacto@tuempresa.com" id="contact-btn">Contacta'ns</a>
</body>
</html>
