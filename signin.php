<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$pass = "";
$db = "connexion";

$conn = new mysqli($host, $user, $pass, $db);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur connexion: " . $conn->connect_error);
}

// Récupération des données envoyées par le formulaire
$email = $_POST['email'];
$password = $_POST['password'];

// Vérifie si un utilisateur avec cet email existe
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Vérifie le mot de passe avec hash
    if (password_verify($password, $user['password'])) {
        echo "<script>alert('Connecté avec succès');window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Mot de passe incorrect');window.history.back();</script>";
    }
} else {
    echo "<script>alert('Email non trouvé');window.history.back();</script>";
}

// Fermeture
$stmt->close();
$conn->close();
?>
