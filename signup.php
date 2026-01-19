<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$pass = "";
$db = "connexion"; // nom de votre base

$conn = new mysqli($host, $user, $pass, $db);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur connexion: " . $conn->connect_error);
}

// Récupération des données envoyées par le formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

// Vérification que les mots de passe correspondent
if ($password != $confirm) {
    echo "<script>alert('Les mots de passe ne correspondent pas');window.history.back();</script>";
    exit;
}

// Hash du mot de passe avant de le stocker (sécurité)
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Préparation de la requête SQL pour insérer le nouvel utilisateur
$sql = "INSERT INTO users (nom, prenom, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nom, $prenom, $email, $hashed);

// Exécution de la requête
if ($stmt->execute()) {
    echo "<script>alert('Compte créé avec succès');window.location.href='index.html';</script>";
} else {
    echo "<script>alert('Erreur: compte existant ou problème de serveur');window.history.back();</script>";
}

// Fermeture
$stmt->close();
$conn->close();
?>
