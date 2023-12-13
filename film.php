<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.14.3/video.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-contrib-hls@5.15.0/dist/videojs-contrib-hls.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./films.css">
    <title>Regarder la vidéo</title>
</head>

<body>
    <nav class="navbar">
        <div class="search-container">
            <div class="buttons-nav">
                <a href="./index.php"><button class="button-nav">Accueil</button></a>
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
            session_start();
            include('connexion_bd.php');

            // Récupérer le pseudo de l'utilisateur actuel depuis la session
            $pseudo = $_SESSION['pseudo'];

            // Requête SQL avec une jointure pour récupérer le lien de l'image de l'avatar de l'utilisateur
            $requete_avatar_user = "SELECT avatars.nom_avatar FROM utilisateurs
                                    JOIN avatars ON utilisateurs.avatar_id = avatars.id
                                    WHERE utilisateurs.pseudo = ?";

            $requete_preparee_avatar_user = $connexion->prepare($requete_avatar_user);
            $requete_preparee_avatar_user->bind_param("s", $pseudo);
            $requete_preparee_avatar_user->execute();
            $resultat_avatar_user = $requete_preparee_avatar_user->get_result();

            if ($resultat_avatar_user && $resultat_avatar_user->num_rows > 0) {
                $row_avatar_user = $resultat_avatar_user->fetch_assoc();
                $nom_avatar_base64 = $row_avatar_user['nom_avatar'];

                echo "<a href='profile.php'><img src='$nom_avatar_base64' alt='Avatar' class='avatar'></a>";
            } else {
                // Gérer le cas où l'avatar n'est pas trouvé
                echo "Avatar non trouvé";
            }
            ?>
        </div>
    </nav>
    <div class="corp">
        <?php
        include('connexion_bd.php');

        // Récupérer l'ID du film depuis la requête GET
        $id_film = $_GET['id'];

        // Requête pour récupérer les détails du film
        $requete_film = "SELECT * FROM films WHERE id_film = ?";
        $requete_preparee_film = $connexion->prepare($requete_film);
        $requete_preparee_film->bind_param("i", $id_film);
        $requete_preparee_film->execute();
        $resultat_film = $requete_preparee_film->get_result();

        if ($resultat_film && $resultat_film->num_rows > 0) {
            $row_film = $resultat_film->fetch_assoc();

            // Afficher les détails du film
            echo "<h1>" . $row_film['titre'] . "</h1>";

            echo "<div class='affiche-descritpion'>";
            echo "<img src='" . $row_film['lien_affiche'] . "' alt='Affiche du film' class='affiche'>";
            echo "<div class='description'>";
            echo "<h3>Description :</h3>";
            echo "<p>" . $row_film['description'] . "</p>";
            echo "</div>";
            echo "</div>";

            // Vérifier s'il y a un lien_regarder
            if (!empty($row_film['lien_regarder'])) {
                echo "<video id='my-video' class='video-js' controls preload='auto' width='600' height='300'>";
                echo "<source src='" . $row_film['lien_regarder'] . "' type='application/x-mpegURL'>";
                echo "</video>";
                echo "<script>
                        var player = videojs('my-video', {
                            controlBar: {
                                playToggle: true,
                                fullscreenToggle: true,
                                currentTimeDisplay: true,
                                timeDivider: true,
                                durationDisplay: true,
                                volumePanel: {
                                    inline: false,
                                },
                            },
                        });
                    </script>";
            } else {
                echo "<p>Le film n'est pas disponible actuellement.</p>";
            }
        } else {
            echo "Film non trouvé.";
        }
        ?>
    </div>
</body>
<script src="./index.js"></script>

</html>