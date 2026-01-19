<?php
$servername = "localhost";
$username = "root"; // Remplace par ton utilisateur MySQL
$password = ""; // Remplace par ton mot de passe MySQL
$dbname = "reclamtionn";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de connexion: " . $conn->connect_error);
}

// Vérifier si les données sont bien envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['message'])) {
        $nom = $conn->real_escape_string($_POST['nom']);
        $email = $conn->real_escape_string($_POST['email']);
        $message = $conn->real_escape_string($_POST['message']);

        // Requête SQL
        $sql = "INSERT INTO reclamationss (nom, email, message) VALUES ('$nom', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Merci pour votre réclamation. Nous vous répondrons bientôt.');
                    window.location.href = 'index.html';
                  </script>";
        } else {
            echo "Erreur SQL : " . $conn->error;
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
} else {
    echo "Requête invalide.";
}

// Fermer la connexion
$conn->close();
?>
