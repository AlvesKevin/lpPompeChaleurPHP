<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=fhcn0606_laboiteajeu;charset=utf8', 'fhcn0606', 'fMeE-5GqV-k3k@');
} catch (Exception $e) {
    die('Erreur' . $e->getMessage());
}

