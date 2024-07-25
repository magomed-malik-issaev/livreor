<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentaire = $_POST['commentaire'];
    $id_utilisateur = $_SESSION['id'];
    $date = date('Y-m-d H:i:s');

    $conn = new mysqli('localhost', 'root', '', 'livreor');
    $stmt = $conn->prepare('INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?, ?, ?)');
    $stmt->bind_param('sis', $commentaire, $id_utilisateur, $date);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header('Location: livre-or.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un commentaire</title>
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
            </ul>
        </nav>
    </header>
    <main>
        <h1>Ajouter un commentaire</h1>
        <form action="commentaire.php" method="POST">
            <label for="commentaire">Commentaire :</label>
            <textarea id="commentaire" name="commentaire" required></textarea>
            <button type="submit">Poster</button>
        </form>
    </main>
</body>
</html>
