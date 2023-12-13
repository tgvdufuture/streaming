<?php
session_start();
include('connexion_bd.php');

// Récupérer l'ID de l'utilisateur actuel
$id_utilisateur = $_SESSION['id_utilisateur'];

// Supprimer l'utilisateur de la base de données
$requete_suppression_utilisateur = "DELETE FROM utilisateurs WHERE id = ?";
$stmt = $connexion->prepare($requete_suppression_utilisateur);
$stmt->bind_param("i", $id_utilisateur);

if ($stmt->execute()) {
    // Redirection vers une page d'accueil ou une page de confirmation après la suppression
    header("Location: inscription.php");
    exit();
} else {
    // Gestion de l'erreur
    echo "Erreur lors de la suppression du compte : " . $stmt->error;
}

// Fermer la requête préparée
$stmt->close();

// Fermer la connexion à la base de données
$connexion->close();
?>
