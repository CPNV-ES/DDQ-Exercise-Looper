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

#### Accéder au site

Lancez un navigateur puis entrez l'adresse suivante :
```url
http://ddq-exercise-looper.test/
```