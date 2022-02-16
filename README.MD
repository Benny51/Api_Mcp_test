https://phprouter.com/

RewriteEngine on --> On enable le système d'écriture d'url

RewriteCond %{REQUEST_FILENAME} !-f  --> Fichier demandé -f si le fichier n'existe pas
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L] --> on réecrit tout et on redirige vers index.php --> $1 pour mettre en paramètre 
--> qsa permet de transvaser les variables qui serait passée en get et L car c'est le dernier URL

