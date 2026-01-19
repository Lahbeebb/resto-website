<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "reservation";

// Connexion
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erreur connexion: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$date = $_POST['date'];

// Préparer et exécuter la requête
$sql = "INSERT INTO reservations (name, email, number, date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $number, $date);

if ($stmt->execute()) {
    echo "<script>alert('Réservation envoyée avec succès');window.location.href='index.html';</script>";
} else {
    echo "<script>alert('Erreur lors de la réservation');window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
