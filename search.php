<?php
session_start(); // Déplacez cette ligne vers le début du fichier
include('connexion_bd.php');

// Récupérer le pseudo de l'utilisateur actuel depuis la session
$pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="search.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar">
        <div class="search-container">
            <div class="buttons-nav">
                <a href="./accueil.php"><button class="button-nav">Accueil</button></a>
                <a href=""><button class="button-nav">Voir plus</button></a>
            </div>
            <div class="search-wrapper">
                <button id="search-button" onclick="toggleSearch()">
                    <img src="./assets/icons/icone-loupe-noir.png" alt="Search Icon" class="loupe">
                </button>
                <div>
                    <input type="text" id="search-input" name="title" placeholder="Rechercher..." class="hidden">
                    <button id="close-button" class="hidden" onclick="resetSearch()">
                        <img src="./assets/icons/croix-blanche.png" alt="Close Icon" class="croix">
                    </button>

                </div>
            </div>
        </div>

     <div class="avatar">
        <?php

        // Requête SQL avec une jointure pour récupérer l'ID de l'avatar de l'utilisateur
        $requete_avatar_user = "SELECT avatars.id, avatars.nom_avatar FROM utilisateurs
                        JOIN avatars ON utilisateurs.avatar_id = avatars.id
                        WHERE utilisateurs.pseudo = ?";

        $requete_preparee_avatar_user = $connexion->prepare($requete_avatar_user);
        $requete_preparee_avatar_user->bind_param("s", $pseudo);
        $requete_preparee_avatar_user->execute();
        $resultat_avatar_user = $requete_preparee_avatar_user->get_result();

        if ($resultat_avatar_user && $resultat_avatar_user->num_rows > 0) {
            $row_avatar_user = $resultat_avatar_user->fetch_assoc();
            $id_avatar = $row_avatar_user['id'];
            $nom_avatar_base64 = $row_avatar_user['nom_avatar'];

            echo "<a href='profile.php'><img src='$nom_avatar_base64' alt='Avatar' class='avatar'></a>";
        } else {
            // Gérer le cas où l'avatar n'est pas trouvé
            echo "Avatar non trouvé";
        }
        ?>
    </div>
    </nav>
    <?php
    include('connexion_bd.php');

    // Fonction pour obtenir le lien de la page du film en fonction de l'ID du film
    function getFilmPageLink($id_film)
    {
        return "film.php?id=$id_film";
    }

    if (isset($_GET['q'])) {
        $search_query = '%' . $_GET['q'] . '%';

        // Requête SQL pour rechercher les films
        $requete_recherche = "SELECT id_film, lien_affiche FROM films WHERE titre LIKE ?";
        $requete_preparee_recherche = $connexion->prepare($requete_recherche);
        $requete_preparee_recherche->bind_param("s", $search_query);
        $requete_preparee_recherche->execute();
        $resultat_recherche = $requete_preparee_recherche->get_result();

        if ($resultat_recherche && $resultat_recherche->num_rows > 0) {
            while ($row_recherche = $resultat_recherche->fetch_assoc()) {
                $id_film = $row_recherche['id_film'];
                $lien_affiche = $row_recherche['lien_affiche'];

                // Obtenez le lien de la page du film en utilisant la fonction
                $lien_page_film = getFilmPageLink($id_film);
    ?>
                <a href="<?php echo $lien_page_film; ?>" class="affiche">
                    <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                </a>
    <?php
            }
        } else {
            echo "Aucun résultat trouvé.";
        }
    }
    ?>


</body>
<script src="./index.js"></script>
 <script>
        // Sélectionner le lien qui a un attribut title contenant "000webhost.com"
        var lien = document.querySelector('a[title*="000webhost.com"]');

        // Vérifier si le lien existe et que l'attribut alt de l'image à l'intérieur est égal à "www.000webhost.com"
        if (lien && lien.querySelector('img').alt === "www.000webhost.com") {
            // Appliquer la propriété display: none; si l'attribut alt est présent
            lien.style.display = 'none';
        }
</script>
</html>