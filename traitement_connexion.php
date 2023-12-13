<?php
// Assurez-vous d'avoir une connexion à la base de données en place
include('connexion_bd.php');

// Récupérer les données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Vérifier les informations de connexion dans la base de données
$requete_connexion = "SELECT id, pseudo, mot_de_passe, avatar_id FROM utilisateurs WHERE email = '$email'";
$resultat_connexion = $connexion->query($requete_connexion);

if (!$resultat_connexion) {
    die("Erreur dans la requête : " . $connexion->error);
}

if ($resultat_connexion->num_rows > 0) {
    // L'utilisateur existe, vérifier le mot de passe
    $row_connexion = $resultat_connexion->fetch_assoc();
    $mot_de_passe_stocke = $row_connexion['mot_de_passe'];

    if (password_verify($mot_de_passe, $mot_de_passe_stocke)) {
        // Mot de passe correct, l'utilisateur est connecté avec succès
        session_start();
        $_SESSION['id_utilisateur'] = $row_connexion['id'];
        $_SESSION['pseudo'] = $row_connexion['pseudo'];
        $_SESSION['avatar_id'] = $row_connexion['avatar_id'];

        // Rediriger vers la page d'accueil ou une autre page sécurisée
        header('Location: index.php');
        exit();
    }
}

// Échec de la connexion, rediriger vers la page de connexion avec un message d'erreur
header('Location: connexion.php?erreur=1');
exit();
?>
