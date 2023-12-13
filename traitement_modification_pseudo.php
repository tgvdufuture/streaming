<?php
session_start();

// Assurez-vous d'avoir une connexion à la base de données en place
include('connexion_bd.php');

// Récupérer le nouveau pseudo depuis le formulaire
$nouveau_pseudo = $_POST['nouveau_pseudo'];
$pseudo = $_SESSION['pseudo'];

// Mettre à jour le pseudo dans la base de données
$requete_modification_pseudo = "UPDATE utilisateurs SET pseudo = ? WHERE pseudo = ?";
$requete_preparee_modification_pseudo = $connexion->prepare($requete_modification_pseudo);
$requete_preparee_modification_pseudo->bind_param("ss", $nouveau_pseudo, $pseudo);

if ($requete_preparee_modification_pseudo->execute()) {
    // Mettre à jour le pseudo dans la session
    $_SESSION['pseudo'] = $nouveau_pseudo;

    // Rediriger vers la page du profil
    header('Location: profile.php');
    exit();
} else {
    // En cas d'erreur, afficher un message d'erreur
    echo "Erreur lors de la modification du pseudo : " . $requete_preparee_modification_pseudo->error;
}

// Fermeture de la requête préparée
$requete_preparee_modification_pseudo->close();

// Fermeture de la connexion
$connexion->close();
?>
