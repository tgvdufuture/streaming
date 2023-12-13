<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Mon Site de Films</title>
</head>

<body>
    <!-- navbar avec shearch -->
    <nav class="navbar">
        <div class="search-container">
            <div class="buttons-nav">
                <a href=""><button class="button-nav">Accueil</button></a>
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



    <video id="background-video" autoplay muted loop>
        <source src="./Gran Turismo - Bande-annonce officielle.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay-content">
        <div class="title">
            <h1>Gran Turismo</h1>
        </div>
        <div class="description">
            <p>Gran Turismo retrace l'incroyable histoire vraie d'une équipe d'outsiders : un gamer issu de la classe ouvrière, un ex-pilote de course raté et un cadre idéaliste de l’industrie du sport automobile. Ensemble, ils risquent tout et s'attaquent au sport le plus élitiste au monde.
                <br>
                Inspirant, palpitant et bourré d’action, le film GRAN TURISMO prouve que rien n'est impossible quand on est déterminé à prendre tous les risques.
            </p>
        </div>
        <div class="buttons">
            <a href="">
                <button>Regarder</button>
            </a>
            <button class="like">
                Liker&nbsp;
                <span id="like-icon">&#x2764;</span>
            </button>
            <a href="">
                <button>Autres</button>
            </a>

        </div>
    </div>

    <div class="bottom-buttons">
        <button class="button1"></button>
        <button class="button2"></button>
        <button class="button3"></button>
        <button class="button4"></button>
        <button class="button5"></button>
    </div>

    <h2>Action :</h2>

    <div class="carousel carousel-action">
        <button class='flt-left prevBTN' onclick="slideRight(1, event);"><img src="./assets/icons/fleche.png"></img></button>
        <div class="row flt-left">
            <div class="row-container">
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 1;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 2;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 3;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 4;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 5;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 6;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 7;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <button class='flt-left nextBTN' onclick="slideLeft(1, event);"><img src="./assets/icons/fleche.png"></img></button>
        <div class="clear"></div>
    </div>

    <h2>Comédie :</h2>

    <div class="carousel carousel-comedie">
        <button class='flt-left prevBTN' onclick="slideRight(2, event);"><img src="./assets/icons/fleche.png"></img></button>
        <div class="row flt-left">
            <div class="row-container">
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 7;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 8;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 9;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 10;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 11;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 12;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="container">
                    <?php
                    include('connexion_bd.php');

                    // Spécifiez l'ID de l'affiche que vous souhaitez afficher (vous pouvez changer cette valeur)
                    $id_affiche_a_afficher = 13;

                    $requete_affiche = "SELECT id_film, lien_affiche FROM films WHERE id_film = ?";
                    $requete_preparee_affiche = $connexion->prepare($requete_affiche);
                    $requete_preparee_affiche->bind_param("i", $id_affiche_a_afficher);
                    $requete_preparee_affiche->execute();
                    $resultat_affiche = $requete_preparee_affiche->get_result();

                    if ($resultat_affiche && $resultat_affiche->num_rows > 0) {
                        $row_affiche = $resultat_affiche->fetch_assoc();
                        $id_film = $row_affiche['id_film'];
                        $lien_affiche = $row_affiche['lien_affiche'];

                        // Redirigez l'utilisateur vers film.php avec l'ID du film
                        $lien_page_film = "film.php?id=$id_film";
                    ?>
                        <a href="<?php echo $lien_page_film; ?>">
                            <img src="<?php echo $lien_affiche; ?>" alt="Affiche du film">
                        </a>
                    <?php
                    } else {
                        // Aucune affiche trouvée avec l'ID spécifié
                        echo "Affiche non trouvée";
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <button class='flt-left nextBTN' onclick="slideLeft(2, event);"><img src="./assets/icons/fleche.png"></img></button>
        <div class="clear"></div>
    </div>
</body>
<script src="./index.js"></script>

</html>