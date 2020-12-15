# DDQ-Exercise-Looper
## Windows
### Installation avec Laragon
#### Prérequis
- Laragon
- Git
- Editeur de texte

#### Téléchargement

Dans le dossier **www** de Laragon qui se trouve par défaut dans **C:\laragon\www**, effectuez la commande suivante :
```bash
git clone https://github.com/CPNV-ES/DDQ-Exercise-Looper.git
```

#### Configuration de l'hôte virtuel

Lancez Laragon en cliquant sur **Start**, Puis cliquez sur **Stop**. Cela va créer un fichier de configuration dans **C:\Laragon\etc\apache2\sites-enabled** appelé **auto.DDQ-Exercise-Looper.test.conf**

Ensuite, ajoutez au fichier les lignes suivantes :
```conf
<VirtualHost *:80> 
    DocumentRoot "D:/Laragon/www/DDQ-Exercise-Looper/src/public"
    ServerName DDQ-Exercise-Looper.test
    ServerAlias *.DDQ-Exercise-Looper.test
    <Directory "D:/Laragon/www/DDQ-Exercise-Looper/">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Installation de Sass

Afin de pouvoir compiler les fichiers .scss en .css l'installation de Sass est nécessaire :
```bash
npm install -g sass
```

Une fois installé, lancez la commande suivante pour compiler le .scss
```
sass src/ressources/scss/main.scss src/public/main.css
```

#### Accéder au site

Démarrez Laragon, lancez un navigateur puis entrez l'adresse suivante :
```url
http://ddq-exercise-looper.test/
```