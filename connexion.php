<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT id, password FROM utilisateurs WHERE login = ?');
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['id'] = $id;
        $_SESSION['login'] = $login;
        header('Location: profil.php');
    } else {
        echo 'Login ou mot de passe incorrect.';
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Livre d'or</title>
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
        <h1>Connexion</h1>
        <form action="connexion.php" method="POST">
            <label for="login">Nom d'utilisateur :</label>
            <input type="text" id="login" name="login" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
    </main>
</body>
</html>

