<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./profile.css">
    <title>Profil</title>
</head>
<body>
    <?php
    session_start();
    include('connexion_bd.php');

    $pseudo = $_SESSION['pseudo'];

    // Récupérer l'ID de l'avatar lié au compte de l'utilisateur actuel
    $requete_avatar_user = "SELECT avatar_id FROM utilisateurs WHERE pseudo = '$pseudo'";
    $resultat_avatar_user = $connexion->query($requete_avatar_user);

    if ($resultat_avatar_user && $resultat_avatar_user->num_rows > 0) {
        $row_avatar_user = $resultat_avatar_user->fetch_assoc();
        $id_avatar_user = $row_avatar_user['avatar_id'];

        // Utiliser l'ID de l'avatar pour récupérer le nom de l'avatar
        $requete_avatar = "SELECT nom_avatar FROM avatars WHERE id = $id_avatar_user";
        $resultat_avatar = $connexion->query($requete_avatar);

        if ($resultat_avatar && $resultat_avatar->num_rows > 0) {
            $row_avatar = $resultat_avatar->fetch_assoc();
            $nom_avatar_base64 = $row_avatar['nom_avatar'];

            echo "<img src='$nom_avatar_base64' alt='Avatar' class='avatar-profil'>";
        }
    }
    ?>

    <div class="profile-content">
        <?php
            echo "<h2>Bienvenue sur votre profil, $pseudo !</h2>";
        ?>
        
        <form action="traitement_modification_pseudo.php" method="post">
            <label for="nouveau_pseudo">Pseudo :</label><br>
            <input type="text" id="nouveau_pseudo" name="nouveau_pseudo" required>
            <button type="submit">Modifier Pseudo</button>
        </form>

        <form action="traitement_suppression_pseudo.php" method="post">
            <button type="submit">Supprimer Mon Compte</button>
        </form>
    </div>

</body>
</html>
