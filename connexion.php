<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./connexion.css">
    <title>Connexion</title>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="traitement_connexion.php" method="post">
        <h3>Connexion</h3>

        <label for="username">Email</label>
        <input type="text" placeholder="Email" id="username" name="email" required>

        <label for="password">Mot de passe</label>
        <input type="password" placeholder="Mot de passe" id="password" name="mot_de_passe" required>

        <button type="submit">Se connecter</button>
        <h5>Pas de compte ?</h5><a href="inscription.php"><h5>S'inscrire</h5></a>
    </form>
</body>
</html>