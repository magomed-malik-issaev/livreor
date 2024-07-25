<?php
session_start();
include 'config.php';

$query = 'SELECT commentaires.commentaire, commentaires.date, utilisateurs.login 
          FROM commentaires 
          JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id 
          ORDER BY commentaires.date DESC';
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="livre-or.php">Livre d'or</a></li>
                <?php if (isset($_SESSION['id'])): ?>
                    <li><a href="commentaire.php">Ajouter un commentaire</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main


