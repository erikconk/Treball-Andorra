# Punto de entrada de la App
La entrada de la aplicacio empieza con el archivo **index.php** en el directorio **root** del proyecto. 

Cada peticion a pagina web, debe ser procesada por **index.php**, ya que asi esta configurado en el archivo **.htaccess** del servidor Appache.

## Index
El archivo **index.php** trata de cargar la configuracion de nuestra aplicacion "**config.php**":
- / config
  - config.php

Tambien cargar las librerias del *framework*:
- / libs
  - session.php
  - database.php
  - view.php
  - model.php
  - controller.php
  - [app.php](#app) 

Después, instancia un nuevo objeto llamado **app** de la libreria.

## App
El archivo **app.php** empieza requeriendo *Middlewares* relacionados con la seguridad de la aplicacion:
- / midlewares
  - ip_blocker.php
  - bot_blocker.php

La logica del constructor de *App* es inicializar los *middlewares*, luego segmentar la URL para inicializar un controlador.
