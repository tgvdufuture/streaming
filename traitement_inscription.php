<?php
include('connexion_bd.php');

// Récupération des données du formulaire
$email = $_POST['email'];
$pseudo = $_POST['pseudo'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
$avatar_id = isset($_POST['avatar']) ? $_POST['avatar'] : null;

// Vérification de l'existence de l'adresse e-mail
$verification_email = "SELECT id FROM utilisateurs WHERE email=?";
$requete_preparee_verification = $connexion->prepare($verification_email);
$requete_preparee_verification->bind_param("s", $email);
$requete_preparee_verification->execute();
$resultat_verification = $requete_preparee_verification->get_result();

if ($resultat_verification) {
    if ($resultat_verification->num_rows > 0) {
        // L'adresse e-mail existe déjà, affichez un message d'erreur
        echo "Erreur lors de l'inscription : Cette adresse e-mail est déjà associée à un compte. Veuillez utiliser une adresse différente.";
    } else {
        // L'adresse e-mail n'existe pas, procédez à l'insertion
        $insertion = "INSERT INTO utilisateurs (email, pseudo, mot_de_passe, avatar_id) VALUES (?, ?, ?, ?)";
        $requete_preparee_insertion = $connexion->prepare($insertion);
        $requete_preparee_insertion->bind_param("sssi", $email, $pseudo, $mot_de_passe, $avatar_id);

        // Exécution de la requête d'insertion
        if ($requete_preparee_insertion->execute()) {
            // Redirection vers la page d'accueil avec le pseudo en paramètre
            header("Location: page_accueil.php?pseudo=$pseudo");
            exit();
        } else {
            // Affichez un message d'erreur en cas de problème d'insertion
            echo "Erreur lors de l'inscription : " . $requete_preparee_insertion->error;
        }

        // Fermeture de la requête préparée d'insertion
        $requete_preparee_insertion->close();
    }
} else {
    // Affichez un message d'erreur en cas de problème avec la requête de vérification d'e-mail
    echo "Erreur lors de l'inscription : Problème de vérification de l'adresse e-mail.";
}

// Fermeture de la requête préparée de vérification d'e-mail
$requete_preparee_verification->close();

// Fermeture de la connexion
$connexion->close();
?>
