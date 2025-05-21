<?php
// Connexion sécurisée à la base de données avec PDO(PHP Data Objects)
$db = new PDO('mysql:host=localhost;dbname=viedece;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Démarre la session pour pouvoir stocker les pseudos entre les pages
session_start();
?>