# Directorio /src/www/php #
En este directorio van los ficheros "tradicionales" de PHP.
Este directorio require el fichero .htaccess (oculto) para garantizar las redirecciones al api.
Si el modelo de programación es "tradicional":
- index.php actua como controlador principal (router.
- /src/www/php/controladores albertará otros controladores.
- /src/www/php/vistas albergará las vistas de la aplicación.
- /src/www/php/vistas/html albergará las vistas html de la aplicación.
- /src/www/php/vistas/recursos albergará los recursos de las vistas de la aplicación (imágenes, audio, vídeos, descargas...).
- /src/www/php/vistas/css albergará los ficheros de estilo de las vistas aplicación.
- /src/www/php/vistas/js albergará los ficheros de lógica de cliente de las vistas aplicación.
- /src/www/php/modelos albergará los modelos de la aplicación.
