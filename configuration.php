<?php
// Définition des informations de connexion à la base de données
define('HOST', '192.168.1.129');
define('PORT', '3306');
define('DBNAME', '');
define('CHARSET', 'utf-8');
define('LOGIN', '');
define('PASSWORD', '');

// Ajout des fichiers nécessaire au bon fonctionnement du site
include_once 'class/database.php';
//include_once 'models/users.php';