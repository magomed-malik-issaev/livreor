<?php
session_start();
include 'config.php';

if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare('UPDATE utilisateurs SET login = ?, password = ? WHERE id = ?');
    $stmt->bind_param('ssi', $login, $hashed_password, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

    $_SESSION['login'] = $login;
    echo 'Profil mis à jour.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil - Livre d'or</title>
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
        <h1>Modifier le profil</h1>
        <form action="profil.php" method="POST">
            <label for="login">Nom d'utilisateur :</label>
            <input type="text" id="login" name="login" value="<?php echo $_SESSION['login']; ?>" required>
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Mettre à jour</button>
        </form>
    </main>
</body>
</html>
