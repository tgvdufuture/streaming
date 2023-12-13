<?php
include('connexion_bd.php');


// Récupération du pseudo depuis le formulaire
$pseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : null;

// Récupération de l'avatar sélectionné depuis le formulaire
if (isset($_POST['avatar'])) {
    $avatar_id = $_POST['avatar'];

    // Affichez les valeurs pour déboguer
    var_dump($pseudo, $avatar_id);

    // Mise à jour de l'avatar dans la base de données
    $mise_a_jour_avatar = "UPDATE utilisateurs SET avatar_id = $avatar_id WHERE pseudo = '$pseudo'";
    $resultat_mise_a_jour = $connexion->query($mise_a_jour_avatar);

    if ($resultat_mise_a_jour) {
        // Redirigez vers la page d'accueil avec le pseudo en paramètre
        header("Location: index.php?pseudo=$pseudo");
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Erreur lors de la mise à jour de l'avatar : " . $connexion->error;
    }
} else {
    echo "Aucun avatar sélectionné.";
}

// Fermeture de la connexion
$connexion->close();
?>
