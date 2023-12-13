<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="./connexion.css">
    <link rel="stylesheet" href="./inscription.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="traitement_inscription.php" method="post">
        <h3>Inscritpion</h3>

        <label for="username">Email</label>
        <input type="text" placeholder="Email" id="username" name="email" required>

        <label for="password">Pseudo</label>
        <input type="text" placeholder="Pseudo" id="pseudo" name="pseudo" required>

        <label for="password">Mot de passe</label>
        <input type="password" placeholder="Mot de passe" id="password" name="mot_de_passe" required>

        <button type="submit">S'inscrire</button>
        <h5>Déjà inscrit ?</h5><a href="connexion.php"><h5>Se connecter</h5></a>
    </form>
</body>
</html>
