<?php

$conn = new mysqli("localhost", "root", "", "commande");

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$ville = $_POST['ville'];
$tel = $_POST['tel'];


$sql = "INSERT INTO commandes (nom, prenom, ville, tel) VALUES ('$nom', '$prenom', '$ville', '$tel')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Erreur: " . $conn->error;
}

$conn->close();
?>
