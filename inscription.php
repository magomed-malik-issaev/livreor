<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO utilisateurs (login, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $login, $hashed_password);
        $stmt->execute();
        $stmt->close();
        header('Location: connexion.php');
    } else {
        echo 'Les mots de passe ne correspondent pas.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Livre d'or</title>
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
        <h1>Inscription</h1>
        <form action="inscription.php" method="POST">
            <label for="login">Nom d'utilisateur :</label>
            <input type="text" id="login" name="login" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <button type="submit">S'inscrire</button>
        </form>
    </main>
</body>
</html>
